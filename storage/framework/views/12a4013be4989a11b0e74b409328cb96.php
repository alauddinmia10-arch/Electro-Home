<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="flex flex-col gap-2 md:gap-4 pt-2 md:pt-4 pb-8">
    
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-auto md:h-96">
            
            <div class="md:col-span-3 rounded-lg overflow-hidden relative shadow-sm aspect-video md:aspect-auto md:h-full bg-gray-900 group" x-data="{ activeSlide: 0, slides: [0, 1, 2] }" x-init="setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 5000)">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div x-show="activeSlide === <?php echo e($index); ?>" x-transition.opacity.duration.500ms class="absolute inset-0">
                        <img src="<?php echo e(Storage::url($banner->image_path)); ?>" alt="<?php echo e($banner->title); ?>" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-emerald-500 flex flex-col items-center justify-center text-white p-8">
                        <h1 class="text-3xl md:text-5xl font-bold mb-4 font-bangla text-center">আপনার স্বপ্নের প্রজেক্ট<br>শুরু করুন আজই!</h1>
                        <p class="text-lg opacity-90 mb-6">Electrohome.bd-এ পাচ্ছেন সেরা মানের ইলেকট্রনিক্স কম্পোনেন্ট</p>
                        <a href="<?php echo e(route('shop')); ?>" class="bg-white text-blue-600 px-6 py-3 rounded-full font-bold shadow-lg hover:scale-105 transition-transform">
                            Shop Now
                        </a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                
                
                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-10">
                    <template x-for="slide in slides" :key="slide">
                        <button @click="activeSlide = slide" class="w-2.5 h-2.5 rounded-full transition-all" :class="activeSlide === slide ? 'bg-white w-6' : 'bg-white/50'"></button>
                    </template>
                </div>
            </div>

            
            <div class="hidden md:flex flex-col gap-4 h-full">
                <div class="flex-1 bg-gradient-to-br from-orange-400 to-red-500 rounded-lg p-6 text-white shadow-sm flex flex-col justify-center relative overflow-hidden group">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-1">Flash Sale</h3>
                        <p class="text-sm opacity-90 mb-4">Up to 50% Off</p>
                        <a href="#flash-sales" class="inline-flex items-center gap-1 text-sm font-semibold hover:gap-2 transition-all">Shop Deals &rarr;</a>
                    </div>
                    <svg class="absolute -right-4 -bottom-4 w-32 h-32 opacity-20 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <div class="flex-1 bg-gradient-to-br from-gray-800 to-gray-900 rounded-lg p-6 text-white shadow-sm flex flex-col justify-center relative overflow-hidden group">
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-1">New Sensors</h3>
                        <p class="text-sm opacity-90 mb-4">IoT & Robotics</p>
                        <a href="<?php echo e(route('shop')); ?>" class="inline-flex items-center gap-1 text-sm font-semibold hover:gap-2 transition-all">Explore &rarr;</a>
                    </div>
                    <svg class="absolute -right-4 -bottom-4 w-32 h-32 opacity-10 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                </div>
            </div>
        </div>
    </section>

    
    <section class="max-w-[1440px] w-full mx-auto px-2 md:px-4 xl:px-[70px]">
        <div class="md:bg-white md:rounded-lg py-0 md:p-6 md:shadow-sm md:border md:border-gray-100 grid grid-cols-2 md:flex md:flex-wrap gap-y-1 gap-x-1 md:gap-0 justify-between md:items-center text-sm">
            <div class="flex items-center gap-1.5 md:gap-3 bg-white md:bg-transparent py-2.5 px-1.5 md:p-0 rounded-lg shadow-sm md:shadow-none border border-gray-100 md:border-0">
                <div class="w-7 h-7 md:w-10 md:h-10 rounded-full bg-blue-50 text-[var(--color-trust-blue)] flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 text-[11px] md:text-sm leading-tight md:leading-normal whitespace-nowrap">Fast Delivery</h4>
                    <p class="text-gray-500 text-[9px] md:text-xs leading-tight md:leading-normal whitespace-nowrap">All over Bangladesh</p>
                </div>
            </div>
            <div class="hidden md:block w-px h-10 bg-gray-100"></div>
            <div class="flex items-center gap-1.5 md:gap-3 bg-white md:bg-transparent py-2.5 px-1.5 md:p-0 rounded-lg shadow-sm md:shadow-none border border-gray-100 md:border-0">
                <div class="w-7 h-7 md:w-10 md:h-10 rounded-full bg-green-50 text-[var(--color-sea-green)] flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 text-[11px] md:text-sm leading-tight md:leading-normal whitespace-nowrap">Quality Products</h4>
                    <p class="text-gray-500 text-[9px] md:text-xs leading-tight md:leading-normal whitespace-nowrap">Verified by experts</p>
                </div>
            </div>
            <div class="hidden md:block w-px h-10 bg-gray-100"></div>
            <div class="flex items-center gap-1.5 md:gap-3 bg-white md:bg-transparent py-2.5 px-1.5 md:p-0 rounded-lg shadow-sm md:shadow-none border border-gray-100 md:border-0">
                <div class="w-7 h-7 md:w-10 md:h-10 rounded-full bg-orange-50 text-[var(--color-warm-orange)] flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 text-[11px] md:text-sm leading-tight md:leading-normal whitespace-nowrap">Secure Checkout</h4>
                    <p class="text-gray-500 text-[9px] md:text-xs leading-tight md:leading-normal whitespace-nowrap">SSLCommerz & COD</p>
                </div>
            </div>
            <div class="hidden md:block w-px h-10 bg-gray-100"></div>
            <div class="flex items-center gap-1.5 md:gap-3 bg-white md:bg-transparent py-2.5 px-1.5 md:p-0 rounded-lg shadow-sm md:shadow-none border border-gray-100 md:border-0">
                <div class="w-7 h-7 md:w-10 md:h-10 rounded-full bg-purple-50 text-[var(--color-soft-purple)] flex items-center justify-center shrink-0">
                    <svg class="w-3.5 h-3.5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-800 text-[11px] md:text-sm leading-tight md:leading-normal whitespace-nowrap">Support 24/7</h4>
                    <p class="text-gray-500 text-[9px] md:text-xs leading-tight md:leading-normal whitespace-nowrap">Always here for you</p>
                </div>
            </div>
        </div>
    </section>



    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($flashSaleProducts->count() > 0): ?>
    <section id="flash-sales" class="max-w-[1440px] w-full mx-auto px-2 md:px-4 xl:px-[70px]">
        <div class="bg-white rounded-lg p-6 shadow-sm border border-red-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-50 rounded-full blur-3xl -z-10"></div>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 border-b border-red-100 pb-4">
                <div class="flex items-center gap-4">
                    <h2 class="text-2xl font-bold flex items-center gap-2">
                        <span class="text-[var(--color-soft-coral)]">⚡ Flash Sale</span>
                    </h2>
                    <div class="hidden md:block">
                        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('flash-sale-timer', ['endTime' => $flashSaleProducts->first()->flash_sale_ends_at->toIso8601String()]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-638667861-0', $__key);

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
                <a href="<?php echo e(route('shop', ['flash_sale' => 1])); ?>" class="text-red-600 hover:underline text-sm font-semibold">See All Deals &rarr;</a>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-2 md:gap-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $flashSaleProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php echo $__env->make('partials.product-card', ['product' => $product, 'showBadge' => 'flash'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bestSellers->count() > 0): ?>
    <section class="max-w-[1440px] w-full mx-auto px-2 md:px-4 xl:px-[70px]">
        <?php if (isset($component)) { $__componentOriginale278e6a1b1486d2da6f18ddfbe891b79 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-slider','data' => ['title' => 'Top Selling','icon' => '🏆','products' => $bestSellers,'viewAllUrl' => ''.e(route('shop', ['sort' => 'popular'])).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Top Selling','icon' => '🏆','products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($bestSellers),'viewAllUrl' => ''.e(route('shop', ['sort' => 'popular'])).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79)): ?>
<?php $attributes = $__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79; ?>
<?php unset($__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale278e6a1b1486d2da6f18ddfbe891b79)): ?>
<?php $component = $__componentOriginale278e6a1b1486d2da6f18ddfbe891b79; ?>
<?php unset($__componentOriginale278e6a1b1486d2da6f18ddfbe891b79); ?>
<?php endif; ?>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($newArrivals->count() > 0): ?>
    <section class="max-w-[1440px] w-full mx-auto px-2 md:px-4 xl:px-[70px]">
        <?php if (isset($component)) { $__componentOriginale278e6a1b1486d2da6f18ddfbe891b79 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-slider','data' => ['title' => 'New Arrivals','icon' => '🆕','products' => $newArrivals,'viewAllUrl' => ''.e(route('shop')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'New Arrivals','icon' => '🆕','products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($newArrivals),'viewAllUrl' => ''.e(route('shop')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79)): ?>
<?php $attributes = $__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79; ?>
<?php unset($__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale278e6a1b1486d2da6f18ddfbe891b79)): ?>
<?php $component = $__componentOriginale278e6a1b1486d2da6f18ddfbe891b79; ?>
<?php unset($__componentOriginale278e6a1b1486d2da6f18ddfbe891b79); ?>
<?php endif; ?>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredProducts->count() > 0): ?>
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <?php if (isset($component)) { $__componentOriginale278e6a1b1486d2da6f18ddfbe891b79 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.product-slider','data' => ['title' => 'Trending Now','icon' => '📈','products' => $featuredProducts,'viewAllUrl' => ''.e(route('shop', ['featured' => 1])).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('product-slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Trending Now','icon' => '📈','products' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($featuredProducts),'viewAllUrl' => ''.e(route('shop', ['featured' => 1])).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79)): ?>
<?php $attributes = $__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79; ?>
<?php unset($__attributesOriginale278e6a1b1486d2da6f18ddfbe891b79); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale278e6a1b1486d2da6f18ddfbe891b79)): ?>
<?php $component = $__componentOriginale278e6a1b1486d2da6f18ddfbe891b79; ?>
<?php unset($__componentOriginale278e6a1b1486d2da6f18ddfbe891b79); ?>
<?php endif; ?>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <section class="max-w-[1440px] w-full mx-auto px-4 xl:px-[70px]">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Top Categories</h2>
            <a href="<?php echo e(route('shop')); ?>" class="text-[var(--color-trust-blue)] hover:underline text-sm font-semibold">View All</a>
        </div>
        
        <div class="grid grid-cols-3 md:grid-cols-6 gap-3 md:gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('shop', ['category' => $category->slug])); ?>" class="bg-white rounded-lg p-4 text-center hover:shadow-md transition-shadow border border-gray-100 group">
                    <div class="text-3xl mb-2 transform group-hover:scale-110 transition-transform"><?php echo e($category->icon); ?></div>
                    <h3 class="text-xs md:text-sm font-semibold text-gray-800"><?php echo e($category->name); ?></h3>
                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </section>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\ElectroHome.BD\resources\views/home.blade.php ENDPATH**/ ?>