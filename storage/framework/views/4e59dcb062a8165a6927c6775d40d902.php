<div style="display: flex; align-items: center; gap: 1.5rem; margin-right: 0.5rem; font-family: 'Inter', system-ui, sans-serif;">
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
        <span style="font-size: 1.25rem; font-weight: 600; color: #111827; letter-spacing: -0.01em; line-height: 1.1;"><?php echo e(filament()->auth()->user()->name); ?></span>
        <?php
            $role = filament()->auth()->user()->role ?? 'admin';
            $designation = match($role) {
                'super_admin' => 'Administrator',
                'admin' => 'Admin',
                'manager' => 'Manager',
                default => 'Administrator'
            };
        ?>
        <span style="font-size: 0.55rem; font-weight: 700; color: #6b7280; text-transform: uppercase; letter-spacing: 0.15em; margin-top: 6px;"><?php echo e($designation); ?></span>
    </div>
    
    <div style="display: flex; align-items: center; justify-content: center; width: 42px; height: 42px; border-radius: 9999px; background-color: #f3f4f6; overflow: hidden; border: 2px solid #e5e7eb; flex-shrink: 0;">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(filament()->auth()->user()->avatar): ?>
            <img src="<?php echo e(Storage::url(filament()->auth()->user()->avatar)); ?>" alt="Avatar" style="width: 100%; height: 100%; object-fit: cover;">
        <?php else: ?>
            <svg style="width: 24px; height: 24px; color: #9ca3af;" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div style="height: 38px; width: 2px; background-color: #d1d5db; border-radius: 9999px; margin-left: 0.5rem; margin-right: 0.5rem;"></div>

    <form method="POST" action="<?php echo e(filament()->getLogoutUrl()); ?>" style="margin: 0;">
        <?php echo csrf_field(); ?>
        <button type="submit" style="background-color: #ffffff; border: 1px solid #fca5a5; padding: 0.5rem 1.25rem; border-radius: 9999px; font-size: 0.9rem; font-weight: 600; color: #ef4444; cursor: pointer; display: flex; align-items: center; gap: 0.4rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); transition: all 0.2s;">
            <svg style="width: 1.2rem; height: 1.2rem; stroke-width: 2.5;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Sign out
        </button>
    </form>
</div>

<style>
    /* Make the entire topbar thicker/taller */
    .fi-topbar nav {
        height: 5rem !important; /* Increased from default 4rem (64px) to 5rem (80px) */
    }

    /* Hide the default Filament User Menu avatar */
    .fi-user-menu-trigger {
        display: none !important;
    }
    
    /* Center the global search box perfectly in the middle of the screen */
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
        padding: 0.6rem !important;
        margin-right: 1.5rem !important;
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
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views/filament/hooks/user-menu.blade.php ENDPATH**/ ?>