<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['product', 'showBadge' => null, 'view' => 'grid']));

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

foreach (array_filter((['product', 'showBadge' => null, 'view' => 'grid']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="product-card group relative flex <?php echo e($view === 'list' ? 'flex-row h-auto p-2.5 md:p-4 gap-3 md:gap-6 items-center' : 'flex-col h-full'); ?> bg-white border border-gray-100 rounded-lg overflow-hidden">
    
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

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1806507892-0', $__key);

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

    
    <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="product-image block <?php echo e($view === 'list' ? 'w-24 h-24 md:w-48 md:h-48 shrink-0' : 'aspect-square'); ?> bg-white relative">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->cover_image_url): ?>
            <img src="<?php echo e($product->cover_image_url); ?>" alt="<?php echo e($product->name); ?>" loading="lazy" class="w-full h-full object-contain">
        <?php else: ?>
            <div class="w-full h-full flex items-center justify-center text-gray-300">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </a>

    
    <div class="<?php echo e($view === 'list' ? 'flex flex-col flex-1 justify-center min-w-0 pr-1' : 'px-2.5 pb-2.5 pt-2 flex flex-col flex-1 border-t border-gray-100'); ?>">
        <a href="<?php echo e(route('product.show', $product->slug)); ?>" class="text-sm font-semibold text-gray-800 line-clamp-2 mb-1.5 hover:text-[var(--color-trust-blue)] transition-colors flex-1" title="<?php echo e($product->name); ?>">
            <?php echo e($product->name); ?>

        </a>
        <div class="<?php echo e($view === 'list' ? 'mt-1.5 md:mt-4 flex flex-col md:flex-row md:items-center justify-between gap-2 md:gap-6' : 'mt-auto pt-2.5 flex flex-col gap-2.5 border-t border-gray-50'); ?>">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->discount_price && $product->discount_price < $product->regular_price): ?>
                <div class="flex <?php echo e($view === 'list' ? 'flex-row items-center gap-2 md:gap-4' : 'justify-between items-start'); ?>">
                    <div class="flex <?php echo e($view === 'list' ? 'flex-row items-center gap-2 md:gap-3' : 'flex-col leading-tight'); ?>">
                        <span class="text-[17px] font-bold text-[var(--color-trust-blue)]">৳<?php echo e(number_format($product->discount_price, 0)); ?></span>
                        <span class="text-xs text-gray-400 line-through mt-0.5">৳<?php echo e(number_format($product->regular_price, 0)); ?></span>
                    </div>
                    <div class="flex flex-col items-end leading-tight <?php echo e($view === 'list' ? 'bg-green-50 px-2 py-1 rounded' : ''); ?>">
                        <span class="text-xs font-medium text-[#00a651]">Save</span>
                        <span class="text-xs font-bold text-[#00a651] mt-0.5">৳<?php echo e(number_format($product->regular_price - $product->discount_price, 0)); ?></span>
                    </div>
                </div>
            <?php else: ?>
                <div class="flex <?php echo e($view === 'list' ? 'flex-row items-center gap-2 md:gap-4' : 'justify-between items-start'); ?>">
                    <div class="flex <?php echo e($view === 'list' ? 'flex-row items-center gap-2 md:gap-3' : 'flex-col leading-tight'); ?>">
                        <span class="text-[17px] font-bold text-[var(--color-trust-blue)]">৳<?php echo e(number_format($product->regular_price, 0)); ?></span>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($view !== 'list'): ?>
                        <span class="text-xs text-transparent mt-0.5">-</span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
            <div class="<?php echo e($view === 'list' ? 'w-full md:w-48 mt-1 md:mt-0' : ''); ?>">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('product-card-add-to-cart', ['product' => $product,'button-class' => request('cols') == 6 && $view !== 'list' ? 'gap-1 px-1 text-[13px]' : 'gap-2 px-2.5 text-[15px]','svg-class' => request('cols') == 6 && $view !== 'list' ? 'w-4 h-4' : 'w-4 h-4']);

$__keyOuter = $__key ?? null;

$__key = 'add-to-cart-btn-'.e($product->id).'';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1806507892-1', $__key);

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
    </div>
</div>
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views/partials/product-card.blade.php ENDPATH**/ ?>