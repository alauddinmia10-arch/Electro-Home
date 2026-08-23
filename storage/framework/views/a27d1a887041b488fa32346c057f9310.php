<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? 'Electrohome.bd — Premium Electronics Components Store'); ?></title>
    <meta name="description" content="<?php echo e($metaDescription ?? 'বাংলাদেশের অন্যতম প্রিমিয়াম ইলেকট্রনিক্স কম্পোনেন্ট স্টোর। সার্কিট, সেন্সর, ব্যাটারি, চার্জার এবং আরও হাজারো প্রোডাক্ট।'); ?>">

    
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon-light.png')); ?>" media="(prefers-color-scheme: light)">
    <link rel="icon" type="image/png" href="<?php echo e(asset('favicon-dark.png')); ?>" media="(prefers-color-scheme: dark)">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('images/icon.webp')); ?>">
    <link rel="mask-icon" href="<?php echo e(asset('images/monochrome.webp')); ?>" color="#16A34A">

    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    
    <?php echo $__env->make('partials.facebook-pixel', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="bg-[var(--color-bg-secondary)] min-h-screen flex flex-col overflow-x-hidden">

    
    <div class="bg-[var(--color-text-primary)] text-white text-[13px] py-1.5 hidden md:block">
        <div class="max-w-[1600px] w-full mx-auto px-2 md:px-4 xl:px-[70px] flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 shrink-0" style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    <a href="https://wa.me/8801880223099" target="_blank" rel="noopener noreferrer" class="hover:text-[var(--color-trust-blue)] transition-colors">
                        +8801880223099
                    </a>
                </span>
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 shrink-0" style="width: 14px; height: 14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <?php echo e(\App\Models\Setting::get('support_email', 'support@electrohome.bd')); ?>

                </span>
            </div>
            <div class="flex items-center gap-3">
                <span>🚚 ঢাকায় ডেলিভারি ৳৭০ | ঢাকার বাইরে ৳১৩০</span>
            </div>
        </div>
    </div>

    
    <header class="bg-white border-b border-gray-100 relative z-50" x-data="{ mobileMenu: false }">
        <div class="max-w-[1600px] w-full mx-auto px-2 md:px-4 xl:px-[70px]">
            <div class="flex items-center justify-between h-14 md:h-16">

                
                <button class="md:hidden p-2 -ml-2 text-gray-600 shrink-0" @click="mobileMenu = !mobileMenu">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                
                <div class="flex-1 md:flex-none flex justify-center md:justify-start">
                    <?php if (isset($component)) { $__componentOriginal987d96ec78ed1cf75b349e2e5981978f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.logo','data' => ['theme' => 'light']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['theme' => 'light']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $attributes = $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $component = $__componentOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
                </div>

                
                <div class="hidden md:flex flex-1 max-w-xl mx-8">
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('live-search');

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2641479324-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
                </div>

                
                <div class="flex items-center gap-2">
                    
                    <a href="<?php echo e(route('wishlist')); ?>" class="hidden md:flex flex-col items-center justify-center text-gray-600 hover:text-[var(--color-soft-coral)] transition-colors p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <span class="text-[12px] font-medium leading-none">Wishlist</span>
                    </a>

                    
                    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('cart-icon');

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2641479324-1', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

                    
                    <div x-data="{ open: false }" class="relative hidden md:block">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                            <button @click="open = !open" class="flex items-center gap-1.5 text-gray-600 hover:text-[var(--color-trust-blue)] transition-colors p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <span class="text-sm font-medium"><?php echo e(Auth::user()->name); ?></span>
                            </button>
                            <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded shadow-lg border border-gray-100 py-1 z-50">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user()->isStaff()): ?>
                                    <a href="<?php echo e(url('/admin')); ?>" class="block px-4 py-2 text-sm text-trust-blue font-semibold hover:bg-gray-50">⚙️ Admin Panel</a>
                                    <hr class="my-1">
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <a href="<?php echo e(route('dashboard')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">🏠 Dashboard</a>
                                <a href="<?php echo e(route('orders.index')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">📦 My Orders</a>
                                <a href="<?php echo e(route('wishlist')); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">❤️ Wishlist</a>
                                <hr class="my-1">
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">🚪 Logout</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn-neutral text-sm">
                                Login / Register
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                </div>
            </div>

            
            <div class="md:hidden w-full">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('live-search');

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2641479324-2', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
            </div>
        </div>

        
        <nav class="hidden md:block border-t border-[#0b5c9a]/20 bg-[#0b5c9a]/15 backdrop-blur-md sticky top-0 z-40">
            <div class="max-w-[1600px] w-full mx-auto px-2 md:px-4 xl:px-[70px]">
                <div class="flex items-stretch gap-6 h-9 text-sm">
                    <div x-data="{ open: false, activeCat: null, activeSubcat: null, flyoutTop: 0 }" @mouseenter="open = true" @mouseleave="open = false; activeCat = null; activeSubcat = null" class="relative h-full flex items-stretch">
                        <button class="h-full flex items-center gap-2.5 transition-all text-gray-800 font-bold text-sm md:text-base pr-4">
                            <div class="w-8 h-8 rounded-full bg-[#1f618d] flex items-center justify-center text-white shrink-0 shadow-sm my-auto">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                            </div>
                            <span>All Categories</span>
                            <svg class="w-4 h-4 text-gray-500 transition-transform ml-0.5" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>

                        
                        <div x-ref="menuWrapper" x-show="open" x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                             class="absolute left-0 top-full z-50 flex items-start">
                            
                            
                            <div class="w-[280px] bg-white rounded py-2 overflow-y-auto custom-scrollbar shrink-0" style="height: 780px; max-height: 85vh; border: 1px solid rgba(11, 92, 154, 0.2); box-shadow: 0 0 10px rgba(11, 92, 154, 0.2);" dir="rtl">
                                <div dir="ltr">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Category::parents()->active()->ordered()->with('children.children')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div @mouseenter="activeCat = <?php echo e($cat->id); ?>; activeSubcat = null; flyoutTop = $el.getBoundingClientRect().top - $refs.menuWrapper.getBoundingClientRect().top">
                                            <a href="<?php echo e(route('shop', ['category' => $cat->slug])); ?>" class="group flex items-center justify-between px-6 py-2.5 text-lg font-bold text-gray-700 hover:bg-gray-50 hover:text-[#094d82]" :class="activeCat === <?php echo e($cat->id); ?> ? 'bg-gray-50 text-[#094d82]' : ''">
                                                <div class="flex items-center gap-3">
                                                    <span class="flex items-center justify-center">
                                                        <?php if (isset($component)) { $__componentOriginal99e3095fe204bf0a105d1301124943c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99e3095fe204bf0a105d1301124943c8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.category-icon','data' => ['category' => $cat]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('category-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cat)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99e3095fe204bf0a105d1301124943c8)): ?>
