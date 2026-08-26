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

    <div class="max-w-[1600px] w-full mx-auto px-4 md:px-6 xl:px-[70px] py-8">
        <div class="flex flex-col md:flex-row gap-8">
            
            <aside class="w-full md:w-64 shrink-0">
                <form action="<?php echo e(route('shop')); ?>" method="GET" id="filter-form" class="space-y-6 bg-white p-5 rounded border border-gray-100 shadow-sm">
                    <h2 class="text-lg font-bold text-gray-800">Filters</h2>

                    
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Search</label>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search products..." class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a]">
                    </div>
                    
                    
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Category</label>
                        <select name="category" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a] bg-white">
                            <option value="">All Categories</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($cat->slug); ?>" <?php echo e(request('category') == $cat->slug ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>

                    
                    <div x-data="priceRangeSlider(<?php echo e(request('min_price') ?: 0); ?>, <?php echo e(request('max_price') ?: (isset($maxPriceLimit) ? $maxPriceLimit : 500000)); ?>, 0, <?php echo e(isset($maxPriceLimit) ? $maxPriceLimit : 500000); ?>, 100)">
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Price Range</label>
                        
                        
                        <div class="relative w-full h-1 mt-6 mb-8 flex items-center">
                            
                            <div class="absolute w-full h-1 bg-gray-200 rounded-full"></div>
                            
                            <div class="absolute h-1 bg-[#0b5c9a] rounded-full" x-bind:style="'left: ' + minPercent + '%; right: ' + (100 - maxPercent) + '%;'"></div>
                            
                            
                            <input type="range" step="100" x-bind:min="min" x-bind:max="max" x-model="minPrice" @input="updateFromSlider"
                                   class="absolute w-full pointer-events-none appearance-none bg-transparent" style="z-index: 30;">
                            <input type="range" step="100" x-bind:min="min" x-bind:max="max" x-model="maxPrice" @input="updateFromSlider"
                                   class="absolute w-full pointer-events-none appearance-none bg-transparent" style="z-index: 30;">
                            
                            <style>
                                input[type=range]::-webkit-slider-thumb {
                                    pointer-events: auto;
                                    width: 16px;
                                    height: 16px;
                                    -webkit-appearance: none;
                                    background-color: #0b5c9a;
                                    border-radius: 50%;
                                    cursor: pointer;
                                    position: relative;
                                    z-index: 40;
                                }
                                input[type=range]::-moz-range-thumb {
                                    pointer-events: auto;
                                    width: 16px;
                                    height: 16px;
                                    -moz-appearance: none;
                                    background-color: #0b5c9a;
                                    border: none;
                                    border-radius: 50%;
                                    cursor: pointer;
                                    position: relative;
                                    z-index: 40;
                                }
                                input[type=range]::-webkit-slider-runnable-track {
                                    background: transparent;
                                    border: transparent;
                                }
                                input[type=range]::-moz-range-track {
                                    background: transparent;
                                    border: transparent;
                                }
                            </style>
                        </div>
                        
                        
                        <div class="flex items-center gap-2">
                            <input type="number" name="min_price" x-model="minPrice" @input="updateFromInput" placeholder="Min ৳" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a]">
                            <input type="number" name="max_price" x-model="maxPrice" @input="updateFromInput" placeholder="Max ৳" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a]">
                        </div>

                        <script>
                            document.addEventListener('alpine:init', () => {
                                if (!window.alpinePriceRangeSliderDefined) {
                                    window.alpinePriceRangeSliderDefined = true;
                                    Alpine.data('priceRangeSlider', (initialMin, initialMax, min, max, step) => ({
                                        minPrice: initialMin,
                                        maxPrice: initialMax,
                                        min: min,
                                        max: max,
                                        step: step,
                                        minPercent: 0,
                                        maxPercent: 100,
                                        init() {
                                            this.updatePercentages();
                                        },
                                        updateFromSlider() {
                                            this.minPrice = parseInt(this.minPrice);
                                            this.maxPrice = parseInt(this.maxPrice);
                                            if (this.minPrice > this.maxPrice) {
                                                let temp = this.minPrice;
                                                this.minPrice = this.maxPrice;
                                                this.maxPrice = temp;
                                            }
                                            this.updatePercentages();
                                        },
                                        updateFromInput() {
                                            this.minPrice = parseInt(this.minPrice);
                                            this.maxPrice = parseInt(this.maxPrice);
                                            if(this.minPrice < this.min) this.minPrice = this.min;
                                            if(this.maxPrice > this.max) this.maxPrice = this.max;
                                            this.updatePercentages();
                                        },
                                        updatePercentages() {
                                            this.minPercent = ((this.minPrice - this.min) / (this.max - this.min)) * 100;
                                            this.maxPercent = ((this.maxPrice - this.min) / (this.max - this.min)) * 100;
                                        }
                                    }));
                                }
                            });
                        </script>
                    </div>

                    
                    <div>
                        <label class="block text-sm text-gray-700 mb-2 font-medium">Brand</label>
                        <select name="brand" class="w-full px-3 py-2 border border-gray-200 rounded text-sm focus:outline-none focus:border-[#0b5c9a] bg-white">
                            <option value="">All Brands</option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($brands)): ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($brand->slug ?? $brand->id); ?>" <?php echo e(request('brand') == ($brand->slug ?? $brand->id) ? 'selected' : ''); ?>><?php echo e($brand->name); ?></option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </select>
                    </div>

                    
                    <div>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="on_sale" value="1" <?php echo e(request('on_sale') ? 'checked' : ''); ?> class="rounded border-gray-300 text-[#1877f2] focus:ring-[#1877f2]">
                            <span class="text-sm text-gray-600">On Sale Only</span>
                        </label>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-[#0b5c9a] hover:bg-[#094d82] text-white text-[15px] font-semibold leading-none py-2 px-4 rounded transition-colors">Apply Filters</button>
                        <a href="<?php echo e(route('shop')); ?>" class="block text-center text-sm text-gray-500 hover:text-gray-800 mt-3">Clear Filters</a>
                    </div>
                </form>
            </aside>

            
            <div class="flex-1">
                
                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-[28px] font-bold text-gray-800 mb-1 leading-tight">
                            <?php echo e($pageTitle); ?>

                        </h1>
                        <div class="flex items-center gap-1.5 text-[13px] text-gray-500">
                            <a href="<?php echo e(route('home')); ?>" class="text-[#0b5c9a] font-bold hover:underline">Home</a>
                            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span class="text-gray-600"><?php echo e($pageTitle); ?></span>
                        </div>
                    </div>

                    
                    <form id="sort-form" class="flex items-center gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = request()->except(['sort_by', 'sort_order', 'page']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <input type="hidden" name="<?php echo e($key); ?>" value="<?php echo e($value); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        
                        <select name="sort_by" onchange="document.getElementById('sort-form').submit()" class="text-sm bg-white border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-[#0b5c9a] text-gray-700 shadow-sm cursor-pointer hover:border-gray-300">
                            <option value="name" <?php echo e(request('sort_by') === 'name' ? 'selected' : ''); ?>>Name</option>
                            <option value="price" <?php echo e(request('sort_by') === 'price' ? 'selected' : ''); ?>>Price</option>
                            <option value="newest" <?php echo e(request('sort_by', 'newest') === 'newest' ? 'selected' : ''); ?>>Newest</option>
                        </select>
                        <?php
                            $currentSortBy = request('sort_by', 'newest');
                            
                            $ascLabel = 'A to Z';
                            $descLabel = 'Z to A';
                            
                            if ($currentSortBy === 'price') {
                                $ascLabel = 'Low to High';
                                $descLabel = 'High to Low';
                            } elseif ($currentSortBy === 'newest') {
                                $ascLabel = 'Oldest First';
                                $descLabel = 'Newest First';
                            }
                        ?>
                        <select name="sort_order" onchange="document.getElementById('sort-form').submit()" class="text-sm bg-white border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-[#0b5c9a] text-gray-700 shadow-sm cursor-pointer hover:border-gray-300">
                            <option value="asc" <?php echo e(request('sort_order') === 'asc' ? 'selected' : ''); ?>><?php echo e($ascLabel); ?></option>
                            <option value="desc" <?php echo e(request('sort_order') === 'desc' ? 'selected' : ''); ?>><?php echo e($descLabel); ?></option>
                        </select>
                    </form>
                </div>

                
                <div class="flex items-center justify-between bg-white p-3 rounded border border-gray-100 shadow-sm mb-6">
                    
                    <div class="flex items-center gap-2">
                        <span class="text-[13px] text-gray-600 font-medium hidden sm:inline-block">View:</span>
                        <div class="flex items-center border border-gray-200 rounded overflow-hidden bg-gray-50">
                            <a href="<?php echo e(request()->fullUrlWithQuery(['view' => 'grid'])); ?>" class="p-2 <?php echo e(request('view', 'grid') === 'grid' ? 'bg-[#0b5c9a] text-white' : 'text-gray-500 hover:bg-gray-100'); ?>" title="Grid View">
                                <svg class="w-[18px] h-[18px]" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                            </a>
                            <a href="<?php echo e(request()->fullUrlWithQuery(['view' => 'list'])); ?>" class="p-2 <?php echo e(request('view') === 'list' ? 'bg-[#0b5c9a] text-white' : 'text-gray-500 hover:bg-gray-100'); ?>" title="List View">
                                <svg class="w-[18px] h-[18px]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                            </a>
                        </div>
                    </div>
                    
                    
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(request('view', 'grid') !== 'list'): ?>
                    <div class="flex items-center gap-2">
                        <span class="text-[13px] text-gray-600 font-medium hidden sm:inline-block">Columns:</span>
                        <div class="flex items-center gap-1 border border-gray-200 rounded px-1 py-1 bg-white shadow-sm">
                            <a href="<?php echo e(request()->fullUrlWithQuery(['cols' => 4, 'view' => 'grid'])); ?>" class="px-2.5 py-1.5 rounded text-sm font-medium <?php echo e(request('cols', 4) == 4 && request('view', 'grid') != 'list' ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100'); ?> flex items-center gap-1.5 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                  <rect x="5" y="5" width="6" height="6" rx="1" />
                                  <rect x="13" y="5" width="6" height="6" rx="1" />
                                  <rect x="5" y="13" width="6" height="6" rx="1" />
                                  <rect x="13" y="13" width="6" height="6" rx="1" />
                                </svg>
                                4
                            </a>
                            <a href="<?php echo e(request()->fullUrlWithQuery(['cols' => 5, 'view' => 'grid'])); ?>" class="px-2.5 py-1.5 rounded text-sm font-medium <?php echo e(request('cols') == 5 && request('view') != 'list' ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100'); ?> flex items-center gap-1.5 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                  <rect x="3" y="5" width="4" height="6" rx="0.5" />
                                  <rect x="10" y="5" width="4" height="6" rx="0.5" />
                                  <rect x="17" y="5" width="4" height="6" rx="0.5" />
                                  <rect x="3" y="13" width="4" height="6" rx="0.5" />
                                  <rect x="10" y="13" width="4" height="6" rx="0.5" />
                                  <rect x="17" y="13" width="4" height="6" rx="0.5" />
                                </svg>
                                5
                            </a>
                            <a href="<?php echo e(request()->fullUrlWithQuery(['cols' => 6, 'view' => 'grid'])); ?>" class="px-2.5 py-1.5 rounded text-sm font-medium <?php echo e(request('cols') == 6 && request('view') != 'list' ? 'bg-[#0b5c9a] text-white' : 'text-gray-600 hover:bg-gray-100'); ?> flex items-center gap-1.5 transition-colors">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                  <rect x="3" y="3" width="4" height="4" rx="0.5" />
                                  <rect x="10" y="3" width="4" height="4" rx="0.5" />
                                  <rect x="17" y="3" width="4" height="4" rx="0.5" />
                                  <rect x="3" y="10" width="4" height="4" rx="0.5" />
                                  <rect x="10" y="10" width="4" height="4" rx="0.5" />
                                  <rect x="17" y="10" width="4" height="4" rx="0.5" />
                                  <rect x="3" y="17" width="4" height="4" rx="0.5" />
                                  <rect x="10" y="17" width="4" height="4" rx="0.5" />
                                  <rect x="17" y="17" width="4" height="4" rx="0.5" />
                                </svg>
                                6
                            </a>
                        </div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->count() > 0): ?>
                    <?php
                        // Determine grid layout based on view and cols parameters
                        $view = request('view', 'grid');
                        if ($view === 'list') {
                            $gridClass = 'grid-cols-1';
                        } else {
                            $cols = request('cols', 4);
                            $gridClass = 'grid-cols-2 lg:grid-cols-3';
                            if ($cols == 4) $gridClass .= ' xl:grid-cols-4';
                            if ($cols == 5) $gridClass .= ' xl:grid-cols-5';
                            if ($cols == 6) $gridClass .= ' xl:grid-cols-6';
                        }
                    ?>
                    <div class="grid <?php echo e($gridClass); ?> gap-3 md:gap-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php echo $__env->make('partials.product-card', ['product' => $product, 'view' => $view], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>

                    
                    <div class="mt-8 flex justify-center">
                        <?php echo e($products->links('pagination::tailwind')); ?>

                    </div>
                <?php else: ?>
                    <div class="bg-white rounded p-12 text-center border border-gray-100 shadow-sm">
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
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views/shop.blade.php ENDPATH**/ ?>