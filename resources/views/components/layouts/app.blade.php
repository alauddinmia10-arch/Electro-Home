<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
<body class="bg-[var(--color-bg-secondary)] min-h-screen flex flex-col overflow-x-hidden">

    {{-- Top Bar --}}
    <div class="bg-[var(--color-text-primary)] text-white text-[13px] py-1.5 hidden md:block">
        <div class="max-w-[1440px] mx-auto px-4 xl:px-[70px] flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 shrink-0" style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    {{ \App\Models\Setting::get('support_phone', '+8801XXXXXXXXX') }}
                </span>
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
    <header class="bg-white border-b border-gray-100 relative z-50" x-data="{ mobileMenu: false }">
        <div class="max-w-[1440px] mx-auto px-4 xl:px-[70px]">
            <div class="flex items-center justify-between h-14 md:h-16">

                {{-- Logo --}}
                <x-logo theme="light" />

                {{-- Search Bar (Desktop) --}}
                <div class="hidden md:flex flex-1 max-w-xl mx-8">
                    @livewire('live-search')
                </div>

                {{-- Header Actions --}}
                <div class="flex items-center gap-2">
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

                    {{-- Mobile Menu Toggle --}}
                    <button class="md:hidden p-2 text-gray-600" @click="mobileMenu = !mobileMenu">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>

            {{-- Search Bar (Mobile) --}}
            <div class="md:hidden w-full">
                @livewire('live-search')
            </div>
        </div>

        {{-- Category Navigation (Desktop) --}}
        <nav class="hidden md:block border-t border-[#0b5c9a]/20 bg-[#0b5c9a]/15 backdrop-blur-md sticky top-0 z-40">
            <div class="max-w-[1440px] mx-auto px-4 xl:px-[70px]">
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
                            <div class="w-[280px] bg-white rounded py-2 overflow-y-auto custom-scrollbar shrink-0" style="height: 550px; max-height: 80vh; border: 1px solid rgba(11, 92, 154, 0.2); box-shadow: 0 0 10px rgba(11, 92, 154, 0.2);" dir="rtl">
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
        <div class="max-w-[1440px] mx-auto px-4 xl:px-[70px] mt-4">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-[1440px] mx-auto px-4 xl:px-[70px] mt-4">
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
    <footer class="bg-[var(--color-text-primary)] text-white mt-auto">
        <div class="max-w-[1440px] mx-auto px-4 xl:px-[70px] py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                {{-- Brand --}}
                <div>
                    <div class="mb-4">
                        <x-logo theme="dark" />
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        বাংলাদেশের প্রিমিয়াম ইলেকট্রনিক্স কম্পোনেন্ট স্টোর। সেরা মানের প্রোডাক্ট, দ্রুত ডেলিভারি।
                    </p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="{{ route('shop') }}" class="hover:text-white transition-colors">Shop</a></li>
                        <li><a href="{{ route('home') }}#flash-sales" class="hover:text-white transition-colors">Flash Sale</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                {{-- Customer Service --}}
                <div>
                    <h4 class="font-semibold mb-4">Customer Service</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Shipping Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Return Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms & Conditions</a></li>
                    </ul>
                </div>

                {{-- Contact Info --}}
                <div>
                    <h4 class="font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[var(--color-trust-blue)] shrink-0" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            {{ \App\Models\Setting::get('support_phone', '+8801XXXXXXXXX') }}
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-[var(--color-trust-blue)] shrink-0" style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            {{ \App\Models\Setting::get('support_email', 'support@electrohome.bd') }}
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-sm text-gray-500">
                © {{ date('Y') }} Electrohome.bd — All Rights Reserved.
            </div>
        </div>
    </footer>

    {{-- Mobile Bottom Navigation --}}
    <nav class="mobile-nav md:!hidden lg:!hidden">
        <a href="{{ route('home') }}" class="mobile-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span>Home</span>
        </a>
        <a href="{{ route('shop', ['v' => 2]) }}" class="mobile-nav-item {{ request()->routeIs('shop') ? 'active' : '' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            <span>Shop</span>
        </a>
        <a href="{{ route('cart', ['v' => 2]) }}" class="mobile-nav-item {{ request()->routeIs('cart') ? 'active' : '' }} relative" x-data="{ cartCount: {{ app(\App\Services\CartService::class)->getCount() }} }" @cart-updated-optimistic.window="cartCount += $event.detail.qty_change" @cart-updated.window="if($event.detail.count !== undefined) { cartCount = $event.detail.count; }">
            <div class="relative inline-block animate-cart-dance">
                <svg class="w-5 h-5" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 7C12 7.55 11.55 8 11 8C10.45 8 10 7.55 10 7V5H8C7.45 5 7 4.55 7 4C7 3.45 7.45 3 8 3H10V1C10 0.45 10.45 0 11 0C11.55 0 12 0.45 12 1V3H14C14.55 3 15 3.45 15 4C15 4.55 14.55 5 14 5H12V7ZM4.01 19C4.01 17.9 4.9 17 6 17C7.1 17 8 17.9 8 19C8 20.1 7.1 21 6 21C4.9 21 4.01 20.1 4.01 19ZM16 17C14.9 17 14.01 17.9 14.01 19C14.01 20.1 14.9 21 16 21C17.1 21 18 20.1 18 19C18 17.9 17.1 17 16 17ZM14.55 12H7.1L6 14H17C17.55 14 18 14.45 18 15C18 15.55 17.55 16 17 16H6C4.48 16 3.52 14.37 4.25 13.03L5.6 10.59L2 3H1C0.45 3 0 2.55 0 2C0 1.45 0.45 1 1 1H2.64C3.02 1 3.38 1.22 3.54 1.57L7.53 10H14.55L17.94 3.87C18.2 3.39 18.81 3.22 19.29 3.48C19.77 3.75 19.95 4.36 19.68 4.84L16.3 10.97C15.96 11.59 15.3 12 14.55 12Z" fill="currentColor"/></svg>
                <span x-show="cartCount > 0" x-text="cartCount" wire:ignore class="absolute text-red-600 font-bold flex items-center justify-center" style="display: none; top: -8px; right: -10px; font-size: 22px; line-height: 1;">
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
    <div class="fixed bottom-20 md:bottom-6 right-4 md:right-6 z-30 flex flex-col items-center gap-2 md:gap-3">
        
        {{-- WhatsApp Floating Button --}}
        <a href="https://wa.me/{{ str_replace('+', '', \App\Models\Setting::get('whatsapp_number', '8801XXXXXXXXX')) }}"
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
    @livewire('floating-cart')

    @livewireScripts
</body>
</html>
