<div class="custom-user-menu" style="display: flex; align-items: center; justify-content: flex-end; font-family: 'Inter', system-ui, sans-serif; gap: 8px;">
    <!-- Name & Designation -->
    <div class="user-details" style="display: flex; flex-direction: column; align-items: flex-end; justify-content: center; text-align: right;">
        <span style="font-size: 0.9rem; font-weight: 600; color: #111827; line-height: 1.1;">{{ filament()->auth()->user()->name }}</span>
        @php
            $role = filament()->auth()->user()->role ?? 'admin';
            $designation = match($role) {
                'super_admin' => 'Administrator',
                'admin' => 'Admin',
                'manager' => 'Manager',
                default => 'Administrator'
            };
        @endphp
        <span style="font-size: 0.55rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 4px;">{{ $designation }}</span>
    </div>
    
    <!-- Avatar -->
    <div style="display: flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 50%; background-color: #f3f4f6; overflow: hidden; border: 2px solid #e5e7eb; flex-shrink: 0;">
        @if(filament()->auth()->user()->avatar)
            <img src="{{ Storage::url(filament()->auth()->user()->avatar) }}" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
        @else
            <svg style="width: 20px; height: 20px; color: #9ca3af;" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        @endif
    </div>

    <!-- Divider -->
    <div style="height: 24px; width: 1px; background-color: #d1d5db; margin: 0 4px;"></div>

    <!-- Sign Out -->
    <form method="POST" action="{{ filament()->getLogoutUrl() }}" style="margin: 0;">
        @csrf
        <button type="submit" style="background-color: transparent; border: none; padding: 4px; font-size: 0.8rem; font-weight: 600; color: #ef4444; cursor: pointer; display: flex; align-items: center; gap: 4px; transition: all 0.2s;">
            <svg style="width: 1.2rem; height: 1.2rem; stroke-width: 2;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <span class="sign-out-text">Sign out</span>
        </button>
    </form>
</div>

<style>
    /* Hide the default Filament User Menu avatar */
    .fi-user-menu-trigger {
        display: none !important;
    }

    /* Style the notification bell */
    .fi-topbar-database-notifications-btn {
        background-color: #f3f4f6 !important;
        border-radius: 50% !important;
        padding: 0.4rem !important;
        margin-right: 0.5rem !important;
        transition: all 0.2s ease !important;
        border: 1px solid #e5e7eb !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    .fi-topbar-database-notifications-btn svg {
        color: #3b82f6 !important;
        stroke-width: 2 !important;
        width: 1.2rem !important;
        height: 1.2rem !important;
    }
    .fi-topbar-database-notifications-btn .fi-badge {
        color: #ef4444 !important;
        font-weight: 600 !important;
        font-size: 0.75rem !important;
        background: transparent !important;
        box-shadow: none !important;
    }
    .fi-topbar-database-notifications-btn .fi-icon-btn-badge-ctn {
        background: transparent !important;
    }

    /* --- RESPONSIVE LAYOUT RULES --- */
    
    /* MOBILE STYLES (Max-width 1023px) */
    @media (max-width: 1023px) {
        /* Make the topbar wrap so search can go to the next line */
        .fi-topbar nav {
            flex-wrap: wrap !important;
            height: auto !important;
            padding-bottom: 10px !important;
            padding-top: 10px !important;
        }

        /* The flex container that holds the search bar */
        .fi-topbar-global-search {
            order: 3 !important; /* Move search to the bottom row */
            width: 100% !important;
            max-width: 100% !important;
            flex: 0 0 100% !important;
            margin-top: 10px !important;
        }
        
        .fi-global-search-field, .fi-global-search-ctn {
            width: 100% !important;
            max-width: 100% !important;
        }
        
        .fi-global-search-input {
            width: 100% !important;
            border-radius: 8px !important;
        }

        /* Adjust user menu items to fit on small screen */
        .custom-user-menu {
            gap: 4px !important;
        }
        
        .user-details {
            display: none !important; /* Hide name on very small screens to fit signout */
        }
        
        .sign-out-text {
            display: none !important; /* Just show the icon to save space */
        }
    }

    /* DESKTOP STYLES (Min-width 1024px) */
    @media (min-width: 1024px) {
        .fi-topbar nav {
            height: 4.5rem !important;
        }

        .fi-topbar-global-search {
            position: absolute !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            width: 350px !important;
        }

        .fi-global-search-input {
            border-radius: 9999px !important;
            padding: 0.6rem 1rem !important;
        }
        
        .fi-topbar-database-notifications-btn {
            transform: scale(1.2) !important;
            margin-right: 1.5rem !important;
            padding: 0.5rem !important;
        }
    }
</style>
