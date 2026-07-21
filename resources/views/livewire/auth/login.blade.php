<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] #[Title('Login - Electrohome.bd')] class extends Component {
    public string $login = '';
    public string $password = '';
    public bool $remember = false;

    public function authenticate()
    {
        $this->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($this->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (Auth::attempt([$fieldType => $this->login, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        $this->addError('login', 'Email/Phone or password incorrect.');
    }
} ?>

<div class="bg-gray-50 py-6">
    <div class="max-w-md mx-auto bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 font-bangla">লগইন করুন</h2>
            
            <form wire:submit="authenticate" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email or Phone Number</label>
                    <input type="text" wire:model="login" class="form-input" placeholder="admin@electrohome.bd or 01XXXXXXXXX" required>
                    @error('login') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" wire:model="password" class="form-input" placeholder="••••••••" required>
                    @error('password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="remember" class="rounded border-gray-300 text-trust-blue focus:ring-trust-blue">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-trust-blue hover:underline">Forgot password?</a>
                </div>
                
                <button type="submit" class="btn btn-primary w-full text-lg">
                    <span wire:loading.remove wire:target="authenticate">Login</span>
                    <span wire:loading wire:target="authenticate">Logging in...</span>
                </button>
            </form>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-trust-blue font-semibold hover:underline">Register here</a>
                </p>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-100">
                <p class="text-sm text-center text-gray-500 mb-4 font-bangla">অথবা ওটিপি দিয়ে লগইন করুন</p>
                <button type="button" class="btn btn-neutral w-full">
                    Login with OTP (Coming Soon)
                </button>
            </div>
        </div>
    </div>
</div>

