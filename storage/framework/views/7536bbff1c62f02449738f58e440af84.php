<?php if (isset($component)) { $__componentOriginal166a02a7c5ef5a9331faf66fa665c256 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-panels::components.page.index','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament-panels::page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <style>
        .fb-tab {
            padding: 8px 16px;
            margin-right: 4px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            cursor: pointer;
        }
        .fb-tab-active {
            background-color: #e0f2fe !important; /* Light blue */
            color: #0284c7 !important; /* Blue text */
        }
        .fb-tab-active:hover {
            background-color: #bae6fd !important; /* Deeper blue on hover */
        }
        .fb-tab-inactive {
            color: #000000; /* Deep black text */
            background-color: transparent;
        }
        .fb-tab-inactive:hover {
            background-color: #f3f4f6;
        }
    </style>

    <div class="flex items-center mb-6 px-2">
        <button
            type="button"
            wire:click="$set('activeTab', 'all')"
            class="fb-tab <?php echo e($activeTab === 'all' ? 'fb-tab-active' : 'fb-tab-inactive'); ?>"
        >
            All
        </button>

        <button
            type="button"
            wire:click="$set('activeTab', 'orders')"
            class="fb-tab <?php echo e($activeTab === 'orders' ? 'fb-tab-active' : 'fb-tab-inactive'); ?>"
        >
            Orders
        </button>

        <button
            type="button"
            wire:click="$set('activeTab', 'sales')"
            class="fb-tab <?php echo e($activeTab === 'sales' ? 'fb-tab-active' : 'fb-tab-inactive'); ?>"
        >
            Sales
        </button>
        
        <button
            type="button"
            wire:click="$set('activeTab', 'channel_views')"
            class="fb-tab <?php echo e($activeTab === 'channel_views' ? 'fb-tab-active' : 'fb-tab-inactive'); ?>"
            style="margin-right: 0;"
        >
            Website Views
        </button>
    </div>

    <div class="mb-6">
        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(\App\Filament\Widgets\AnalyticsStatsOverview::class, ['filters' => $filters, 'activeTab' => $activeTab]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1075233081-0', $__key);

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

    <div class="mb-6">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($activeTab === 'all'): ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(\App\Filament\Widgets\AllAnalyticsChart::class, ['filters' => $filters]);

$__keyOuter = $__key ?? null;

$__key = 'all-analytics-chart';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1075233081-1', $__key);

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
            
            <div style="padding-top: 24px;" <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::$currentLoop['key'] = 'table-wrapper'; ?>wire:key="table-wrapper">
                <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(\App\Filament\Widgets\ProductAnalyticsTableWidget::class, ['filters' => $filters]);

$__keyOuter = $__key ?? null;

$__key = 'product-analytics-table';
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1075233081-2', $__key);

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
        <?php elseif($activeTab === 'orders'): ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(\App\Filament\Widgets\OrdersAnalyticsChart::class, ['filters' => $filters]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1075233081-3', $__key);

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
        <?php elseif($activeTab === 'sales'): ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(\App\Filament\Widgets\SalesAnalyticsChart::class, ['filters' => $filters]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1075233081-4', $__key);

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
        <?php elseif($activeTab === 'channel_views'): ?>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split(\App\Filament\Widgets\ChannelViewsChart::class, ['filters' => $filters]);

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1075233081-5', $__key);

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
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $attributes = $__attributesOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__attributesOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256)): ?>
<?php $component = $__componentOriginal166a02a7c5ef5a9331faf66fa665c256; ?>
<?php unset($__componentOriginal166a02a7c5ef5a9331faf66fa665c256); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\ElectroHome.BD\resources\views/filament/pages/sales-analytics.blade.php ENDPATH**/ ?>