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

<div class="bg-white rounded-xl shadow-sm border border-gray-100 px-3 py-2 relative" x-data="{
    scrollLeft() {
        $refs.slider.scrollBy({ left: -300, behavior: 'smooth' });
    },
    scrollRight() {
        $refs.slider.scrollBy({ left: 300, behavior: 'smooth' });
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
        
        <button @click="scrollLeft" class="absolute left-0 top-1/2 -translate-y-1/2 -ml-3 z-10 w-8 h-8 flex items-center justify-center bg-white rounded shadow border border-gray-100 text-gray-400 hover:text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>

        
        <div x-ref="slider" class="flex overflow-x-auto snap-x snap-mandatory gap-2.5 pb-2 scrollbar-hide no-scrollbar" style="scroll-behavior: smooth;">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="shrink-0 snap-start w-40 md:w-48 lg:w-56 h-full">
                    <?php echo $__env->make('partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        <button @click="scrollRight" class="absolute right-0 top-1/2 -translate-y-1/2 -mr-3 z-10 w-8 h-8 flex items-center justify-center bg-white rounded shadow border border-gray-100 text-gray-400 hover:text-blue-600 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>
</div>
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\ElectroHome.BD\resources\views/components/product-slider.blade.php ENDPATH**/ ?>