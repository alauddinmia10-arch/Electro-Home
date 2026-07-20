@component('layouts.app')
<div class="container mx-auto px-4 pt-4 md:pt-6 flex justify-center items-start" style="padding-bottom: 80px;">
    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl border border-gray-100 px-8 pt-12 pb-8 md:px-12 md:pt-16 md:pb-12 flex flex-col justify-center text-center">
        <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mt-4 md:mt-6 mb-8">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h2 class="text-3xl font-bold text-gray-800 mb-4 font-bangla">অভিনন্দন, আপনার অর্ডারটি সফল হয়েছে!</h2>
        <p class="text-lg text-gray-600 mb-8">আপনার অর্ডার ইনভয়েস নাম্বার: <strong class="text-black">{{ $order->invoice_number }}</strong></p>
        
        <div class="bg-blue-50 rounded-xl p-6 mb-10 text-lg md:text-xl text-blue-800 font-bangla font-medium leading-relaxed">
            আপনার অর্ডারের বর্তমান অবস্থা (Status) জানতে লগইন করে ড্যাশবোর্ড চেক করুন।
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-2">
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary bg-[var(--color-trust-blue)] text-white px-8 py-3.5 rounded-lg hover:brightness-90 hover:bg-[var(--color-trust-blue)] border-none transition font-bangla text-lg w-full sm:w-auto">লগইন করুন</a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-primary bg-[var(--color-trust-blue)] text-white px-8 py-3.5 rounded-lg hover:brightness-90 hover:bg-[var(--color-trust-blue)] border-none transition font-bangla text-lg w-full sm:w-auto">ড্যাশবোর্ড</a>
            @endauth
            <a href="{{ route('home') }}" class="btn bg-green-600 text-white border-none px-8 py-3.5 rounded-lg hover:brightness-90 hover:bg-green-600 transition font-bangla text-lg shadow-sm w-full sm:w-auto">হোমে ফিরে যান</a>
        </div>
    </div>
</div>
@endcomponent
