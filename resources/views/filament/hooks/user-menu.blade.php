<div class="flex items-center gap-2 md:gap-6 mr-1 md:mr-2 font-inter">
    <div class="hidden md:flex flex-col items-center justify-center">
        <span class="text-xl font-semibold text-gray-900 tracking-tight leading-tight">{{ filament()->auth()->user()->name }}</span>
        @php
            $role = filament()->auth()->user()->role ?? 'admin';
            $designation = match($role) {
                'super_admin' => 'Administrator',
                'admin' => 'Admin',
                'manager' => 'Manager',
                default => 'Administrator'
            };
        @endphp
        <span class="text-[0.55rem] font-bold text-gray-500 uppercase tracking-[0.15em] mt-1.5">{{ $designation }}</span>
    </div>
    
    <div class="hidden md:flex items-center justify-center w-[42px] h-[42px] rounded-full bg-gray-100 overflow-hidden border-2 border-gray-200 shrink-0">
        @if(filament()->auth()->user()->avatar)
            <img src="{{ Storage::url(filament()->auth()->user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
        @else
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        @endif
    </div>

    <div class="hidden md:block h-[38px] w-[2px] bg-gray-300 rounded-full mx-2"></div>

    <form method="POST" action="{{ filament()->getLogoutUrl() }}" class="m-0">
        @csrf
        <button type="submit" class="bg-white border border-red-300 md:px-5 px-2 py-1.5 md:py-2 rounded-full text-xs md:text-sm font-semibold text-red-500 hover:bg-red-50 hover:text-red-600 transition-all flex items-center gap-1 md:gap-2 shadow-sm">
            <svg class="w-4 h-4 md:w-5 md:h-5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="hidden sm:inline">Sign out</span>
        </button>
    </form>
</div>

<style>
    /* Make the entire topbar thicker/taller */
    .fi-topbar nav {
        height: 4rem !important; /* Reverted to 4rem for mobile */
    }
    @media (min-width: 1024px) {
        .fi-topbar nav {
            height: 5rem !important; 
        }
    }

    /* Hide the default Filament User Menu avatar */
    .fi-user-menu-trigger {
        display: none !important;
    }
    
    /* Center the global search box perfectly in the middle of the screen ON DESKTOP */
    @media (min-width: 1024px) {
        .fi-global-search-ctn,
        .fi-topbar-global-search {
            position: absolute !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            display: flex !important;
            justify-content: center !important;
            width: 100% !important;
            max-width: 350px !important;
            z-index: 10;
        }
        .fi-global-search-ctn > div,
        .fi-topbar-global-search > div {
            width: 100% !important;
        }
    }

    .fi-global-search-ctn input,
    .fi-topbar-global-search input {
        border-radius: 9999px !important;
        padding-top: 0.6rem !important;
        padding-bottom: 0.6rem !important;
        font-size: 1rem !important;
        text-align: left !important;
        padding-left: 1rem !important;
    }

    /* Style the notification bell to look modern and bigger */
    .fi-topbar-database-notifications-btn {
        background-color: #f3f4f6 !important;
        border-radius: 50% !important;
        padding: 0.5rem !important;
        margin-right: 0.5rem !important;
        transition: all 0.2s ease !important;
        border: 1px solid #e5e7eb !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transform: scale(1.1) !important;
        transform-origin: center !important;
    }
    
    @media (min-width: 1024px) {
        .fi-topbar-database-notifications-btn {
            padding: 0.6rem !important;
            margin-right: 1.5rem !important;
            transform: scale(1.3) !important;
        }
    }

    .fi-topbar-database-notifications-btn:hover {
        background-color: #e5e7eb !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
    }
    .fi-topbar-database-notifications-btn svg {
        color: #3b82f6 !important;
        stroke-width: 2 !important;
    }
    .fi-topbar-database-notifications-btn .fi-badge,
    .fi-topbar-database-notifications-btn .fi-badge *,
    .fi-topbar-database-notifications-btn .fi-icon-btn-badge-ctn {
        background: transparent !important;
        background-color: transparent !important;
        box-shadow: none !important;
        border: none !important;
        --tw-ring-shadow: 0 0 #0000 !important;
        --tw-ring-color: transparent !important;
    }
    .fi-topbar-database-notifications-btn .fi-badge {
        color: #ef4444 !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
    }
</style>
