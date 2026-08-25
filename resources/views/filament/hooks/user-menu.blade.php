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
        
        /* Center the global search box dynamically on DESKTOP without overlapping the user menu */
        .fi-global-search-ctn,
        .fi-topbar-global-search {
            display: flex !important;
            justify-content: center !important;
            width: 100% !important;
            max-width: 350px !important;
            margin: 0 auto !important;
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
        padding-top: 0.75rem !important; /* Reduced top space */
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
        font-size: 1.25rem !important; /* Made name larger */
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

    /* Custom Style for Sign Out button box */
    .fi-user-menu .fi-dropdown-list:last-child .fi-dropdown-list-item {
        background-color: #eaf7ec !important; /* Light green matching Dashboard header */
        border-radius: 0.5rem !important;
        padding-top: 0.6rem !important;
        padding-bottom: 0.6rem !important;
        transition: all 0.2s ease !important;
    }
    .fi-user-menu .fi-dropdown-list:last-child .fi-dropdown-list-item:hover {
        background-color: #d1eadd !important; /* Slightly darker on hover */
    }
    .fi-user-menu .fi-dropdown-list:last-child .fi-dropdown-list-item-label {
        font-size: 0.95rem !important; /* Bigger text */
        font-weight: 600 !important;
        color: #ef4444 !important; /* Making text red for sign out */
    }
    .fi-user-menu .fi-dropdown-list:last-child svg {
        color: #ef4444 !important; /* Red/Orange icon */
        width: 1.3rem !important;
        height: 1.3rem !important;
    }

    /* ========================================= */
    /* UNIFIED 40x40 EXACT SIZING FOR ALL TOPBAR ICONS */
    /* ========================================= */
    .fi-sidebar-mobile-overlay-btn,
    .fi-sidebar-collapse-btn,
    .fi-topbar-database-notifications-btn,
    .topbar-view-website-btn,
    .fi-user-menu-btn,
    .fi-user-menu-trigger .fi-avatar {
        width: 40px !important;
        height: 40px !important;
        min-width: 40px !important;
        min-height: 40px !important;
        max-width: 40px !important;
        max-height: 40px !important;
        border-radius: 50% !important;
        background-color: #f3f4f6 !important;
        border: 1px solid #e5e7eb !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transform: none !important;
        box-sizing: border-box !important;
        margin: 0 !important; /* Reset margins */
    }

    /* Ensure SVGs inside icons are exactly 20x20 */
    .fi-sidebar-mobile-overlay-btn svg,
    .fi-sidebar-collapse-btn svg,
    .fi-topbar-database-notifications-btn svg,
    .topbar-view-website-btn svg {
        width: 20px !important;
        height: 20px !important;
        margin: 0 !important;
    }

    /* Colors for icons */
    .fi-sidebar-mobile-overlay-btn svg, .fi-sidebar-collapse-btn svg { color: #4b5563 !important; }
    .fi-topbar-database-notifications-btn svg { color: #3b82f6 !important; stroke-width: 2 !important; }
    .topbar-view-website-btn svg { color: #4b5563 !important; }

    /* Fix Avatar image to fill its 40x40 border exactly */
    .fi-user-menu-btn img, .fi-avatar img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
    }

    /* Hover effects */
    .fi-sidebar-mobile-overlay-btn:hover,
    .fi-sidebar-collapse-btn:hover,
    .fi-topbar-database-notifications-btn:hover,
    .topbar-view-website-btn:hover {
        background-color: #e5e7eb !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
    }

    /* Style the Notification Badge */
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

    /* DESKTOP SPECIFIC STYLES (Overrides) */
    @media (min-width: 1024px) {
        .topbar-view-website-btn {
            display: none !important; /* Hide globe icon on desktop */
        }
        
        .fi-topbar-item-end, .fi-topbar > div:last-child {
            gap: 1rem !important;
        }
    }

    /* MOBILE SPECIFIC STYLES */
    @media (max-width: 1023px) {
        /* Hide our custom menu entirely on mobile, we will use default Filament menu popup */
        .custom-user-menu-container {
            display: none !important;
        }

        /* Make the gap between Bell, Avatar, Globe extremely small (reduce space) */
        .fi-topbar-item-end, .fi-topbar > div:last-child {
            gap: 0.35rem !important;
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
