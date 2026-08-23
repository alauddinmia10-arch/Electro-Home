<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] #[Title('My Dashboard - Electrohome.bd')] class extends Component {
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        return redirect('/');
    }
} ?>

<div class="bg-gray-50 py-10 min-h-[calc(100vh-200px)]">
    <div class="max-w-[1600px] w-full mx-auto px-2 md:px-4 xl:px-[70px]">
        <div class="flex flex-col md:flex-row gap-6">
            
            {{-- Sidebar --}}
            <div class="w-full md:w-1/4">
                <div class="bg-white rounded shadow-sm border border-gray-100 overflow-hidden sticky top-20">
                    <div class="p-6 border-b border-gray-100 text-center">
                        <div class="w-20 h-20 bg-trust-blue rounded-full text-white flex items-center justify-center text-3xl font-bold mx-auto mb-3">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <h3 class="font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                        <p class="text-sm text-gray-500">{{ Auth::user()->phone }}</p>
                    </div>
                    
                    <div class="flex flex-col p-2">
                        <a href="{{ route('dashboard') }}" class="px-4 py-3 text-trust-blue font-medium bg-blue-50 rounded flex items-center gap-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            আমার প্রোফাইল
                        </a>
                        <a href="#" class="px-4 py-3 text-gray-600 hover:text-trust-blue hover:bg-gray-50 rounded flex items-center gap-3 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            অর্ডার সমূহ
                        </a>
                        <a href="{{ route('wishlist') }}" class="px-4 py-3 text-gray-600 hover:text-trust-blue hover:bg-gray-50 rounded flex items-center gap-3 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            উইশলিস্ট
                        </a>
                        
                        @if(Auth::user()->isStaff())
                            <a href="{{ url('/admin') }}" class="px-4 py-3 text-trust-blue font-bold hover:bg-gray-50 rounded flex items-center gap-3 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                অ্যাডমিন প্যানেল
                            </a>
                        @endif

                        <div class="h-px bg-gray-100 my-2 mx-4"></div>
                        
                        <button wire:click="logout" class="px-4 py-3 text-soft-coral hover:bg-red-50 rounded flex items-center gap-3 transition-colors text-left w-full">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            লগআউট
                        </button>
                    </div>
                </div>
            </div>
            
            {{-- Main Content --}}
            <div class="w-full md:w-3/4 space-y-6">
                <div class="bg-white p-6 rounded shadow-sm border border-gray-100">
                    <h2 class="text-xl font-bold text-gray-800 font-bangla mb-4">স্বাগতম, {{ Auth::user()->name }}!</h2>
                    <p class="text-gray-600">আপনার ড্যাশবোর্ড থেকে আপনি আপনার সাম্প্রতিক অর্ডারগুলো দেখতে পারবেন এবং প্রোফাইলের তথ্য আপডেট করতে পারবেন।</p>
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white p-6 rounded shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-blue-100 text-trust-blue rounded-full flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800">{{ Auth::user()->orders()->count() }}</h4>
                        <span class="text-sm text-gray-500 font-bangla">মোট অর্ডার</span>
                    </div>
                    
                    <div class="bg-white p-6 rounded shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-green-100 text-sea-green rounded-full flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800">{{ Auth::user()->orders()->where('delivery_status', 'pending')->count() }}</h4>
                        <span class="text-sm text-gray-500 font-bangla">পেন্ডিং অর্ডার</span>
                    </div>
                    
                    <div class="bg-white p-6 rounded shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center">
                        <div class="w-12 h-12 bg-purple-100 text-soft-purple rounded-full flex items-center justify-center mb-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800">{{ Auth::user()->wishlists()->count() }}</h4>
                        <span class="text-sm text-gray-500 font-bangla">উইশলিস্ট</span>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
