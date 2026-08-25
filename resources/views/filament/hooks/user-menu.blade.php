<div class="custom-user-menu-container" style="display: flex; align-items: center; gap: 1rem; margin-right: 0.5rem; font-family: 'Inter', system-ui, sans-serif;">
    <div class="hide-on-mobile" style="display: flex; align-items: center; gap: 1.5rem;">
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
            <span style="font-size: 1.25rem; font-weight: 600; color: #111827; letter-spacing: -0.01em; line-height: 1.1;">{{ filament()->auth()->user()->name }}</span>
            @php
                $role = filament()->auth()->user()->role ?? 'admin';
                $designation = match($role) {
                    'super_admin' => 'Administrator',
                    'admin' => 'Admin',
                    'manager' => 'Manager',
                    default => 'Administrator'
                };
            @endphp
            <span style="font-size: 0.55rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.15em; margin-top: 6px;">{{ $designation }}</span>
        </div>
        
        <div style="display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 9999px; background-color: #f3f4f6; overflow: hidden; border: 2px solid #e5e7eb; flex-shrink: 0;">
            @if(filament()->auth()->user()->avatar)
                <img src="{{ Storage::url(filament()->auth()->user()->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
            @else
                <svg style="width: 24px; height: 24px; color: #9ca3af;" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            @endif
        </div>

        <div style="height: 38px; width: 2px; background-color: #d1d5db; border-radius: 9999px;"></div>
    </div>

    <form method="POST" action="{{ filament()->getLogoutUrl() }}" style="margin: 0;">
        @csrf
        <button type="submit" style="background-color: #ffffff; border: 1px solid #fca5a5; padding: 0.5rem 1rem; border-radius: 9999px; font-size: 0.9rem; font-weight: 600; color: #ef4444; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); transition: all 0.2s;">
            <svg style="width: 1.2rem; height: 1.2rem; stroke-width: 2.5;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="sign-out-text">Sign out</span>
        </button>
    </form>
</div>

<style>
    /* Make the entire topbar thicker/taller */
    .fi-topbar nav {
        height: 5rem !important; /* Increased from default 4rem (64px) to 5rem (80px) */
    }

    /* DESKTOP SPECIFIC STYLES */
    @media (min-width: 1024px) {
        /* Hide the default Filament User Menu avatar on desktop (we use custom one) */
        .fi-user-menu-trigger {
            display: none !important;
        }
        
        /* Center the global search box perfectly in the middle of the screen on DESKTOP */
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

    /* Hide the "System" monitor icon from theme switcher */
    .fi-theme-switcher-btn:nth-child(3) {
        display: none !important;
    }

    /* Format the popup user header and add designation below name using CSS */
    .fi-user-menu .fi-dropdown-header svg {
        display: none !important;
    }
    .fi-user-menu .fi-dropdown-header {
        justify-content: center !important;
        padding-top: 1.25rem !important;
        padding-bottom: 1rem !important;
        border-bottom: 1px solid #e5e7eb !important;
    }
    .fi-user-menu .fi-dropdown-header span {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        line-height: 1.2 !important;
        font-weight: 600 !important;
        color: #111827 !important;
        font-size: 1.1rem !important; /* Made name slightly bigger */
    }
    .fi-user-menu .fi-dropdown-header span::after {
        content: "{{ $designation }}";
        font-size: 0.75rem !important;
        color: #6b7280 !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.05em !important;
        margin-top: 6px !important;
    }

    /* MOBILE SPECIFIC STYLES */
    @media (max-width: 1023px) {
        /* Hide our custom menu entirely on mobile, we will use default Filament menu popup */
        .custom-user-menu-container {
            display: none !important;
        }
        
        /* Reduce right margins for mobile */
        .fi-topbar-database-notifications-btn {
            margin-right: 0.25rem !important;
        }

        /* The search bar after being moved by JS */
        .mobile-moved-search {
            width: 100% !important;
            padding-left: 0.25rem !important;
            padding-right: 0.25rem !important;
            margin-top: 0.5rem !important;
            margin-bottom: 0 !important;
            display: block !important;
        }
        .mobile-moved-search .fi-global-search-ctn {
            width: 100% !important;
        }
    }
    .fi-global-search-ctn input,
    .fi-topbar-global-search input {
        border-radius: 9999px !important;
        padding-top: 0.7rem !important;
        padding-bottom: 0.7rem !important;
        font-size: 1rem !important;
        text-align: left !important;
        padding-left: 1rem !important;
    }

    /* Style the notification bell to look modern and bigger */
    .fi-topbar-database-notifications-btn {
        background-color: #f3f4f6 !important;
        border-radius: 50% !important;
        padding: 0.6rem !important;
        margin-right: 1.5rem !important; /* Default for desktop */
        transition: all 0.2s ease !important;
        border: 1px solid #e5e7eb !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transform: scale(1.3) !important; /* Slightly reduced scale from 1.5 */
        transform-origin: center !important;
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

<script>
    function moveGlobalSearchBar() {
        if (window.innerWidth < 1024) {
            const searchBar = document.querySelector('.fi-global-search-ctn') || document.querySelector('.fi-topbar-global-search');
            const mainContent = document.querySelector('.fi-main');
            
            if (searchBar && mainContent && searchBar.parentElement !== mainContent) {
                // Move the search bar DOM element into the scrollable main content area
                searchBar.classList.add('mobile-moved-search');
                mainContent.insertBefore(searchBar, mainContent.firstChild);
            }
        }
    }
    
    document.addEventListener('DOMContentLoaded', moveGlobalSearchBar);
    document.addEventListener('livewire:navigated', moveGlobalSearchBar);
</script>
