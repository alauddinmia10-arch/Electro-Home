<?php

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('components.layouts.app')] #[Title('Login - Electrohome.bd')] class extends Component {
    public bool $remember = false;

    // OTP Flow State
    public string $otpPhone = '';
    public string $otpCode = '';
    public string $otpStep = 'request'; // 'request' or 'verify'

    public function requestOtp()
    {
        $this->validate([
            'otpPhone' => 'required|string|regex:/^01[3-9]\d{8}$/',
        ], [
            'otpPhone.regex' => 'Please enter a valid 11-digit Bangladeshi mobile number.',
            'otpPhone.required' => 'Mobile number is required.',
        ]);

        $user = User::where('phone', $this->otpPhone)->first();
        if (!$user) {
            $this->addError('otpPhone', 'No account found with this number. Please register first.');
            return;
        }

        $otp = rand(1000, 9999);
        
        session()->put('login_otp_data', [
            'phone' => $this->otpPhone,
            'code' => (string) $otp,
            'expires_at' => now()->addMinutes(5),
        ]);

        $message = "Electrohome.bd - Your login OTP is: {$otp}. It is valid for 5 minutes.";
        
        app(\App\Services\SmsService::class)->sendSms($this->otpPhone, $message);
        
        if ($user->email && !str_ends_with($user->email, '@electrohome.bd')) {
            try {
                Mail::to($user->email)->send(new OtpMail($otp));
            } catch (\Exception $e) {
                // Ignore email errors
            }
        }

        $this->otpStep = 'verify';
    }

    public function verifyOtp()
    {
        $this->validate([
            'otpCode' => 'required|string|size:4',
        ], [
            'otpCode.required' => 'Please enter the OTP.',
            'otpCode.size' => 'OTP must be 4 digits.',
        ]);

        $otpData = session()->get('login_otp_data');

        if (!$otpData || $otpData['phone'] !== $this->otpPhone) {
            $this->addError('otpCode', 'Session expired. Please request a new OTP.');
            return;
        }

        if (now()->greaterThan($otpData['expires_at'])) {
            $this->addError('otpCode', 'OTP expired. Please request a new OTP.');
            session()->forget('login_otp_data');
            $this->otpStep = 'request';
            return;
        }

        if ($this->otpCode !== $otpData['code']) {
            $this->addError('otpCode', 'Invalid OTP entered.');
            return;
        }

        $user = User::where('phone', $this->otpPhone)->first();
        if (!$user) {
            $this->addError('otpCode', 'User no longer exists.');
            return;
        }

        Auth::login($user, $this->remember);
        session()->forget('login_otp_data');
        session()->regenerate();
        
        return redirect()->intended(route('dashboard'));
    }

    public function goBackToPhone()
    {
        $this->otpStep = 'request';
        $this->otpCode = '';
    }
} ?>

<div class="bg-gray-50 py-6">
    <div class="max-w-md mx-auto bg-white rounded shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 font-bangla">লগইন করুন</h2>
            
            @if($otpStep === 'request')
                <form wire:submit="requestOtp" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" wire:model="otpPhone" class="form-input" placeholder="01XXXXXXXXX" required>
                        @error('otpPhone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <label class="flex items-center gap-2 mt-2 mb-4">
                        <input type="checkbox" wire:model="remember" class="rounded border-gray-300 text-trust-blue focus:ring-trust-blue">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    
                    <button type="submit" class="btn btn-primary w-full text-lg">
                        <span wire:loading.remove wire:target="requestOtp">Send OTP</span>
                        <span wire:loading wire:target="requestOtp">Sending...</span>
                    </button>
                </form>
            @else
                <form wire:submit="verifyOtp" class="space-y-5">
                    <div class="text-center mb-4">
                        <p class="text-sm text-gray-600">We've sent a 4-digit code to</p>
                        <p class="font-bold text-gray-800">{{ $otpPhone }}</p>
                        <p class="text-xs text-gray-500">And your registered email address</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 text-center">Enter OTP</label>
                        <input type="text" wire:model="otpCode" class="form-input text-center text-xl tracking-[0.5em]" placeholder="••••" maxlength="4" required>
                        @error('otpCode') <span class="block text-red-500 text-sm mt-1 text-center">{{ $message }}</span> @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-full text-lg">
                        <span wire:loading.remove wire:target="verifyOtp">Login</span>
                        <span wire:loading wire:target="verifyOtp">Verifying...</span>
                    </button>

                    <div class="text-center mt-4">
                        <button type="button" wire:click="goBackToPhone" class="text-sm text-trust-blue hover:underline">Change Phone Number</button>
                    </div>
                </form>
            @endif
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-trust-blue font-semibold hover:underline">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div>

