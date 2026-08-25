<?php

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] #[Title('Register - Electrohome.bd')] class extends Component {
    public string $name = '';
    public string $phone = '';
    public string $email = '';
    public string $otpCode = '';
    public string $otpStep = 'request'; // 'request' or 'verify'

    public function requestOtp()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'phone' => 'required|string|regex:/^01[3-9]\d{8}$/|unique:users,phone',
        ], [
            'email.unique' => 'This email is already registered. Please log in.',
            'phone.regex' => 'Please enter a valid 11-digit Bangladeshi mobile number.',
            'phone.unique' => 'This phone number is already registered. Please log in.',
        ]);

        $otp = rand(1000, 9999);
        
        session()->put('register_otp_data', [
            'phone' => $this->phone,
            'email' => $this->email,
            'name' => $this->name,
            'code' => (string) $otp,
            'expires_at' => now()->addMinutes(5),
        ]);

        $message = "Electrohome.bd - Your registration OTP is: {$otp}. It is valid for 5 minutes.";
        
        app(\App\Services\SmsService::class)->sendSms($this->phone, $message);
        
        try {
            Mail::to($this->email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            // Ignore email errors in free tier or local
        }

        $this->otpStep = 'verify';
    }

    public function register()
    {
        $this->validate([
            'otpCode' => 'required|string|size:4',
        ], [
            'otpCode.required' => 'Please enter the OTP.',
            'otpCode.size' => 'OTP must be 4 digits.',
        ]);

        $otpData = session()->get('register_otp_data');

        if (!$otpData || $otpData['phone'] !== $this->phone) {
            $this->addError('otpCode', 'Session expired. Please request a new OTP.');
            return;
        }

        if (now()->greaterThan($otpData['expires_at'])) {
            $this->addError('otpCode', 'OTP expired. Please request a new OTP.');
            session()->forget('register_otp_data');
            $this->otpStep = 'request';
            return;
        }

        if ($this->otpCode !== $otpData['code']) {
            $this->addError('otpCode', 'Invalid OTP entered.');
            return;
        }

        $user = User::create([
            'name' => $otpData['name'],
            'email' => $otpData['email'],
            'phone' => $otpData['phone'],
            'password' => Hash::make(\Illuminate\Support\Str::random(16)),
            'role' => 'customer',
        ]);

        Auth::login($user);
        session()->forget('register_otp_data');

        return redirect()->route('dashboard');
    }

    public function goBack()
    {
        $this->otpStep = 'request';
        $this->otpCode = '';
    }
} ?>

<div class="bg-gray-50 py-6">
    <div class="max-w-md mx-auto bg-white rounded shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 font-bangla">নতুন একাউন্ট তৈরি করুন</h2>
            
            @if($otpStep === 'request')
            <form wire:submit="requestOtp" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" wire:model="name" class="form-input" placeholder="Your Name" required>
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" wire:model="email" class="form-input" placeholder="your.email@example.com" required>
                    @error('email') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" wire:model="phone" class="form-input" placeholder="01XXXXXXXXX" required>
                    @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <button type="submit" class="btn btn-primary w-full text-lg">
                    <span wire:loading.remove wire:target="requestOtp">Send OTP</span>
                    <span wire:loading wire:target="requestOtp">Sending...</span>
                </button>
            </form>
            @else
            <form wire:submit="register" class="space-y-5">
                <div class="text-center mb-4">
                    <p class="text-sm text-gray-600">We've sent a 4-digit code to</p>
                    <p class="font-bold text-gray-800">{{ $phone }} & your email</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1 text-center">Enter OTP</label>
                    <input type="text" wire:model="otpCode" class="form-input text-center text-xl tracking-[0.5em]" placeholder="••••" maxlength="4" required>
                    @error('otpCode') <span class="block text-red-500 text-sm mt-1 text-center">{{ $message }}</span> @enderror
                </div>
                
                <button type="submit" class="btn btn-primary w-full text-lg">
                    <span wire:loading.remove wire:target="register">Verify & Register</span>
                    <span wire:loading wire:target="register">Registering...</span>
                </button>

                <div class="text-center mt-4">
                    <button type="button" wire:click="goBack" class="text-sm text-trust-blue hover:underline">Change Phone Number</button>
                </div>
            </form>
            @endif
            
            @if($otpStep === 'request')
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Already have an account? 
                    <a href="{{ route('login') }}" class="text-trust-blue font-semibold hover:underline">Login here</a>
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
