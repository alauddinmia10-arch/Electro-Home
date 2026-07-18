<x-layouts.app>
    <div class="bg-gray-100 py-6 min-h-[calc(100vh-200px)]">
        <div class="max-w-[1440px] mx-auto px-4 xl:px-4">
            <div class="flex items-center gap-2 mb-6">
                <a href="{{ route('cart') }}" class="text-gray-500 hover:text-[var(--color-trust-blue)]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-800 font-bangla">চেকআউট</h1>
            </div>

            @if(app(\App\Services\CartService::class)->getCount() > 0)
                <livewire:checkout-process />
            @else
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">আপনার কার্ট খালি!</h3>
                    <p class="text-gray-500 mb-8">চেকআউট করার আগে কার্টে প্রোডাক্ট যুক্ত করুন।</p>
                    <a href="{{ route('shop') }}" class="btn btn-primary px-8">শপিং শুরু করুন</a>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
