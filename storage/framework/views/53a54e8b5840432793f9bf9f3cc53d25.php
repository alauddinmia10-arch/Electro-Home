<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product']));

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

foreach (array_filter((['product']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="flex flex-col h-full bg-white border border-gray-100 rounded hover:shadow-md transition-shadow relative overflow-hidden group">
    
    <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="block aspect-[4/3] bg-white relative p-4 border-b border-gray-50 flex items-center justify-center">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->cover_image): ?>
            <img src="<?php echo e(Storage::url($product->cover_image)); ?>" alt="<?php echo e($product->name); ?>" loading="lazy" class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform duration-300">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-gray-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </a>

    
    <div class="p-3 text-center flex flex-col flex-1">
        <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="text-[13px] leading-tight font-medium text-gray-800 line-clamp-2 mb-2 hover:text-blue-600 transition-colors flex-1" title="<?php echo e($product->name); ?>">
            <?php echo e($product->name); ?>

        </a>
        
        <div class="mt-auto pt-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->discount_price && $product->discount_price < $product->regular_price): ?>
                <div class="text-[13px] font-semibold text-blue-600">৳ <?php echo e(number_format($product->discount_price, 2)); ?></div>
            <?php else: ?>
                <div class="text-[13px] font-semibold text-blue-600">৳ <?php echo e(number_format($product->regular_price, 2)); ?></div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\electro-bd\resources\views\partials\product-card-minimal.blade.php ENDPATH**/ ?>