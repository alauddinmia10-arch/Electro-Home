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
    
    <section class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-auto md:h-[420px]">
            
            <div class="md:col-span-3 rounded-lg overflow-hidden relative shadow-sm aspect-video md:aspect-auto md:h-full bg-gray-900 group" x-data="{ activeSlide: 0, slides: [0, 1, 2] }" x-init="setInterval(() => { activeSlide = activeSlide === slides.length - 1 ? 0 : activeSlide + 1 }, 5000)">
                <div x-show="activeSlide === 0" x-transition.opacity.duration.500ms class="absolute inset-0">
                    <img src="<?php echo e(asset('images/sliders/slide1.png')); ?>" alt="Hybrid Solar Inverter" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex flex-col items-center justify-center text-white p-8 text-center">
                        <h1 class="text-3xl md:text-5xl font-bold mb-4 font-bangla drop-shadow-lg">আপনার স্বপ্নের প্রজেক্ট<br>শুরু করুন আজই!</h1>
                        <p class="text-lg opacity-90 mb-6 drop-shadow-md">Electrohome.bd-এ পাচ্ছেন সেরা মানের সোলার ও ইনভার্টার সলিউশন</p>
                        <a href="<?php echo e(route('shop')); ?>" class="bg-blue-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-blue-700 hover:scale-105 transition-all">Shop Now</a>
                    </div>
                </div>

                <div x-show="activeSlide === 1" x-transition.opacity.duration.500ms class="absolute inset-0">
                    <img src="<?php echo e(asset('images/sliders/slide2.png')); ?>" alt="Lithium Phosphate Battery" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex flex-col items-center justify-center text-white p-8 text-center">
                        <h1 class="text-3xl md:text-5xl font-bold mb-4 font-bangla drop-shadow-lg">দীর্ঘস্থায়ী পাওয়ার সলিউশন</h1>
                        <p class="text-lg opacity-90 mb-6 drop-shadow-md">সেরা মানের Lithium-ion Phosphate (LiFePO4) ব্যাটারি</p>
                        <a href="<?php echo e(route('shop')); ?>" class="bg-emerald-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-emerald-700 hover:scale-105 transition-all">Explore Batteries</a>
                    </div>
                </div>

                <div x-show="activeSlide === 2" x-transition.opacity.duration.500ms class="absolute inset-0">
                    <img src="<?php echo e(asset('images/sliders/slide3.png')); ?>" alt="Electronic Components" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent flex flex-col items-center justify-center text-white p-8 text-center">
                        <h1 class="text-3xl md:text-5xl font-bold mb-4 font-bangla drop-shadow-lg">প্রিমিয়াম ইলেকট্রনিক্স কম্পোনেন্ট</h1>
                        <p class="text-lg opacity-90 mb-6 drop-shadow-md">সার্কিট, সেন্সর, আরডুইনো এবং রোবোটিক্স এক্সেসরিজ</p>
                        <a href="<?php echo e(route('shop')); ?>" class="bg-[var(--color-trust-blue)] text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-blue-500 hover:scale-105 transition-all">View Components</a>
                    </div>
                </div>

                
                <div class="absolute bottom-4 left-0 right-0 flex justify-center gap-2 z-10">
                    <template x-for="slide in slides" :key="slide">
                        <button @click="activeSlide = slide" class="w-2.5 h-2.5 rounded-full transition-all" :class="activeSlide === slide ? 'bg-white w-6' : 'bg-white/50'"></button>
                    </template>
                </div>
            </div>

            
            <div class="hidden md:flex flex-col gap-4 h-full">
                <div class="flex-1 bg-gray-900 rounded-lg p-6 text-white shadow-sm flex flex-col justify-center relative overflow-hidden group"
                     <?php if(isset($flashSaleProducts) && $flashSaleProducts->count() > 0): ?>
                     x-data="{ activeIndex: 0, total: <?php echo e(min(5, $flashSaleProducts->count())); ?> }"
                     x-init="setInterval(() => { activeIndex = (activeIndex + 1) % total }, 3000)"
                     <?php endif; ?>>
                     
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($flashSaleProducts) && $flashSaleProducts->count() > 0): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $flashSaleProducts->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div x-show="activeIndex === <?php echo e($index); ?>" 
                                 x-transition.opacity.duration.1000ms
                                 class="absolute inset-0 w-full h-full z-0">
                                <img src="<?php echo e($product->cover_image_url); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors"></div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    
                    <?php
                        $maxDiscount = 0;
                        if(isset($flashSaleProducts) && $flashSaleProducts->count() > 0) {
                            foreach($flashSaleProducts as $p) {
                                if($p->regular_price > 0 && $p->discount_price > 0 && $p->discount_price < $p->regular_price) {
                                    $discount = round((($p->regular_price - $p->discount_price) / $p->regular_price) * 100);
                                    if($discount > $maxDiscount) {
                                        $maxDiscount = $discount;
                                    }
                                }
                            }
                        }
                    ?>
                    <div class="relative z-10">
                        <h3 class="text-xl font-bold mb-1">Flash Sale</h3>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($maxDiscount > 0): ?>
                            <p class="text-sm opacity-90 mb-4">Up to <?php echo e($maxDiscount); ?>% Off</p>
                        <?php else: ?>
                            <p class="text-sm opacity-90 mb-4">Hot Deals Inside</p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <a href="#flash-sales" class="inline-flex items-center gap-1 text-sm font-semibold hover:gap-2 transition-all">Shop Deals &rarr;</a>
                    </div>
                    <svg class="absolute -right-4 -bottom-4 w-32 h-32 opacity-20 group-hover:scale-110 transition-transform z-0" fill="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
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



    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($flashSaleProducts->count() > 0): ?>
    <section id="flash-sales" class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
        <div class="md:bg-white md:rounded-lg md:p-3 md:shadow-sm md:border md:border-red-100 relative overflow-hidden"
             x-data="{
                 showLeft: false,
                 showRight: true,
                 init() {
                     this.$nextTick(() => this.checkScroll());
                     window.addEventListener('resize', () => this.checkScroll());
                 },
                 checkScroll() {
                     const slider = this.$refs.slider;
                     if (!slider) return;
                     this.showLeft = slider.scrollLeft > 0;
                     this.showRight = Math.ceil(slider.scrollLeft + slider.clientWidth) < slider.scrollWidth;
                 },
                 scrollLeft() { this.$refs.slider.scrollBy({ left: -300, behavior: 'smooth' }); },
                 scrollRight() { this.$refs.slider.scrollBy({ left: 300, behavior: 'smooth' }); }
             }">
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-50 rounded-full blur-3xl -z-10"></div>
            
            <div class="flex items-center justify-between mb-3">
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

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2872314837-0', $__key);

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

            <div class="relative group">
                
                <div class="absolute -left-5 md:-left-8 xl:-left-12 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="showLeft">
                    <button @click="scrollLeft" 
                            style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                            class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                        <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    </button>
                </div>

                
                <div x-ref="slider" @scroll="checkScroll" class="flex overflow-x-auto snap-x snap-mandatory gap-2 md:gap-2.5 scrollbar-hide no-scrollbar" style="scroll-behavior: smooth;">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $flashSaleProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="shrink-0 snap-start w-[calc((100%-8px)/2)] md:w-[calc((100%-30px)/4)] lg:w-[calc((100%-40px)/5)] h-full">
                            <?php echo $__env->make('partials.product-card', ['product' => $product, 'showBadge' => 'flash'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>

                
                <div class="absolute -right-5 md:-right-8 xl:-right-12 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="showRight">
                    <button @click="scrollRight" 
                            style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                            class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                        <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($bestSellers->count() > 0): ?>
    <section class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
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
    <section class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
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
    <section class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px]">
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

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($brands) && $brands->count() > 0): ?>
    <style>
        @keyframes float-pulse {
            0%, 100% { opacity: 0.5; transform: scale(0.9); }
            50% { opacity: 1; transform: scale(1.15); box-shadow: 0 0 15px rgba(0,0,0,0.2); }
        }
        @keyframes float-pulse-icon {
            0%, 100% { opacity: 0.6; transform: scale(0.9); }
            50% { opacity: 1; transform: scale(1.2); }
        }
    </style>
    
    <section class="max-w-[1600px] w-full mx-auto px-3 block md:hidden"
             x-data="{
                activeSlide: 0,
                totalSlides: <?php echo e(ceil($brands->count() / 9)); ?>,
                touchStartX: 0,
                touchEndX: 0,
                next() { if(this.activeSlide < this.totalSlides - 1) this.activeSlide++; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; },
                handleSwipe() {
                    let swipeDistance = this.touchStartX - this.touchEndX;
                    if (swipeDistance > 40) {
                        this.next();
                    } else if (swipeDistance < -40) {
                        this.prev();
                    }
                }
             }">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-bold text-gray-900">Top Brands</h2>
        </div>
        
        <div class="relative overflow-hidden"
             @touchstart="touchStartX = $event.touches[0].clientX"
             @touchend="touchEndX = $event.changedTouches[0].clientX; handleSwipe()">
            
            <div class="absolute -left-5 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="totalSlides > 1 && activeSlide > 0">
                <button @click="prev" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            
            <div class="transition-transform duration-500 ease-in-out flex" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $brands->chunk(9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="w-full shrink-0">
                        <div class="grid grid-cols-3 gap-3 px-1 pb-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <a href="<?php echo e(route('shop', ['brand' => $brand->slug])); ?>" 
                                   class="bg-white rounded-xl border border-gray-100 shadow-sm transition-all p-2 flex items-center justify-center aspect-square group">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($brand->logo): ?>
                                        <img src="<?php echo e(\Illuminate\Support\Facades\Storage::url($brand->logo)); ?>" alt="<?php echo e($brand->name); ?>" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform">
                                    <?php else: ?>
                                        <span class="font-bold text-gray-700 text-xs text-center uppercase tracking-wide"><?php echo e($brand->name); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <div class="absolute -right-5 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="totalSlides > 1 && activeSlide < totalSlides - 1">
                <button @click="next" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>

    
    <section class="max-w-[1600px] w-full mx-auto px-3 xl:px-[70px] hidden md:block"
             x-data="{
                activeSlide: 0,
                totalSlides: <?php echo e(ceil($brands->count() / 12)); ?>,
                next() { if(this.activeSlide < this.totalSlides - 1) this.activeSlide++; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; }
             }">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Top Brands</h2>
        </div>
        
        <div class="relative overflow-hidden">
            
            <div class="absolute -left-8 xl:-left-12 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="totalSlides > 1 && activeSlide > 0">
                <button @click="prev" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            
            <div class="transition-transform duration-500 ease-in-out flex" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $brands->chunk(12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="w-full shrink-0">
                        <div class="grid grid-cols-6 gap-4 px-1 pb-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <a href="<?php echo e(route('shop', ['brand' => $brand->slug])); ?>" 
                                   class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all p-3 flex items-center justify-center aspect-square group">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($brand->logo): ?>
                                        <img src="<?php echo e(\Illuminate\Support\Facades\Storage::url($brand->logo)); ?>" alt="<?php echo e($brand->name); ?>" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform">
                                    <?php else: ?>
                                        <span class="font-bold text-gray-700 text-sm group-hover:text-[var(--color-trust-blue)] transition-colors text-center uppercase tracking-wide"><?php echo e($brand->name); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <div class="absolute -right-8 xl:-right-12 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="totalSlides > 1 && activeSlide < totalSlides - 1">
                <button @click="next" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    
    <section class="max-w-[1600px] w-full mx-auto px-3 block md:hidden"
             x-data="{
                activeSlide: 0,
                totalSlides: <?php echo e(ceil($categories->count() / 9)); ?>,
                touchStartX: 0,
                touchEndX: 0,
                next() { if(this.activeSlide < this.totalSlides - 1) this.activeSlide++; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; },
                handleSwipe() {
                    let swipeDistance = this.touchStartX - this.touchEndX;
                    if (swipeDistance > 40) {
                        this.next();
                    } else if (swipeDistance < -40) {
                        this.prev();
                    }
                }
             }">
        <div class="flex items-center justify-between mb-3">
            <h2 class="text-xl font-bold text-gray-900">Top Categories</h2>
            <a href="<?php echo e(route('shop')); ?>" class="text-[var(--color-trust-blue)] text-sm font-semibold">View All</a>
        </div>
        
        <div class="relative overflow-hidden"
             @touchstart="touchStartX = $event.touches[0].clientX"
             @touchend="touchEndX = $event.changedTouches[0].clientX; handleSwipe()">
             
            
            <div class="absolute -left-5 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="totalSlides > 1 && activeSlide > 0">
                <button @click="prev" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            
            <div class="transition-transform duration-500 ease-in-out flex" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories->chunk(9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="w-full shrink-0">
                        <div class="grid grid-cols-3 gap-3 px-1 pb-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <a href="<?php echo e(route('shop', ['category' => $category->slug])); ?>" 
                                   class="bg-white rounded-xl shadow-sm transition-all border border-gray-100 p-2 text-center group flex flex-col items-center justify-center aspect-square">
                                    <div class="text-3xl mb-1 transform group-hover:scale-110 transition-transform"><?php echo e($category->icon); ?></div>
                                    <h3 class="text-xs font-semibold text-gray-800 leading-tight"><?php echo e($category->name); ?></h3>
                                </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <div class="absolute -right-5 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="totalSlides > 1 && activeSlide < totalSlides - 1">
                <button @click="next" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 transition-colors">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>
    </section>

    
    <section class="max-w-[1600px] w-full mx-auto px-3 xl:px-[70px] hidden md:block"
             x-data="{
                activeSlide: 0,
                totalSlides: <?php echo e(ceil($categories->count() / 18)); ?>,
                next() { if(this.activeSlide < this.totalSlides - 1) this.activeSlide++; },
                prev() { if(this.activeSlide > 0) this.activeSlide--; }
             }">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Top Categories</h2>
            <a href="<?php echo e(route('shop')); ?>" class="text-[var(--color-trust-blue)] hover:underline text-sm font-semibold">View All</a>
        </div>
        
        <div class="relative overflow-hidden">
             
            
            <div class="absolute -left-8 xl:-left-12 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="totalSlides > 1 && activeSlide > 0">
                <button @click="prev" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
            </div>

            
            <div class="transition-transform duration-500 ease-in-out flex" :style="'transform: translateX(-' + (activeSlide * 100) + '%)'">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories->chunk(18); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="w-full shrink-0">
                        <div class="grid grid-cols-9 gap-4 px-1 pb-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <a href="<?php echo e(route('shop', ['category' => $category->slug])); ?>" 
                                   class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100 p-2 md:p-3 text-center group flex flex-col items-center justify-center aspect-square">
                                    <div class="text-2xl md:text-3xl mb-1 md:mb-2 transform group-hover:scale-110 transition-transform"><?php echo e($category->icon); ?></div>
                                    <h3 class="text-xs font-semibold text-gray-800 leading-tight line-clamp-2"><?php echo e($category->name); ?></h3>
                                </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <div class="absolute -right-8 xl:-right-12 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="totalSlides > 1 && activeSlide < totalSlides - 1">
                <button @click="next" 
                        style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                        class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
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
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views/home.blade.php ENDPATH**/ ?>