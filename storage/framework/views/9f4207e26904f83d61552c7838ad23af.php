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

    
    <div class="bg-white border-b border-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold font-bangla text-gray-800">
                    <?php echo e($currentCategory ? $currentCategory->name : 'All Products'); ?>

                </h1>
                <div class="text-sm text-gray-500 mt-1 flex items-center gap-2">
                    <a href="<?php echo e(route('home')); ?>" class="hover:text-[var(--color-trust-blue)]">Home</a>
                    <span>/</span>
                    <span class="text-gray-800"><?php echo e($currentCategory ? $currentCategory->name : 'Shop'); ?></span>
                </div>
            </div>
            
            <div class="text-sm text-gray-500">
                Showing <?php echo e($products->firstItem() ?? 0); ?>-<?php echo e($products->lastItem() ?? 0); ?> of <?php echo e($products->total()); ?> products
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            
            <aside class="w-full md:w-64 shrink-0 space-y-6">
                <form action="<?php echo e(route('shop')); ?>" method="GET" id="filter-form" class="space-y-6 bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('search')): ?>
                        <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    
                    
                    <div>
                        <h3 class="font-bold text-gray-800 mb-3 flex items-center justify-between">
                            Categories
                        </h3>
                        <div class="space-y-2 max-h-64 overflow-y-auto pr-2 scrollbar-hide text-sm">
                            <a href="<?php echo e(route('shop')); ?>" class="flex items-center justify-between group">
                                <span class="<?php echo e(!$currentCategory ? 'text-[var(--color-trust-blue)] font-semibold' : 'text-gray-600 group-hover:text-[var(--color-trust-blue)]'); ?>">All Products</span>
                            </a>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <div>
                                    <a href="<?php echo e(route('shop', array_merge(request()->query(), ['category' => $category->slug]))); ?>" 
                                       class="flex items-center justify-between group py-1">
                                        <span class="<?php echo e($currentCategory && ($currentCategory->id === $category->id || $currentCategory->parent_id === $category->id) ? 'text-[var(--color-trust-blue)] font-semibold' : 'text-gray-600 group-hover:text-[var(--color-trust-blue)]'); ?>">
                                            <?php echo e($category->name); ?>

                                        </span>
                                        <span class="text-xs text-gray-400 bg-gray-50 px-1.5 py-0.5 rounded"><?php echo e($category->products_count); ?></span>
                                    </a>
                                    
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentCategory && ($currentCategory->id === $category->id || $currentCategory->parent_id === $category->id)): ?>
                                        <div class="ml-4 space-y-1 mt-1 border-l-2 border-gray-100 pl-3">
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                                <a href="<?php echo e(route('shop', array_merge(request()->query(), ['category' => $child->slug]))); ?>" 
                                                   class="block py-1 <?php echo e($currentCategory->id === $child->id ? 'text-[var(--color-trust-blue)] font-semibold' : 'text-gray-500 hover:text-[var(--color-trust-blue)]'); ?>">
                                                    <?php echo e($child->name); ?>

                                                </a>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    
                    <div>
                        <h3 class="font-bold text-gray-800 mb-3">Price Range</h3>
                        <div class="flex items-center gap-2">
                            <input type="number" name="min_price" value="<?php echo e(request('min_price')); ?>" placeholder="Min" class="w-full px-3 py-1.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[var(--color-trust-blue)]">
                            <span class="text-gray-400">-</span>
                            <input type="number" name="max_price" value="<?php echo e(request('max_price')); ?>" placeholder="Max" class="w-full px-3 py-1.5 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-[var(--color-trust-blue)]">
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    
                    <div>
                        <h3 class="font-bold text-gray-800 mb-3">Availability</h3>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="in_stock" value="1" <?php echo e(request('in_stock') ? 'checked' : ''); ?> class="rounded border-gray-300 text-[var(--color-trust-blue)] focus:ring-[var(--color-trust-blue)]">
                            <span class="text-sm text-gray-600">In Stock Only</span>
                        </label>
                    </div>

                    
                    <div>
                        <h3 class="font-bold text-gray-800 mb-3">Special</h3>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="flash_sale" value="1" <?php echo e(request('flash_sale') ? 'checked' : ''); ?> class="rounded border-gray-300 text-[var(--color-trust-blue)] focus:ring-[var(--color-trust-blue)]">
                                <span class="text-sm text-[var(--color-soft-coral)] font-semibold">Flash Sale Deals</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="featured" value="1" <?php echo e(request('featured') ? 'checked' : ''); ?> class="rounded border-gray-300 text-[var(--color-trust-blue)] focus:ring-[var(--color-trust-blue)]">
                                <span class="text-sm text-gray-600">Featured Products</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-neutral w-full">Apply Filters</button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request()->except('page')): ?>
                        <a href="<?php echo e(route('shop')); ?>" class="block text-center text-sm text-gray-500 hover:text-red-500 mt-2">Clear All Filters</a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </form>
            </aside>

            
            <div class="flex-1">
                
                <div class="flex items-center justify-between bg-white p-3 rounded-xl border border-gray-100 shadow-sm mb-6">
                    <div class="text-sm text-gray-500 hidden sm:block">
                        Sort by:
                    </div>
                    <form id="sort-form" class="flex-1 sm:flex-none flex justify-end">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = request()->except(['sort', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        @endform
                        <select name="sort" onchange="document.getElementById('sort-form').submit()" class="px-3 py-1.5 border border-gray-200 rounded-lg text-sm bg-gray-50 focus:outline-none focus:bg-white w-full sm:w-48">
                            <option value="newest" <?php echo e(request('sort') === 'newest' ? 'selected' : ''); ?>>Newest Arrivals</option>
                            <option value="price_low" <?php echo e(request('sort') === 'price_low' ? 'selected' : ''); ?>>Price: Low to High</option>
                            <option value="price_high" <?php echo e(request('sort') === 'price_high' ? 'selected' : ''); ?>>Price: High to Low</option>
                            <option value="best_selling" <?php echo e(request('sort') === 'best_selling' ? 'selected' : ''); ?>>Best Selling</option>
                            <option value="name_asc" <?php echo e(request('sort') === 'name_asc' ? 'selected' : ''); ?>>Name: A-Z</option>
                        </select>
                    </form>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->count() > 0): ?>
                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 md:gap-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php echo $__env->make('partials.product-card', ['product' => $product], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>

                    
                    <div class="mt-8 flex justify-center">
                        <?php echo e($products->links('pagination::tailwind')); ?>

                    </div>
                <?php else: ?>
                    <div class="bg-white rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-400 mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">No products found</h3>
                        <p class="text-gray-500 mb-6 text-sm">Try adjusting your filters or search criteria.</p>
                        <a href="<?php echo e(route('shop')); ?>" class="btn btn-neutral inline-flex">Clear All Filters</a>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
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
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\electro-bd\resources\views\shop.blade.php ENDPATH**/ ?>