<?php $attributes = $__attributesOriginal99e3095fe204bf0a105d1301124943c8; ?>
<?php unset($__attributesOriginal99e3095fe204bf0a105d1301124943c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99e3095fe204bf0a105d1301124943c8)): ?>
<?php $component = $__componentOriginal99e3095fe204bf0a105d1301124943c8; ?>
<?php unset($__componentOriginal99e3095fe204bf0a105d1301124943c8); ?>
<?php endif; ?>
                                                    </span>
                                                    <span class="truncate"><?php echo e($cat->name); ?></span>
                                                </div>
                                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cat->children->count() > 0): ?>
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            </a>
                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>

                            
                            <div class="relative ml-1">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Category::parents()->active()->ordered()->with('children.children')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cat->children->count() > 0): ?>
                                        <div x-show="activeCat === <?php echo e($cat->id); ?>" :style="{ top: flyoutTop + 'px' }" class="absolute left-0 w-[260px] bg-white rounded py-2 z-50 transition-all duration-150" style="border: 1px solid rgba(11, 92, 154, 0.2); box-shadow: 0 0 10px rgba(11, 92, 154, 0.2);">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cat->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <div @mouseenter="activeSubcat = <?php echo e($child->id); ?>" class="relative">
                                                    <a href="<?php echo e(route('shop', ['category' => $child->slug])); ?>" class="flex items-center justify-between px-6 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#094d82]" :class="activeSubcat === <?php echo e($child->id); ?> ? 'bg-gray-50 text-[#094d82]' : ''">
                                                        <span><?php echo e($child->name); ?></span>
                                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($child->children->count() > 0): ?>
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                    </a>
                                                    
                                                    
                                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($child->children->count() > 0): ?>
                                                        <div x-show="activeSubcat === <?php echo e($child->id); ?>" class="absolute left-full top-0 w-[240px] bg-white rounded py-2 ml-1 z-50 transition-all duration-150" style="border: 1px solid rgba(11, 92, 154, 0.2); box-shadow: 0 0 10px rgba(11, 92, 154, 0.2);">
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $child->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                                <a href="<?php echo e(route('shop', ['category' => $subchild->slug])); ?>" class="block px-6 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-[#094d82]">
                                                                    <?php echo e($subchild->name); ?>

                                                                </a>
                                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                        </div>
                                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                </div>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo e(route('shop')); ?>" class="flex items-center text-gray-700 font-semibold hover:text-[#094d82] transition-colors">
                        Shop
                    </a>
                    <a href="<?php echo e(route('shop', ['featured' => true])); ?>" class="flex items-center text-gray-700 font-semibold hover:text-[#094d82] transition-colors">
                        Featured
                    </a>
                    <a href="<?php echo e(route('shop', ['new_arrivals' => 1])); ?>" class="flex items-center text-gray-700 font-semibold hover:text-[#094d82] transition-colors">
                        New Arrivals
                    </a>
                    <a href="<?php echo e(route('shop', ['flash_sale' => true])); ?>" class="flex items-center text-[var(--color-warm-orange)] font-semibold hover:text-[var(--color-warm-orange-hover)] transition-colors gap-1">
                        ⚡ Flash Sale
                    </a>
                </div>
            </div>
        </nav>
        
        <div x-show="mobileMenu" class="md:hidden" style="display: none;">
            
            <div x-show="mobileMenu" x-transition.opacity @click="mobileMenu = false" class="fixed inset-0 bg-black/50 z-[60]"></div>
            
            
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
                         <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Models\Category::parents()->active()->ordered()->with('children.children')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                             <div x-data="{ expanded: false }">
                                 <div class="flex items-center justify-between py-1.5">
                                     <a href="<?php echo e(route('shop', ['category' => $cat->slug])); ?>" class="group flex items-center gap-3 text-lg font-semibold text-gray-700 hover:text-[#094d82] flex-1">
                                         <span class="flex items-center justify-center">
                                             <?php if (isset($component)) { $__componentOriginal99e3095fe204bf0a105d1301124943c8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99e3095fe204bf0a105d1301124943c8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.category-icon','data' => ['category' => $cat]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('category-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['category' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($cat)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99e3095fe204bf0a105d1301124943c8)): ?>
<?php $attributes = $__attributesOriginal99e3095fe204bf0a105d1301124943c8; ?>
<?php unset($__attributesOriginal99e3095fe204bf0a105d1301124943c8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99e3095fe204bf0a105d1301124943c8)): ?>
<?php $component = $__componentOriginal99e3095fe204bf0a105d1301124943c8; ?>
<?php unset($__componentOriginal99e3095fe204bf0a105d1301124943c8); ?>
<?php endif; ?>
                                         </span>
                                         <span><?php echo e($cat->name); ?></span>
                                     </a>
                                     <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cat->children->count() > 0): ?>
                                         <button @click="expanded = !expanded" class="p-1 text-gray-500 rounded hover:bg-gray-100">
                                             <svg class="w-4 h-4 transition-transform" :class="expanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                         </button>
                                     <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                 </div>
                                 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($cat->children->count() > 0): ?>
                                     <div x-show="expanded" style="display: none;" class="pl-4 border-l border-gray-100 ml-2 mb-1 flex flex-col gap-1">
                                         <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cat->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                             <div x-data="{ subExpanded: false }">
                                                 <div class="flex items-center justify-between py-1">
                                                     <a href="<?php echo e(route('shop', ['category' => $child->slug])); ?>" class="block text-sm text-gray-600 hover:text-[#094d82] flex-1">
                                                         <?php echo e($child->name); ?>

                                                     </a>
                                                     <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($child->children->count() > 0): ?>
                                                         <button @click="subExpanded = !subExpanded" class="p-1 text-gray-400 rounded hover:bg-gray-50">
                                                             <svg class="w-3.5 h-3.5 transition-transform" :class="subExpanded ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                                         </button>
                                                     <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                                 </div>
                                                 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($child->children->count() > 0): ?>
                                                     <div x-show="subExpanded" style="display: none;" class="pl-4 border-l border-gray-50 ml-2 flex flex-col gap-1 pb-1">
                                                         <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $child->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subchild): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                             <a href="<?php echo e(route('shop', ['category' => $subchild->slug])); ?>" class="block py-1 text-xs text-gray-500 hover:text-[#094d82]">
                                                                 <?php echo e($subchild->name); ?>

                                                             </a>
                                                         <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                                     </div>
                                                 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                             </div>
                                         <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                     </div>
                                 <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                             </div>
                         <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                     </div>
                 </div>
            </div>
        </div>
    </header>


    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="max-w-[1600px] w-full mx-auto px-2 md:px-4 xl:px-[70px] mt-4">
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded text-sm flex items-center gap-2">
                ✅ <?php echo e(session('success')); ?>

            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
        <div class="max-w-[1600px] w-full mx-auto px-2 md:px-4 xl:px-[70px] mt-4">
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded text-sm flex items-center gap-2">
                ❌ <?php echo e(session('error')); ?>

            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <main class="flex-1 pb-20 md:pb-0">
        <?php echo e($slot); ?>

    </main>

    
    
    <footer class="bg-white border-t border-gray-100 mt-auto font-sans">
        <div class="max-w-[1600px] w-full mx-auto px-4 xl:px-[70px] pt-8 pb-16 md:pt-6 md:pb-4">
            
            
            <div class="hidden md:block mb-6 pb-6 border-b border-gray-200">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 justify-between items-center">
                    
                    <div class="flex items-center gap-4">
                        <div class="text-[#1f618d] shrink-0">
                            
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.514"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-[15px] uppercase tracking-wide">Quality Products</h4>
                            <p class="text-gray-500 text-[13px] mt-0.5">Verified by experts</p>
                        </div>
                    </div>
                    
                    
                    <div class="flex items-center gap-4">
                        <div class="text-[#1f618d] shrink-0">
                            
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-[15px] uppercase tracking-wide">Support 24/7</h4>
                            <p class="text-gray-500 text-[13px] mt-0.5">Always here for you</p>
                        </div>
                    </div>
                    
                    
                    <div class="flex items-center gap-4">
                        <div class="text-[#1f618d] shrink-0">
                            
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-[15px] uppercase tracking-wide">Secure Checkout</h4>
                            <p class="text-gray-500 text-[13px] mt-0.5">SSLCommerz & COD</p>
                        </div>
                    </div>

                    
                    <div class="flex items-center gap-4">
                        <div class="text-[#1f618d] shrink-0">
                            
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"/></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900 text-[15px] uppercase tracking-wide">Fast Delivery</h4>
                            <p class="text-gray-500 text-[13px] mt-0.5">All over Bangladesh</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-8">
                
                <div class="lg:col-span-3 order-2 lg:order-1">
                    <h4 class="font-bold text-gray-900 text-[17px] mb-4">Contact Us</h4>
                    <ul class="space-y-3 text-[14.5px] text-gray-900 font-medium">
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span>+880 1880223099</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <a href="https://wa.me/8801880223099" target="_blank" rel="noopener noreferrer" class="hover:text-[var(--color-trust-blue)] transition-colors">+880 1880223099</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span><?php echo e(\App\Models\Setting::get('support_email', 'support@electrohome.bd')); ?></span>
                        </li>
                        <li class="mt-2 pt-1">
                            <h5 class="font-bold text-gray-900 text-[15px] mb-1">Address</h5>
                            <p class="text-gray-600 font-normal leading-relaxed text-[14px]">Arshinagar, Narsingdi Sadar, Narsingdi.</p>
                        </li>
                    </ul>
                    <div class="mt-5">
                        <a href="https://maps.google.com/?q=Arshinagar,+Narsingdi+Sadar,+Narsingdi" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-[#1f618d] text-white px-5 py-2.5 rounded text-sm font-semibold hover:bg-[#174a6c] transition-colors mb-4">
                            Get Direction
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </a>
                        <div class="w-full h-[150px] rounded-lg overflow-hidden border border-gray-200">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14595.69818818224!2d90.7251322!3d23.9168278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375432b4b3b1e7c5%3A0xc665dc6df8a93e3d!2sArshinagar%2C%20Narsingdi!5e0!3m2!1sen!2sbd!4v1714571025539!5m2!1sen!2sbd" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

                
                <div class="lg:col-span-3 order-3 lg:order-2">
                    <h4 class="font-bold text-gray-900 text-[17px] mb-4">Categories</h4>
                    <ul class="space-y-3.5 text-[14px] text-gray-500 font-medium">
                        <li><a href="<?php echo e(route('shop')); ?>" class="hover:text-[#00B050] transition-colors">Shop</a></li>
                        <li><a href="<?php echo e(route('home')); ?>#flash-sales" class="hover:text-[#00B050] transition-colors">Flash Sale</a></li>
                        <li><a href="<?php echo e(route('shop', ['sort' => 'newest'])); ?>" class="hover:text-[#00B050] transition-colors">New Arrivals</a></li>
                        <li><a href="<?php echo e(route('shop', ['featured' => 1])); ?>" class="hover:text-[#00B050] transition-colors">Featured Products</a></li>
                        <li><a href="<?php echo e(route('shop')); ?>" class="hover:text-[#00B050] transition-colors">All Categories</a></li>
                    </ul>
                </div>

                
                <div class="lg:col-span-3 order-4 lg:order-3">
                    <h4 class="font-bold text-gray-900 text-[17px] mb-4">Useful Links</h4>
                    <ul class="space-y-3.5 text-[14px] text-gray-500 font-medium">
                        <li><a href="#" class="hover:text-[#00B050] transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-[#00B050] transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-[#00B050] transition-colors">Term & Conditions</a></li>
                        <li><a href="#" class="hover:text-[#00B050] transition-colors">Return & Refund Policy</a></li>
                        <li><a href="#" class="hover:text-[#00B050] transition-colors">Privacy Policy</a></li>
                    </ul>
                </div>

                
                <div class="lg:col-span-3 order-1 lg:order-4">
                    <h4 class="font-bold text-gray-900 text-[17px] uppercase tracking-wide mb-4">ABOUT US</h4>
                    <p class="text-gray-700 text-[14px] leading-relaxed mb-6 text-justify">
                        Welcome To ElectroHome.bd. We Are NO'1 Electronics & Power Solutions Supplier In Bangladesh. We Are Ready To Serve You With High Quality Products. Our Major Products Are Hybrid Solar Inverters, Lithium-ion Phosphate (LiFePO4) batteries, Solar Panels, and Robotics Accessories.
                    </p>
                    
                    
                    <div class="flex items-center gap-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-[#3b5998] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-[#E1306C] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.012-3.584.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-[#FF0000] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.5 12 3.5 12 3.5s-7.505 0-9.377.55a3.016 3.016 0 00-2.122 2.136C0 8.07 0 12 0 12s0 3.93.501 5.814a3.016 3.016 0 002.122 2.136c1.871.55 9.377.55 9.377.55s7.505 0 9.377-.55a3.016 3.016 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="https://wa.me/8801880223099" target="_blank" class="w-8 h-8 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            
            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <div class="text-[13px] text-gray-500 font-medium">
                    © <?php echo e(date('Y')); ?> Electrohome.bd. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>

    
    <nav class="mobile-nav md:!hidden lg:!hidden">
        <a href="<?php echo e(route('home')); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span>Home</span>
        </a>
        <a href="<?php echo e(route('shop', ['v' => 2])); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('shop') ? 'active' : ''); ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
            <span>Shop</span>
        </a>
        <a href="<?php echo e(route('cart', ['v' => 2])); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('cart') ? 'active' : ''); ?> relative" x-data="{ cartCount: <?php echo e(app(\App\Services\CartService::class)->getCount()); ?> }" @cart-updated-optimistic.window="cartCount += $event.detail.qty_change" @cart-updated.window="if($event.detail.count !== undefined) { cartCount = $event.detail.count; }">
            <div class="relative inline-block animate-cart-dance">
                <svg class="w-5 h-5" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 7C12 7.55 11.55 8 11 8C10.45 8 10 7.55 10 7V5H8C7.45 5 7 4.55 7 4C7 3.45 7.45 3 8 3H10V1C10 0.45 10.45 0 11 0C11.55 0 12 0.45 12 1V3H14C14.55 3 15 3.45 15 4C15 4.55 14.55 5 14 5H12V7ZM4.01 19C4.01 17.9 4.9 17 6 17C7.1 17 8 17.9 8 19C8 20.1 7.1 21 6 21C4.9 21 4.01 20.1 4.01 19ZM16 17C14.9 17 14.01 17.9 14.01 19C14.01 20.1 14.9 21 16 21C17.1 21 18 20.1 18 19C18 17.9 17.1 17 16 17ZM14.55 12H7.1L6 14H17C17.55 14 18 14.45 18 15C18 15.55 17.55 16 17 16H6C4.48 16 3.52 14.37 4.25 13.03L5.6 10.59L2 3H1C0.45 3 0 2.55 0 2C0 1.45 0.45 1 1 1H2.64C3.02 1 3.38 1.22 3.54 1.57L7.53 10H14.55L17.94 3.87C18.2 3.39 18.81 3.22 19.29 3.48C19.77 3.75 19.95 4.36 19.68 4.84L16.3 10.97C15.96 11.59 15.3 12 14.55 12Z" fill="currentColor"/></svg>
                <span x-show="cartCount > 0" x-text="cartCount" wire:ignore class="absolute text-red-600 font-bold flex items-center justify-center" style="display: none; top: -8px; right: -10px; font-size: 22px; line-height: 1;">
                    <?php echo e(app(\App\Services\CartService::class)->getCount()); ?>

                </span>
            </div>
            <span>Cart</span>
        </a>
        <a href="<?php echo e(route('wishlist', ['v' => 2])); ?>" class="mobile-nav-item <?php echo e(request()->routeIs('wishlist') ? 'active' : ''); ?>">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            <span>Wishlist</span>
        </a>
        <a href="<?php echo e(auth()->check() ? route('dashboard', ['v' => 2]) : route('login', ['v' => 2])); ?>" class="mobile-nav-item">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            <span>Profile</span>
        </a>
    </nav>

    
    <div class="fixed bottom-20 md:bottom-6 right-4 md:right-6 z-30 flex flex-col items-center gap-2 md:gap-3">
        
        
        <a href="https://wa.me/8801880223099"
           target="_blank" rel="noopener"
           class="flex items-center justify-center hover:scale-110 transition-transform duration-300" title="Chat on WhatsApp">
            <svg class="w-10 h-10 md:w-12 md:h-12 text-[#25D366] hover:text-[#128C7E] drop-shadow-md transition-colors" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        </a>

        
        <button x-data @click="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="hidden md:flex w-12 h-12 bg-[#0b5c9a]/50 backdrop-blur-md border border-white/30 hover:bg-[#0b5c9a]/70 rounded-full items-center justify-center shadow-[0_4px_30px_rgba(0,0,0,0.1)] text-white transition-all duration-300"
                title="Scroll to Top">
            <svg class="w-6 h-6 animate-float-up drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
        </button>

        
        <button x-data @click="window.scrollBy({top: 600, behavior: 'smooth'})"
                class="hidden md:flex w-12 h-12 bg-[#0b5c9a]/50 backdrop-blur-md border border-white/30 hover:bg-[#0b5c9a]/70 rounded-full items-center justify-center shadow-[0_4px_30px_rgba(0,0,0,0.1)] text-white transition-all duration-300"
                title="Scroll Down">
            <svg class="w-6 h-6 animate-float-down drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
        </button>

    </div>

    
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('floating-cart');

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2641479324-3', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\ElectroHome.BD\ElectroHome.BD\resources\views/components/layouts/app.blade.php ENDPATH**/ ?>