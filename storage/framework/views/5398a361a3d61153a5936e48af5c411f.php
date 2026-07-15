<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product', 'showBadge' => null]));

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

foreach (array_filter((['product', 'showBadge' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="product-card group relative flex flex-col h-full bg-white border border-gray-100">
    
    <div class="absolute top-2 left-2 z-10 flex flex-col gap-1">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->status !== 'in_stock' || $product->stock_quantity <= 0): ?>
            <span class="badge-out">Out of Stock</span>
        <?php elseif($showBadge === 'flash' || $product->is_flash_sale): ?>
            <span class="badge-flash">Flash Deal</span>
        <?php elseif($showBadge === 'new'): ?>
            <span class="badge-new">New</span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->discount_price && $product->discount_price < $product->regular_price): ?>
            <?php
                $percentage = round((($product->regular_price - $product->discount_price) / $product->regular_price) * 100);
            ?>
            <span class="badge-sale">-<?php echo e($percentage); ?>%</span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('wishlist-button', ['product-id' => $product->id]);

$__keyOuter = $__key ?? null;

$__key = 'wishlist-btn-'.e($product->id).'';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2772246691-0', $__key);

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

    
    <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="product-image block aspect-square bg-gray-50 relative p-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->cover_image): ?>
            <img src="<?php echo e(Storage::url($product->cover_image)); ?>" alt="<?php echo e($product->name); ?>" loading="lazy">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-gray-300">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </a>

    
    <div class="p-4 flex flex-col flex-1">
        <a href="<?php echo e(route('shop', ['category' => $product->category->slug])); ?>" class="text-xs text-gray-500 mb-1 hover:text-[var(--color-trust-blue)] transition-colors">
            <?php echo e($product->category->name); ?>

        </a>
        <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="text-sm font-semibold text-gray-800 line-clamp-2 mb-2 hover:text-[var(--color-trust-blue)] transition-colors flex-1" title="<?php echo e($product->name); ?>">
            <?php echo e($product->name); ?>

        </a>
        
        <div class="flex items-end justify-between mt-auto pt-2 border-t border-gray-50">
            <div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->discount_price && $product->discount_price < $product->regular_price): ?>
                    <div class="text-price-old">৳<?php echo e(number_format($product->regular_price, 0)); ?></div>
                    <div class="text-price text-lg">৳<?php echo e(number_format($product->discount_price, 0)); ?></div>
                <?php else: ?>
                    <div class="text-price text-lg">৳<?php echo e(number_format($product->regular_price, 0)); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            
            <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-600 hover:bg-[var(--color-sea-green)] hover:text-white transition-colors border border-gray-200 hover:border-transparent">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            </a>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\electro-bd\resources\views\partials\product-card.blade.php ENDPATH**/ ?>