<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'icon', 'products', 'viewAllUrl' => '#']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['title', 'icon', 'products', 'viewAllUrl' => '#']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="md:bg-white md:rounded-lg md:shadow-sm md:border md:border-gray-100 md:px-3 md:py-2 relative" x-data="{
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
    scrollLeft() {
        this.$refs.slider.scrollBy({ left: -300, behavior: 'smooth' });
    },
    scrollRight() {
        this.$refs.slider.scrollBy({ left: 300, behavior: 'smooth' });
    }
}">
    <div class="flex items-center justify-between mb-3">
        <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2">
            <?php echo e($title); ?> <span><?php echo e($icon); ?></span>
        </h2>
        <a href="<?php echo e($viewAllUrl); ?>" class="text-xs font-semibold text-gray-600 border border-gray-300 rounded px-3 py-1.5 hover:bg-gray-50 transition-colors">
            View All
        </a>
    </div>

    <div class="relative group">
        
        <div class="absolute -left-5 md:-left-8 xl:-left-12 top-1/2 -translate-y-1/2 z-10" x-cloak x-show="showLeft">
            <button @click="scrollLeft" 
                    style="animation: float-pulse-icon 2s infinite ease-in-out; background: none !important; border: none !important; box-shadow: none !important;"
                    class="p-1 flex items-center justify-center focus:outline-none text-gray-700 hover:text-[var(--color-trust-blue)] transition-colors">
                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>
        </div>

        
        <div x-ref="slider" @scroll="checkScroll" class="flex overflow-x-auto snap-x snap-mandatory gap-2 md:gap-2.5 pb-2 scrollbar-hide no-scrollbar" style="scroll-behavior: smooth;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="shrink-0 snap-start w-[calc((100%-8px)/2)] md:w-[calc((100%-30px)/4)] lg:w-[calc((100%-40px)/5)] h-full">
                    <?php echo $__env->make('partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views/components/product-slider.blade.php ENDPATH**/ ?>