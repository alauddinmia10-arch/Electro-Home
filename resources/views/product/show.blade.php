<x-layouts.app>
    {{-- Breadcrumbs --}}
    <div class="max-w-[1440px] mx-auto px-0 md:px-4 xl:px-[70px] mt-1">
        <div class="bg-[#f0f5fa] md:rounded px-4 py-2.5 flex items-center gap-2 overflow-hidden whitespace-nowrap text-[13px] text-gray-600">
            <a href="{{ route('home') }}" onclick="event.stopPropagation(); window.location.href = this.href; return false;" class="text-gray-700 hover:text-blue-600 transition-colors shrink-0 flex items-center" title="Home">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
            </a>
            <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <a href="{{ route('shop') }}" class="hover:text-blue-600 transition-colors shrink-0">Products</a>
            <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="hover:text-blue-600 transition-colors shrink-0">{{ $product->category->name }}</a>
            <svg class="w-3 h-3 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            
            <span class="text-[#0b5c9a] font-medium truncate min-w-0 flex items-center gap-1.5" title="{{ $product->name }}">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                {{ \Illuminate\Support\Str::limit($product->name, 80) }}
            </span>
        </div>
    </div>

    <div class="max-w-[1440px] mx-auto px-0 md:px-4 xl:px-[70px] mt-1 mb-6" x-data="{ wholesaleModalOpen: false }">
        <div class="bg-white md:rounded shadow-sm border-y md:border border-gray-100 p-4 pt-3 lg:px-6 lg:pb-3 lg:pt-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-6">
            
            {{-- Left: Image Gallery --}}
            <div x-data="{ mainImage: '{{ $product->cover_image ? Storage::url($product->cover_image) : '' }}' }" class="lg:col-span-5 flex flex-col md:flex-row gap-3 md:gap-0 -ml-2 lg:-ml-6">
                
                {{-- Thumbnails (Vertical on left for Desktop, Horizontal below for Mobile) --}}
                @if($product->images && $product->images->count() > 0)
                    <div class="order-2 md:order-1 w-full md:w-[80px] shrink-0" x-data="{
                        scrollNext() { $refs.thumbSlider.scrollBy({ top: 100, left: 100, behavior: 'smooth' }) },
                        scrollPrev() { $refs.thumbSlider.scrollBy({ top: -100, left: -100, behavior: 'smooth' }) }
                    }">
                        <div class="relative bg-white md:bg-transparent rounded p-0 shadow-sm md:shadow-none border border-gray-100 md:border-none flex flex-col justify-start">
                            <!-- Prev Arrow (Up) -->
                            <button @click="scrollPrev" class="hidden md:flex mx-auto mb-1 w-full h-5 items-center justify-center text-gray-400 hover:text-gray-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path></svg>
                            </button>
                            
                            <!-- Thumbnails Container -->
                            <div x-ref="thumbSlider" class="flex md:flex-col gap-2 overflow-auto scrollbar-hide md:max-h-[432px] snap-x md:snap-y w-full">
                                <button @click="mainImage = '{{ Storage::url($product->cover_image) }}'" 
                                        class="w-16 h-16 md:w-[80px] md:h-[80px] shrink-0 bg-white rounded border-2 overflow-hidden snap-start transition-all"
                                        :class="mainImage === '{{ Storage::url($product->cover_image) }}' ? 'border-[#1a5b82]' : 'border-gray-200 hover:border-gray-400'">
                                    <img src="{{ Storage::url($product->cover_image) }}" class="w-full h-full object-cover mix-blend-multiply">
                                </button>
                                @foreach($product->images as $image)
                                    <button @click="mainImage = '{{ Storage::url($image->image_path) }}'" 
                                            class="w-16 h-16 md:w-[80px] md:h-[80px] shrink-0 bg-white rounded border-2 overflow-hidden snap-start transition-all"
                                            :class="mainImage === '{{ Storage::url($image->image_path) }}' ? 'border-[#1a5b82]' : 'border-gray-200 hover:border-gray-400'">
                                        <img src="{{ Storage::url($image->image_path) }}" class="w-full h-full object-cover mix-blend-multiply">
                                    </button>
                                @endforeach
                            </div>

                            <!-- Next Arrow (Down) -->
                            <button @click="scrollNext" class="hidden md:flex mx-auto mt-1 w-full h-5 items-center justify-center text-gray-400 hover:text-gray-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                        </div>
                    </div>
                @endif

                {{-- Main Image --}}
                <div class="order-1 md:order-2 bg-white border border-gray-100 relative flex justify-center items-center p-0 rounded flex-grow aspect-square md:aspect-auto md:h-[480px]">
                    @if($product->is_flash_sale)
                        <div class="absolute top-3 left-3 z-10">
                            <span class="badge-flash text-xs px-2 py-1 shadow-sm">⚡ Flash Deal</span>
                        </div>
                    @endif
                    
                    <template x-if="mainImage">
                        <img :src="mainImage" alt="{{ $product->name }}" class="max-w-full max-h-full object-contain mix-blend-multiply">
                    </template>
                    <template x-if="!mainImage">
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="lg:col-span-7 flex flex-col lg:-ml-3">
                <div class="flex-grow flex flex-col">
                    <div>
                        <div class="mb-5">
                            <div class="border-b border-gray-200 pb-3 mb-3">
                                <h1 class="text-[20px] lg:text-[26px] font-semibold text-gray-800 leading-tight mb-2">
                                    {{ $product->name }}
                                </h1>
                                
                                <div class="flex items-center mb-1 text-[15px] text-gray-800">
                                    <span class="w-24">SKU</span>
                                    <span class="mr-2">:</span> 
                                    <span>{{ $product->sku }}</span>
                                </div>
                                <div class="flex items-center mb-1 text-[15px] text-gray-800">
                                    <span class="w-24">Brand</span>
                                    <span class="mr-2">:</span> 
                                    <a href="#" class="text-blue-600 hover:underline">{{ $product->brand->name ?? 'TOMZN' }}</a>
                                </div>
                                <div class="flex items-center mb-2 text-[15px] text-gray-800">
                                    <span class="w-24">Warranty</span>
                                    <span class="mr-2">:</span> 
                                    <span class="font-medium">{{ $product->warranty ?? '15 Days' }}</span>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                @if($product->discount_price && $product->discount_price < $product->regular_price)
                                    <div class="flex items-center gap-3 mb-1">
                                        <span class="text-[32px] font-bold text-[#1971c2]">৳{{ number_format($product->discount_price, 0) }}</span>
                                        <span class="text-[22px] text-gray-500 line-through">৳{{ number_format($product->regular_price, 0) }}</span>
                                        <span class="bg-[#ffe3e3] text-[#7d1919] text-[16px] px-2.5 py-0.5 rounded ml-1">Save ৳{{ number_format($product->regular_price - $product->discount_price, 0) }}</span>
                                    </div>
                                @else
                                    <div class="text-[32px] font-bold text-[#1971c2] mb-1">
                                        ৳{{ number_format($product->regular_price, 0) }}
                                    </div>
                                @endif
                            </div>

                            @if($product->short_description)
                            <div class="prose prose-sm text-gray-600 mb-4">
                                {!! $product->short_description !!}
                            </div>
                            @endif

                            @if($product->is_flash_sale && $product->flash_sale_ends_at)
                                <div class="bg-orange-50 border border-orange-200 rounded p-3 mb-4 flex items-center justify-between">
                                    <div class="text-orange-800 font-semibold text-sm">Hurry up! Flash sale ends in:</div>
                                    <livewire:flash-sale-timer :endTime="$product->flash_sale_ends_at->toIso8601String()" />
                                </div>
                            @endif
                        </div>
                        
                        {{-- Add to Cart Component --}}
                        <div class="mt-auto">
                            <livewire:add-to-cart :productId="$product->id" :stockQuantity="$product->status === 'in_stock' ? $product->stock_quantity : 0" />
                        </div>

                        {{-- Category & Share & Wholesale --}}
                        <div class="mt-4 pt-4 border-t border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center text-[15px]">
                                    <span class="w-20 text-gray-800">Category</span>
                                    <span class="mr-2 text-gray-800">:</span> 
                                    <a href="{{ route('shop', ['category' => $product->category->slug]) }}" class="text-[#1a5b82] hover:underline">{{ $product->category->name }}</a>
                                </div>
                                <div class="flex items-center text-[15px]">
                                    <span class="w-20 text-gray-800">Share</span>
                                    <span class="mr-2 text-gray-800">:</span> 
                                    <div class="flex gap-4 items-center">
                                        <button class="text-gray-800 hover:text-blue-600"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></button>
                                        <button class="text-gray-800 hover:text-black"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.901 1.153h3.68l-8.04 9.19L24 22.846h-7.406l-5.8-7.584-6.638 7.584H.474l8.6-9.83L0 1.154h7.594l5.243 6.932ZM17.61 20.644h2.039L6.486 3.24H4.298Z"/></svg></button>
                                        <button class="text-gray-800 hover:text-blue-700"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></button>
                                        <button class="text-gray-800 hover:text-green-600"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></button>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Wholesale Button --}}
                            <div>
                                <button @click="wholesaleModalOpen = true" class="inline-block whitespace-nowrap border border-blue-200 rounded py-2 px-5 text-[14px] font-bold text-[#1a5b82] hover:bg-blue-50 transition-colors bg-[#ebf8ff] shadow-sm">
                                    Get Wholesale Deals Now!
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div> {{-- Close Product details bg-white container --}}

        {{-- Related Products / Suggested Posts --}}
        <div class="mt-6 bg-white rounded shadow-sm border border-gray-100 p-4 lg:p-6 relative" x-data="{
            scrollNext() { 
                const itemWidth = this.$refs.slider.firstElementChild ? this.$refs.slider.firstElementChild.offsetWidth + 16 : 300;
                this.$refs.slider.scrollBy({ left: itemWidth, behavior: 'smooth' }) 
            },
            scrollPrev() { 
                const itemWidth = this.$refs.slider.firstElementChild ? this.$refs.slider.firstElementChild.offsetWidth + 16 : 300;
                this.$refs.slider.scrollBy({ left: -itemWidth, behavior: 'smooth' }) 
            },
            startAutoScroll() {
                this.autoScrollInterval = setInterval(() => {
                    const slider = this.$refs.slider;
                    if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                        slider.scrollTo({ left: 0, behavior: 'smooth' });
                    } else {
                        this.scrollNext();
                    }
                }, 3000);
            },
            stopAutoScroll() {
                clearInterval(this.autoScrollInterval);
            }
        }" x-init="startAutoScroll()" @mouseenter="stopAutoScroll()" @mouseleave="startAutoScroll()" @touchstart="stopAutoScroll()" @touchend="startAutoScroll()">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold font-bangla">Suggested Products</h2>
                <div class="flex gap-2">
                    <button @click="scrollPrev" class="p-2 rounded-full bg-gray-100 hover:bg-blue-600 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button @click="scrollNext" class="p-2 rounded-full bg-gray-100 hover:bg-blue-600 hover:text-white transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
            <div x-ref="slider" class="flex overflow-x-auto gap-2 md:gap-4 pb-4 scrollbar-hide snap-x snap-mandatory" style="scroll-behavior: smooth;">
                @if($relatedProducts->count() > 0)
                    @foreach($relatedProducts->take(5) as $relatedProduct)
                        <div class="shrink-0 w-[calc(50%-4px)] md:w-48 lg:w-56 snap-start h-full">
                            @include('partials.product-card', ['product' => $relatedProduct])
                        </div>
                    @endforeach
                @else
                    {{-- Placeholder items for design testing --}}
                    @for($i = 0; $i < 5; $i++)
                        <div class="shrink-0 w-[calc(50%-4px)] md:w-48 lg:w-56 snap-start h-full">
                            <div class="bg-gray-50 border border-gray-100 rounded p-4 h-64 flex flex-col items-center justify-center text-gray-400">
                                <svg class="w-12 h-12 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-medium">Related Product {{ $i + 1 }}</span>
                                <span class="text-xs mt-1 text-gray-400">৳0.00</span>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
        </div>
        
        {{-- Tabs Section --}}
        <div id="tabs-section" x-data="{ activeTab: 'description' }" class="mt-6 bg-white rounded shadow-sm border border-gray-100 overflow-hidden mb-6">
            <div class="flex border-b border-gray-200 bg-gray-50 px-4 lg:px-6 overflow-x-auto scrollbar-hide">
                <button @click="activeTab = 'description'" :class="{ 'border-blue-600 text-blue-600 bg-white': activeTab === 'description', 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-gray-100': activeTab !== 'description' }" class="px-6 py-4 text-sm font-medium border-t-2 border-l border-r -mb-px transition-colors whitespace-nowrap">Description</button>
                
                <button @click="activeTab = 'specifications'" :class="{ 'border-blue-600 text-blue-600 bg-white': activeTab === 'specifications', 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-gray-100': activeTab !== 'specifications' }" class="px-6 py-4 text-sm font-medium border-t-2 border-l border-r -mb-px transition-colors whitespace-nowrap">Specifications</button>
            </div>

            <div class="p-6 md:p-10 min-h-[300px]">
                {{-- Description Tab --}}
                <div x-show="activeTab === 'description'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    @if($product->description)
                        <div class="prose max-w-none text-gray-700">
                            {!! $product->description !!}
                        </div>
                    @else
                        <div class="text-gray-500 italic">No description available for this product.</div>
                    @endif
                </div>

                {{-- Specifications Tab --}}
                <div x-show="activeTab === 'specifications'" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    @if(is_array($product->specifications) && count($product->specifications) > 0)
                        @php
                            $specs = $product->specifications;
                            $half = ceil(count($specs) / 2);
                            $leftSpecs = array_slice($specs, 0, $half, true);
                            $rightSpecs = array_slice($specs, $half, null, true);
                        @endphp
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-6">
                            <!-- Left Column -->
                            <div class="mb-4 lg:mb-0">
                                <table class="w-full text-sm text-left h-full">
                                    <tbody>
                                        @foreach($leftSpecs as $key => $value)
                                            <tr class="border-b border-gray-100 last:border-b-0">
                                                <th class="w-2/5 px-6 py-4 font-semibold text-gray-700 bg-gray-50 border-r border-gray-100 align-top">{{ $key }}</th>
                                                <td class="px-6 py-4 text-gray-600 align-top">{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Right Column -->
                            <div>
                                @if(count($rightSpecs) > 0)
                                <table class="w-full text-sm text-left h-full">
                                    <tbody>
                                        @foreach($rightSpecs as $key => $value)
                                            <tr class="border-b border-gray-100 last:border-b-0">
                                                <th class="w-2/5 px-6 py-4 font-semibold text-gray-700 bg-gray-50 border-r border-gray-100 align-top">{{ $key }}</th>
                                                <td class="px-6 py-4 text-gray-600 align-top">{{ $value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-gray-500 italic">No specifications available for this product.</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Ratings & Reviews --}}
        <div class="mt-8 mb-8" id="reviews-section">
            <livewire:product-reviews :product="$product" />
        </div>

        {{-- Questions & Answers --}}
        <div class="mt-8 mb-8" id="qa-section">
            <livewire:product-questions :product="$product" />
        </div>

        {{-- Wholesale Modal --}}
        <div x-show="wholesaleModalOpen" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div x-show="wholesaleModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-600 bg-opacity-75 transition-opacity" @click="wholesaleModalOpen = false" aria-hidden="true"></div>
    
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
                <!-- Modal panel -->
                <div x-show="wholesaleModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block align-bottom bg-white rounded text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle max-w-2xl w-full relative z-[101]">
                    <button @click="wholesaleModalOpen = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 bg-gray-100 rounded-full p-1">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    
                    <div class="px-6 pt-6 pb-8 sm:p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-4" id="modal-title">
                            Get Wholesale Deals Now!
                        </h3>
                        
                        <livewire:wholesale-request-component :productId="$product->id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layouts.app>
