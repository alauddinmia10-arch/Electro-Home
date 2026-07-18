<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] #[Title('Register - Electrohome.bd')] class extends Component {
    public string $name = '';
    public string $phone = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'password' => Hash::make($this->password),
            'role' => 'customer',
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
} ?>

<div class="bg-gray-50 py-12">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 font-bangla">নতুন একাউন্ট তৈরি করুন</h2>
            
            <form wire:submit="register" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" wire:model="name" class="form-input" placeholder="Your Name" required>
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="text" wire:model="phone" class="form-input" placeholder="01XXXXXXXXX" required>
                    @error('phone') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" wire:model="password" class="form-input" placeholder="••••••••" required>
                    @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" wire:model="password_confirmation" class="form-input" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="btn btn-primary w-full text-lg">
                    <span wire:loading.remove wire:target="register">Register</span>
                    <span wire:loading wire:target="register">Creating Account...</span>
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Already have an account? 
                    <a href="{{ route('login') }}" class="text-trust-blue font-semibold hover:underline">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>
