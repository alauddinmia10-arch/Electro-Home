<!DOCTYPE html>
<html lang="bn" class="overflow-x-hidden w-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Electrohome.bd — Premium Electronics Components Store' }}</title>
    <meta name="description" content="{{ $metaDescription ?? 'বাংলাদেশের অন্যতম প্রিমিয়াম ইলেকট্রনিক্স কম্পোনেন্ট স্টোর। সার্কিট, সেন্সর, ব্যাটারি, চার্জার এবং আরও হাজারো প্রোডাক্ট।' }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon-light.png') }}" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="{{ asset('favicon-dark.png') }}" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icon.webp') }}">
    <link rel="mask-icon" href="{{ asset('images/monochrome.webp') }}" color="#16A34A">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Heroicons --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Facebook Pixel --}}
    @include('partials.facebook-pixel')

    @livewireStyles
</head>
<body class="bg-[var(--color-bg-secondary)] min-h-screen flex flex-col overflow-x-hidden w-full m-0 p-0 relative">

    {{-- Top Bar --}}
    <div class="bg-[var(--color-text-primary)] text-white text-[13px] py-1.5 hidden md:block print:hidden">
        <div class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px] flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="tel:{{ str_replace(' ', '', \App\Models\Setting::get('support_phone', '+8801880223099')) }}" class="flex items-center gap-1 hover:text-gray-300 transition-colors">
                    <svg class="w-3.5 h-3.5 shrink-0" style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ \App\Models\Setting::get('support_phone', '+8801880223099') }}
                </a>
                <a href="https://wa.me/{{ str_replace(['+', ' '], '', \App\Models\Setting::get('whatsapp_number', '8801880223099')) }}" target="_blank" class="flex items-center gap-1 hover:text-[#25D366] transition-colors">
                    <svg class="w-3.5 h-3.5 shrink-0 text-[#25D366]" style="width: 14px; height: 14px;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    +{{ ltrim(\App\Models\Setting::get('whatsapp_number', '8801880223099'), '+') }}
                </a>
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 shrink-0" style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    {{ \App\Models\Setting::get('support_email', 'support@electrohome.bd') }}
                </span>
            </div>
            <div class="flex items-center gap-3">
                <span>🚚 ঢাকায় ডেলিভারি ৳৭০ | ঢাকার বাইরে ৳১৩০</span>
            </div>
        </div>
    </div>

    {{-- Main Header --}}
    <header class="bg-white border-b border-gray-100 relative z-50 print:hidden" x-data="{ mobileMenu: false }">
        <div class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
            <div class="flex items-center justify-between h-14 md:h-16">

                {{-- Mobile Menu Toggle (Left on mobile) --}}
                <button class="md:hidden p-1 text-gray-600 -ml-1" @click="mobileMenu = !mobileMenu">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                {{-- Logo --}}
                <div class="flex-1 md:flex-none flex justify-center md:justify-start">
                    <x-logo theme="light" />
                </div>

                {{-- Search Bar (Desktop) --}}
                <div class="hidden md:flex flex-1 max-w-3xl mx-8">
                    @livewire('live-search')
                </div>

                {{-- Header Actions --}}
                <div class="flex items-center gap-4 lg:gap-6">
                    {{-- Wishlist --}}
                    <a href="{{ route('wishlist') }}" class="hidden md:flex flex-col items-center justify-center text-gray-600 hover:text-[var(--color-soft-coral)] transition-colors p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <span class="text-[12px] font-medium leading-none">Wishlist</span>
                    </a>

                    {{-- Cart --}}
                    @livewire('cart-icon')

                    {{-- User Menu --}}
                    <div x-data="{ open: false }" class="relative hidden md:block">
                        @auth
                            <button @click="open = !open" class="flex items-center gap-1.5 text-gray-600 hover:text-[var(--color-trust-blue)] transition-colors p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg border border-gray-100 py-1 z-50">
                                @if(Auth::user()->isStaff())
                                    <a href="{{ url('/admin') }}" class="block px-4 py-2 text-sm text-trust-blue font-semibold hover:bg-gray-50">⚙️ Admin Panel</a>
                                    <hr class="my-1">
                                @endif
                                <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">🏠 Dashboard</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">📦 My Orders</a>
                                <a href="{{ route('wishlist') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">❤️ Wishlist</a>
                                <hr class="my-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">🚪 Logout</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="btn-neutral text-sm">
                                Login / Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            {{-- Search Bar (Mobile) --}}
            @if(!request()->routeIs(['cart', 'wishlist', 'dashboard', 'profile.*', 'checkout*', 'product.show']))
            <div class="md:hidden w-full">
                @livewire('live-search')
            </div>
            @endif
        </div>

        {{-- Category Navigation (Desktop) --}}
        <nav class="hidden md:block border-t border-[#0b5c9a]/20 bg-[#0b5c9a]/15 backdrop-blur-md sticky top-0 z-40">
            <div class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
                <div class="flex items-stretch gap-6 h-9 text-sm">
                    <div x-data="{ open: false, activeCat: null, activeSubcat: null, flyoutTop: 0 }" @mouseenter="open = true" @mouseleave="open = false; activeCat = null; activeSubcat = null" class="relative h-full flex items-stretch">
                        <button class="h-full flex items-center gap-2.5 transition-all text-gray-800 font-bold text-sm md:text-base pr-4">
                            <div class="w-8 h-8 rounded-full bg-[#0a9347] flex items-center justify-center text-white shrink-0 shadow-sm my-auto">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </div>
                            <span>All Categories</span>
                            <svg class="w-4 h-4 text-gray-500 transition-transform ml-0.5" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        {{-- Main Dropdown Wrapper --}}
                        <div x-ref="menuWrapper" x-show="open" x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute left-0 top-full z-50 flex items-start">
                            
                            {{-- Scrolling List (Scrollbar on left using rtl) --}}
                            <div class="w-[280px] bg-white rounded py-2 overflow-y-auto custom-scrollbar shrink-0" style="height: 750px; max-height: 85vh; border: 1px solid rgba(11, 92, 154, 0.2); box-shadow: 0 0 10px rgba(11, 92, 154, 0.2);" dir="rtl">
                                <div dir="ltr">
                                    @foreach(\App\Models\Category::parents()->active()->ordered()->with('children.children')->get() as $cat)
                                        <div @mouseenter="activeCat = {{ $cat->id }}; activeSubcat = null; flyoutTop = $el.getBoundingClientRect().top - $refs.menuWrapper.getBoundingClientRect().top">
                                            <a href="{{ route('shop', ['category' => $cat->slug]) }}" class="group flex items-center justify-between px-6 py-2.5 text-lg font-bold text-gray-700 hover:bg-gray-50 hover:text-[#094d82]" :class="activeCat === {{ $cat->id }} ? 'bg-gray-50 text-[#094d82]' : ''">
                                                <div class="flex items-center gap-3">
                                                    <span class="flex items-center justify-center">
                                                        <x-category-icon :category="$cat" />
                                                    </span>
                                                    <span class="truncate">{{ $cat->name }}</span>
                                                </div>
                                                @if($cat->children->count() > 0)
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                @endif
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Flyouts (Rendered outside to prevent clipping) --}}
                            <div class="relative ml-1">
                                @foreach(\App\Models\Category::parents()->active()->ordered()->with('children.children')->get() as $cat)
                                    @if($cat->children->count() > 0)
                                        <div x-show="activeCat === {{ $cat->id }}" :style="{ top: flyoutTop + 'px' }" class="absolute left-0 w-[260px] bg-white rounded py-2 z-50 transition-all duration-150" style="border: 1px solid rgba(11, 92, 154, 0.2); box-shadow: 0 0 10px rgba(11, 92, 154, 0.2);">
                                            @foreach($cat->children as $child)
                                                <div @mouseenter="activeSubcat = {{ $child->id }}" class="relative">
                                                    <a href="{{ route('shop', ['category' => $child->slug]) }}" class="flex items-center justify-between px-6 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#094d82]" :class="activeSubcat === {{ $child->id }} ? 'bg-gray-50 text-[#094d82]' : ''">
                                                        <span>{{ $child->name }}</span>
                                                        @if($child->children->count() > 0)
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                        @endif
                                                    </a>
                                                    
                                                    {{-- Level 3 Flyout --}}
                                                    @if($child->children->count() > 0)
                                                        <div x-show="activeSubcat === {{ $child->id }}" class="absolute left-full top-0 w-[240px] bg-white rounded py-2 ml-1 z-50 transition-all duration-150" style="border: 1px solid rgba(11, 92, 154, 0.2); box-shadow: 0 0 10px rgba(11, 92, 154, 0.2);">
                                                            @foreach($child->children as $subchild)
                                                                <a href="{{ route('shop', ['category' => $subchild->slug]) }}" class="block px-6 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#094d82]">
                                                                    {{ $subchild->name }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('shop') }}" class="flex items-center text-gray-700 font-semibold hover:text-[#094d82] transition-colors">
                        Shop
                    </a>
                    <a href="{{ route('shop', ['featured' => true]) }}" class="flex items-center text-gray-700 font-semibold hover:text-[#094d82] transition-colors">
                        Featured
                    </a>
                    <a href="{{ route('shop', ['new_arrivals' => 1]) }}" class="flex items-center text-gray-700 font-semibold hover:text-[#094d82] transition-colors">
                        New Arrivals
                    </a>
                    <a href="{{ route('shop', ['flash_sale' => true]) }}" class="flex items-center text-[var(--color-warm-orange)] font-semibold hover:text-[var(--color-warm-orange-hover)] transition-colors gap-1">
                        ⚡ Flash Sale
                    </a>
                </div>
            </div>
        </nav>
        {{-- Mobile Menu Drawer --}}
        <div x-show="mobileMenu" class="md:hidden" style="display: none;">
            {{-- Backdrop --}}
            <div x-show="mobileMenu" x-transition.opacity @click="mobileMenu = false" class="fixed inset-0 bg-black/50 z-[60]"></div>
            
            {{-- Sidebar --}}
            <div x-show="mobileMenu" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="-translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="-translate-x-full"
                 class="fixed inset-y-0 left-0 w-[75%] max-w-[300px] bg-white shadow-2xl z-[70] flex flex-col">
                 
                 <div class="p-4 border-b border-gray-100 flex items-center justify-between bg-gray-50">
                     <span class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-[#094d82] to-sky-500 uppercase tracking-widest drop-shadow-sm">Categories</span>
                     <button @click="mobileMenu = false" class="p-1 -mr-1 text-gray-500 hover:text-red-500 transition-colors">
                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                     </button>
                 </div>
                 
                 <div class="flex-1 overflow-y-auto py-2 px-4 custom-scrollbar">
                     <div class="flex flex-col">
                         @foreach(\App\Models\Category::parents()->active()->ordered()->with('children.children')->get() as $cat)
                             <div x-data="{ expanded: false }">
                                 <div class="flex items-center justify-between py-1.5">
                                     <a href="{{ route('shop', ['category' => $cat->slug]) }}" class="group flex items-center gap-3 text-lg font-semibold text-gray-700 hover:text-[#094d82] flex-1">
                                         <span class="flex items-center justify-center">
                                             <x-category-icon :category="$cat" />
                                         </span>
                                         <span>{{ $cat->name }}</span>
                                     </a>
                                     @if($cat->children->count() > 0)
                                         <button @click="expanded = !expanded" class="p-1 text-gray-500 rounded hover:bg-gray-100">
                                             <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                         </button>
                                     @endif
                                 </div>
                                 @if($cat->children->count() > 0)
                                     <div x-show="expanded" style="display: none;" class="pl-4 border-l border-gray-100 ml-2 mb-1 flex flex-col gap-1">
                                         @foreach($cat->children as $child)
                                             <div x-data="{ subExpanded: false }">
                                                 <div class="flex items-center justify-between py-1">
                                                     <a href="{{ route('shop', ['category' => $child->slug]) }}" class="block text-sm text-gray-600 hover:text-[#094d82] flex-1">
                                                         {{ $child->name }}
                                                     </a>
                                                     @if($child->children->count() > 0)
                                                         <button @click="subExpanded = !subExpanded" class="p-1 text-gray-400 rounded hover:bg-gray-50">
                                                             <svg class="w-3.5 h-3.5 transition-transform" :class="subExpanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                                         </button>
                                                     @endif
                                                 </div>
                                                 @if($child->children->count() > 0)
                                                     <div x-show="subExpanded" style="display: none;" class="pl-4 border-l border-gray-50 ml-2 flex flex-col gap-1 pb-1">
                                                         @foreach($child->children as $subchild)
                                                             <a href="{{ route('shop', ['category' => $subchild->slug]) }}" class="block py-1 text-xs text-gray-500 hover:text-[#094d82]">
                                                                 {{ $subchild->name }}
                                                             </a>
                                                         @endforeach
                                                     </div>
                                                 @endif
                                             </div>
                                         @endforeach
                                     </div>
                                 @endif
                             </div>
                         @endforeach
                     </div>
                 </div>
            </div>
        </div>
    </header>


    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px] mt-4">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px] mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded text-sm flex items-center gap-2">
                ❌ {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1 pb-20 md:pb-0">
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer class="bg-[#eff5f2] border-t border-[#e0ebe5] text-gray-800 mt-auto print:hidden">
        {{-- Feature Highlights --}}
        <div class="hidden md:block bg-[#eff5f2] pt-1.5 md:pt-2.5">
            <div class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
                <div class="flex flex-col lg:flex-row justify-between gap-4 md:gap-6 pb-1.5 md:pb-2.5 border-b border-gray-300">
                    {{-- Feature 1 --}}
                    <div class="flex items-center gap-4 group cursor-default bg-transparent hover:bg-white p-2 lg:p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-[#e0ebe5] hover:shadow-sm">
                        <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-sm border border-gray-100 text-[#0b5c9a] group-hover:bg-[#0b5c9a] group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.514"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-[16px] mb-0.5 tracking-tight group-hover:text-[#0b5c9a] transition-colors whitespace-nowrap">BEST QUALITY</h4>
                            <p class="text-[14px] text-gray-500 whitespace-nowrap">Many years on the market</p>
                        </div>
                    </div>
                    
                    {{-- Feature 2 --}}
                    <div class="flex items-center gap-4 group cursor-default bg-transparent hover:bg-white p-2 lg:p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-[#e0ebe5] hover:shadow-sm">
                        <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-sm border border-gray-100 text-[#0b5c9a] group-hover:bg-[#0b5c9a] group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-[16px] mb-0.5 tracking-tight group-hover:text-[#0b5c9a] transition-colors whitespace-nowrap">24/7 SUPPORT</h4>
                            <p class="text-[14px] text-gray-500 whitespace-nowrap">If you have any questions</p>
                        </div>
                    </div>
                    
                    {{-- Feature 3 --}}
                    <div class="flex items-center gap-4 group cursor-default bg-transparent hover:bg-white p-2 lg:p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-[#e0ebe5] hover:shadow-sm">
                        <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-sm border border-gray-100 text-[#0b5c9a] group-hover:bg-[#0b5c9a] group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-[16px] mb-0.5 tracking-tight group-hover:text-[#0b5c9a] transition-colors whitespace-nowrap">SECURE PAYMENT</h4>
                            <p class="text-[14px] text-gray-500 whitespace-nowrap">100% secure payment</p>
                        </div>
                    </div>

                    {{-- Feature 4 --}}
                    <div class="flex items-center gap-4 group cursor-default bg-transparent hover:bg-white p-2 lg:p-3 rounded-xl transition-all duration-300 border border-transparent hover:border-[#e0ebe5] hover:shadow-sm">
                        <div class="flex-shrink-0 w-12 h-12 flex items-center justify-center rounded-full bg-white shadow-sm border border-gray-100 text-[#0b5c9a] group-hover:bg-[#0b5c9a] group-hover:text-white group-hover:scale-110 transition-all duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 21.033A3 3 0 1111 18h2a3 3 0 113.89 2.89M3 13V6a1 1 0 011-1h10a1 1 0 011 1v12a1 1 0 01-1 1h-2M15 9h3l3 4v5h-2"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-[16px] mb-0.5 tracking-tight group-hover:text-[#0b5c9a] transition-colors whitespace-nowrap">FAST DELIVERY</h4>
                            <p class="text-[14px] text-gray-500 whitespace-nowrap">Fast and reliable delivery</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px] pt-6 md:pt-8 pb-16 md:pb-12">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-x-4 gap-y-8 lg:gap-8 xl:gap-12">
                {{-- Brand --}}
                <div class="col-span-2 lg:col-span-1 order-1 lg:order-1">
                    <div class="mb-5 transform scale-[1.3] origin-left">
                        <x-logo theme="light" />
                    </div>
                    <p class="text-gray-600 text-[15px] leading-relaxed pr-4">
                        One of Bangladesh's premier electronic component stores. We provide high-quality electronic parts, sensors, modules, and tools at highly affordable prices with fast delivery.
                    </p>
                    
                    {{-- Social Icons --}}
                    <div class="flex gap-4 mt-6">
                        <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-[#f0f9f4] text-[#0b5c9a] hover:bg-[#0b5c9a] hover:text-white transition-colors" title="Facebook">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.597 0 0 .597 0 1.325v21.351C0 23.403.597 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.73 0 1.323-.597 1.323-1.324V1.325C24 .597 23.403 0 22.675 0z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-[#f0f9f4] text-[#ff0000] hover:bg-[#ff0000] hover:text-white transition-colors" title="YouTube">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-[#f0f9f4] text-[#25D366] hover:bg-[#25D366] hover:text-white transition-colors" title="WhatsApp">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-[#f0f9f4] text-[#1DA1F2] hover:bg-[#1DA1F2] hover:text-white transition-colors" title="Twitter">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-12 h-12 flex items-center justify-center rounded-full bg-[#f0f9f4] text-[#E1306C] hover:bg-[#E1306C] hover:text-white transition-colors" title="Instagram">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="col-span-1 lg:col-span-1 order-3 lg:order-2 justify-self-start lg:justify-self-center">
                    <h4 class="font-bold text-gray-800 text-[16px] mb-4">Quick Links</h4>
                    <ul class="space-y-3.5 text-[15px] text-gray-600">
                        <li class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#0b5c9a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <a href="{{ route('shop') }}" class="hover:text-[#0b5c9a] transition-colors">Shop</a>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#0b5c9a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <a href="{{ route('home') }}#flash-sales" class="hover:text-[#0b5c9a] transition-colors">Flash Sale</a>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#0b5c9a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <a href="#" class="hover:text-[#0b5c9a] transition-colors">About Us</a>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#0b5c9a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <a href="#" class="hover:text-[#0b5c9a] transition-colors">Contact</a>
                        </li>
                    </ul>
                </div>

                {{-- Customer Service --}}
                <div class="col-span-1 lg:col-span-1 order-4 lg:order-3 justify-self-start lg:justify-self-center">
                    <h4 class="font-bold text-gray-800 text-[16px] mb-4">Customer Service</h4>
                    <ul class="space-y-3.5 text-[15px] text-gray-600">
                        <li class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#0b5c9a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <a href="#" class="hover:text-[#0b5c9a] transition-colors">Shipping Policy</a>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#0b5c9a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <a href="#" class="hover:text-[#0b5c9a] transition-colors">Return Policy</a>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#0b5c9a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <a href="#" class="hover:text-[#0b5c9a] transition-colors">Privacy Policy</a>
                        </li>
                        <li class="flex items-center gap-1.5">
                            <svg class="w-3.5 h-3.5 text-[#0b5c9a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            <a href="#" class="hover:text-[#0b5c9a] transition-colors">Terms & Conditions</a>
                        </li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div class="col-span-2 lg:col-span-1 order-2 lg:order-4 justify-self-start lg:justify-self-center w-full">
                    <h4 class="font-bold text-gray-800 text-[16px] mb-4">Contact Us</h4>
                    <ul class="space-y-3 text-[15px] text-gray-600">
                        <li class="flex items-center gap-2 group">
                            <svg class="w-4 h-4 text-[#0b5c9a] shrink-0 group-hover:scale-125 transition-transform duration-300" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <a href="tel:{{ str_replace(' ', '', \App\Models\Setting::get('support_phone', '+8801880223099')) }}" class="group-hover:text-[#0b5c9a] group-hover:translate-x-1.5 transition-all duration-300">{{ \App\Models\Setting::get('support_phone', '+8801880223099') }}</a>
                        </li>
                        <li class="flex items-center gap-2 group">
                            <svg class="w-4 h-4 text-[#25D366] shrink-0 group-hover:scale-125 transition-transform duration-300" style="width: 16px; height: 16px;" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <a href="https://wa.me/{{ str_replace(['+', ' '], '', \App\Models\Setting::get('whatsapp_number', '8801880223099')) }}" target="_blank" class="group-hover:text-[#25D366] group-hover:translate-x-1.5 transition-all duration-300">+{{ ltrim(\App\Models\Setting::get('whatsapp_number', '8801880223099'), '+') }}</a>
                        </li>
                        <li class="flex items-center gap-2 group">
                            <svg class="w-4 h-4 text-[#0b5c9a] shrink-0 group-hover:scale-125 transition-transform duration-300" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:{{ \App\Models\Setting::get('support_email', 'support@electrohome.bd') }}" class="group-hover:text-[#0b5c9a] group-hover:translate-x-1.5 transition-all duration-300">{{ \App\Models\Setting::get('support_email', 'support@electrohome.bd') }}</a>
                        </li>
                        <li class="flex items-start gap-2 pt-1.5 w-full">
                            <svg class="w-5 h-5 text-[#0b5c9a] shrink-0 mt-0.5" style="width: 20px; height: 20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            <div class="leading-relaxed flex-1 w-full max-w-full pr-2">
                                <a href="https://maps.google.com/?q=Station+Road,+Narsingdi+Sadar,+Narsingdi" target="_blank" class="hover:text-[#0b5c9a] transition-colors block">
                                    <span class="font-bold text-gray-800 block mb-0.5">Address:</span>
                                    Station Road, Narsingdi Sadar, Narsingdi
                                </a>
                            </div>
                        </li>
                        {{-- Get Direction Button (Desktop Only) --}}
                        <li class="hidden md:block pt-1.5">
                            <a href="https://maps.google.com/?q=Station+Road,+Narsingdi+Sadar,+Narsingdi" target="_blank" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md text-base font-bold transition-colors shadow-md">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                                Get Direction
                            </a>
                        </li>
                    </ul>

                    {{-- Google Map Box & Get Direction (Mobile Only) --}}
                    <div class="md:hidden mt-4 w-full rounded-lg overflow-hidden relative bg-gray-100 border border-gray-200 shadow-sm h-[160px] group">
                        <iframe width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=Station+Road,+Narsingdi+Sadar,+Narsingdi&t=&z=15&ie=UTF8&iwloc=&output=embed" style="border:0;" loading="lazy"></iframe>
                        
                        <a href="https://maps.google.com/?q=Station+Road,+Narsingdi+Sadar,+Narsingdi" target="_blank" class="absolute top-2.5 right-2.5 flex items-center gap-1.5 bg-white/90 backdrop-blur hover:bg-blue-600 hover:text-white text-blue-700 py-2 px-4 rounded-md shadow-md text-[13px] font-bold transition-all border border-gray-200 z-10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
                            Get Direction
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-[#e0ebe5] mt-8 md:mt-10 pt-6 md:pt-8 text-center text-sm text-gray-500">
                © {{ date('Y') }} Electrohome.bd — All Rights Reserved.
            </div>
        </div>
    </footer>

    {{-- Mobile Bottom Navigation --}}
    <nav class="mobile-nav md:!hidden lg:!hidden print:hidden">
        <a href="{{ route('home') }}" class="mobile-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span>Home</span>
        </a>
        <a href="{{ route('shop', ['v' => 2]) }}" class="mobile-nav-item {{ request()->routeIs('shop') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            <span>Shop</span>
        </a>
        <a href="{{ route('cart', ['v' => 2]) }}" id="mobile-bottom-cart" class="mobile-nav-item {{ request()->routeIs('cart') ? 'active' : '' }} relative" x-data="{ cartCount: {{ app(\App\Services\CartService::class)->getCount() }} }" @cart-updated-optimistic.window="cartCount += $event.detail.qty_change" @cart-updated.window="if($event.detail.count !== undefined) { cartCount = $event.detail.count; }">
            <div class="relative inline-block animate-cart-dance">
                <svg class="w-5 h-5" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 7C12 7.55 11.55 8 11 8C10.45 8 10 7.55 10 7V5H8C7.45 5 7 4.55 7 4C7 3.45 7.45 3 8 3H10V1C10 0.45 10.45 0 11 0C11.55 0 12 0.45 12 1V3H14C14.55 3 15 3.45 15 4C15 4.55 14.55 5 14 5H12V7ZM4.01 19C4.01 17.9 4.9 17 6 17C7.1 17 8 17.9 8 19C8 20.1 7.1 21 6 21C4.9 21 4.01 20.1 4.01 19ZM16 17C14.9 17 14.01 17.9 14.01 19C14.01 20.1 14.9 21 16 21C17.1 21 18 20.1 18 19C18 17.9 17.1 17 16 17ZM14.55 12H7.1L6 14H17C17.55 14 18 14.45 18 15C18 15.55 17.55 16 17 16H6C4.48 16 3.52 14.37 4.25 13.03L5.6 10.59L2 3H1C0.45 3 0 2.55 0 2C0 1.45 0.45 1 1 1H2.64C3.02 1 3.38 1.22 3.54 1.57L7.53 10H14.55L17.94 3.87C18.2 3.39 18.81 3.22 19.29 3.48C19.77 3.75 19.95 4.36 19.68 4.84L16.3 10.97C15.96 11.59 15.3 12 14.55 12Z" fill="currentColor"/></svg>
                <span x-show="cartCount > 0" x-text="cartCount" wire:ignore class="absolute text-red-600 font-bold flex items-center justify-center" style="display: none; top: -8px; right: 18px; font-size: 22px; line-height: 1;">
                    {{ app(\App\Services\CartService::class)->getCount() }}
                </span>
            </div>
            <span>Cart</span>
        </a>
        <a href="{{ route('wishlist', ['v' => 2]) }}" class="mobile-nav-item {{ request()->routeIs('wishlist') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            <span>Wishlist</span>
        </a>
        <a href="{{ auth()->check() ? route('dashboard', ['v' => 2]) : route('login', ['v' => 2]) }}" class="mobile-nav-item">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span>Profile</span>
        </a>
    </nav>

    {{-- Floating Action Buttons (WhatsApp, Scroll Up, Scroll Down) --}}
    <div class="fixed bottom-[90px] md:bottom-8 right-4 md:right-10 z-[70] flex flex-col items-center gap-2 md:gap-3 print:hidden">
        
        {{-- WhatsApp Floating Button --}}
        <a href="https://wa.me/{{ str_replace('+', '', \App\Models\Setting::get('whatsapp_number', '8801880223099')) }}"
           target="_blank" rel="noopener"
           class="flex items-center justify-center hover:scale-110 transition-transform duration-300" title="Chat on WhatsApp">
            <svg class="w-10 h-10 md:w-12 md:h-12 text-[#25D366] hover:text-[#128C7E] drop-shadow-md transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        </a>

        {{-- Scroll to Top Button --}}
        <button x-data @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="hidden md:flex w-12 h-12 bg-[#0b5c9a]/50 backdrop-blur-md border border-white/30 hover:bg-[#0b5c9a]/70 rounded-full items-center justify-center shadow-[0_4px_30px_rgba(0,0,0,0.1)] text-white transition-all duration-300"
                title="Scroll to Top">
            <svg class="w-6 h-6 animate-float-up drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
        </button>

        {{-- Scroll Down Button --}}
        <button x-data @click="window.scrollBy({top: 600, behavior: 'smooth'})"
                class="hidden md:flex w-12 h-12 bg-[#0b5c9a]/50 backdrop-blur-md border border-white/30 hover:bg-[#0b5c9a]/70 rounded-full items-center justify-center shadow-[0_4px_30px_rgba(0,0,0,0.1)] text-white transition-all duration-300"
                title="Scroll Down">
            <svg class="w-6 h-6 animate-float-down drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </button>

    </div>

    {{-- Floating Cart --}}
    <div class="print:hidden">
        @livewire('floating-cart')
    </div>

    @livewireScripts

    <script>
        document.addEventListener('alpine:init', () => {
            window.addEventListener('fly-to-cart', function(e) {
                const button = e.detail.button;
                if (!button) return;
                
                const card = button.closest('.product-card, .product-details-container');
                if (!card) return;
                
                const img = card.querySelector('.fly-target-image') || card.querySelector('img');
                if (!img) return;
                
                let targetIcon = null;
                if (window.innerWidth < 768) {
                    targetIcon = document.getElementById('mobile-bottom-cart');
                } else {
                    targetIcon = document.getElementById('desktop-floating-cart'); 
                }
                
                if (!targetIcon) return;
                const clone = document.createElement('img');
                clone.src = img.src;
                if (img.className) clone.className = img.className;
                
                const imgRect = img.getBoundingClientRect();
                const targetRect = targetIcon.getBoundingClientRect();
                
                const imgCenterX = imgRect.left + imgRect.width / 2;
                const imgCenterY = imgRect.top + imgRect.height / 2;
                
                const targetCenterX = targetRect.left + targetRect.width / 2;
                const targetCenterY = targetRect.top + targetRect.height / 2;
                
                const deltaX = targetCenterX - imgCenterX;
                const deltaY = targetCenterY - imgCenterY;
                
                const isMobile = window.innerWidth < 768;
                const cpX = deltaX * 0.5;
                const cpY = Math.min(0, deltaY) - (isMobile ? 250 : 150); 
                
                const frames = [];
                const steps = 30;
                for (let i = 0; i <= steps; i++) {
                    const t = i / steps;
                    const x = (1-t)*(1-t)*0 + 2*(1-t)*t*cpX + t*t*deltaX;
                    const y = (1-t)*(1-t)*0 + 2*(1-t)*t*cpY + t*t*deltaY;
                    
                    let scale;
                    if (t < 0.2) {
                        scale = 1 + (t / 0.2) * 0.05; // 1 to 1.05
                    } else {
                        const t2 = (t - 0.2) / 0.8;
                        scale = 1.05 - (t2 * 0.95); // 1.05 to 0.1
                    }
                    
                    const rotate = Math.sin(t * Math.PI) * 15; // Smooth tilt up to 15 degrees
                    
                    const opacity = t > 0.8 ? 1 - ((t - 0.8) / 0.2) : 1;
                    
                    frames.push({
                        transform: `translate(${x}px, ${y}px) scale(${scale}) rotate(${rotate}deg)`,
                        opacity: opacity
                    });
                }
                
                clone.style.position = 'fixed';
                clone.style.left = imgRect.left + 'px';
                clone.style.top = imgRect.top + 'px';
                clone.style.width = imgRect.width + 'px';
                clone.style.height = imgRect.height + 'px';
                clone.style.zIndex = '99999';
                clone.style.objectFit = 'contain';
                clone.style.pointerEvents = 'none';
                clone.style.transformOrigin = 'center center';
                clone.style.filter = 'drop-shadow(0 15px 25px rgba(0,0,0,0.4))';
                
                document.body.appendChild(clone);
                
                const animation = clone.animate(frames, {
                    duration: 1200,
                    easing: 'ease-in-out',
                    fill: 'forwards'
                });
                
                animation.onfinish = () => {
                    clone.remove();
                    const iconContainer = targetIcon.querySelector('.animate-cart-dance') || targetIcon;
                    iconContainer.style.transition = 'transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    iconContainer.style.transform = 'scale(1.3)';
                    setTimeout(() => {
                        iconContainer.style.transform = 'scale(1)';
                    }, 300);
                };
            });
        });
    </script>
</body>
</html>
