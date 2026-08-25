
            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 1rem;">
                <span style="font-weight: 700; font-size: 1.3rem; flex-shrink: 0; color: #111827;">Dashboard</span>
                <span class="header-divider h-8 w-px bg-gray-300 dark:bg-gray-700" style="flex-shrink: 0;"></span>
                <div class="my-custom-btns" style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; font-size: 0.95rem; font-weight: 500;">
                    <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['tag' => 'a','href' => ''.e(\App\Filament\Resources\Brands\BrandResource::getUrl('index')).'','color' => 'gray','icon' => 'heroicon-o-plus-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => ''.e(\App\Filament\Resources\Brands\BrandResource::getUrl('index')).'','color' => 'gray','icon' => 'heroicon-o-plus-circle']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Add Brand <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['tag' => 'a','href' => ''.e(\App\Filament\Resources\Categories\CategoryResource::getUrl('create')).'','color' => 'gray','icon' => 'heroicon-o-plus-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => ''.e(\App\Filament\Resources\Categories\CategoryResource::getUrl('create')).'','color' => 'gray','icon' => 'heroicon-o-plus-circle']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Add Category <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal6330f08526bbb3ce2a0da37da512a11f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.button.index','data' => ['tag' => 'a','href' => ''.e(\App\Filament\Resources\Products\ProductResource::getUrl('create')).'','color' => 'gray','icon' => 'heroicon-o-plus-circle']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('filament::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['tag' => 'a','href' => ''.e(\App\Filament\Resources\Products\ProductResource::getUrl('create')).'','color' => 'gray','icon' => 'heroicon-o-plus-circle']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Add Product <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $attributes = $__attributesOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__attributesOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f)): ?>
<?php $component = $__componentOriginal6330f08526bbb3ce2a0da37da512a11f; ?>
<?php unset($__componentOriginal6330f08526bbb3ce2a0da37da512a11f); ?>
<?php endif; ?>
                </div>
            </div>
            <style>
                .fi-header { 
                    background-color: #eaf7ec !important; 
                    border-radius: 0.75rem; 
                    padding: 0.5rem 1rem !important; 
                    min-height: 4rem !important; 
                    margin-top: -1.25rem !important; 
                    margin-bottom: 0.75rem !important;
                }
                .fi-main { padding-top: 0 !important; padding-left: 0.75rem !important; padding-right: 0.75rem !important; padding-bottom: 0.75rem !important; } 
                .fi-header-heading { overflow: visible !important; width: 100% !important; }
                
                @media (max-width: 1023px) {
                    /* Hide the View Website action on mobile and tablet since topbar globe exists */
                    #view-website-btn-action { display: none !important; }
                    /* Hide the Filament action wrapper if it exists using CSS :has() */
                    .fi-header-actions *:has(> #view-website-btn-action) { display: none !important; }
                }
                
                @media (max-width: 767px) {
                    .header-divider { display: none !important; }
                    .hide-on-mobile { display: none !important; }

                    .fi-header {
                        display: grid !important;
                        grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                        gap: 0.5rem !important;
                    }

                    /* Strip structural wrappers to flatten DOM into the grid */
                    .fi-header > div:first-child,
                    .fi-header-heading,
                    .fi-header-heading > div,
                    .my-custom-btns,
                    .my-custom-btns div,
                    .fi-header-actions-ctn,
                    .fi-header-actions-ctn div {
                        display: contents !important;
                    }

                    /* Dashboard title full width */
                    .fi-header-heading > div > span:first-child {
                        grid-column: span 2 !important;
                        margin-bottom: 0 !important;
                        display: block !important;
                    }

                    /* Force actual buttons to stretch and center */
                    .my-custom-btns button, .my-custom-btns a, .my-custom-btns .fi-btn,
                    .fi-header-actions-ctn button, .fi-header-actions-ctn a, .fi-header-actions-ctn .fi-btn {
                        width: 100% !important;
                        max-width: 100% !important;
                        justify-content: center !important;
                        text-align: center !important;
                        display: flex !important;
                    }
                }
            </style>
        <?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\storage\framework\views/35325ad0217beacf8db8218ee4fe6d6f.blade.php ENDPATH**/ ?>