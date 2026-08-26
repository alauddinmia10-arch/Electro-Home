<div>
    <style>
        @media (max-width: 767px) {
            header, footer, .mobile-nav { display: none !important; }
        }
        .falaq-fieldset {
            border: 1px solid #9ca3af;
            border-radius: 6px;
            padding: 2px 10px 4px 10px;
            margin-bottom: 8px;
            background-color: transparent;
        }
        .falaq-fieldset:focus-within {
            border-color: #28a745;
        }
        .falaq-fieldset:focus-within .falaq-legend {
            color: #28a745;
        }
        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .animate-heartbeat {
            animation: heartbeat 1.2s ease-in-out infinite;
        }
        .falaq-legend {
            font-size: 0.65rem;
            color: #9ca3af;
            padding: 0 4px;
            margin-left: -4px;
        }
        /* Hide scrollbar for textarea */
        textarea::-webkit-scrollbar { display: none; }
    </style>

    {{-- Custom Mobile Header for Landing Page --}}
    <div class="md:hidden flex items-center justify-between px-4 py-2 bg-white border-b border-gray-100 shadow-sm sticky top-0 z-[60]">
        <div class="w-28 shrink-0 transform scale-[1.12] origin-left">
            <x-logo theme="light" />
        </div>
        <div class="flex items-center gap-3">
            <a href="tel:+8801880223099" class="text-[#1baf4e] hover:text-[#109a49] p-0.5 transition-colors" aria-label="Call Us">
                <svg class="w-[29px] h-[29px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
            </a>
            <a href="https://wa.me/8801880223099" target="_blank" class="text-[#1baf4e] hover:text-[#109a49] transition-colors p-0.5" aria-label="WhatsApp">
                <svg class="w-[27px] h-[27px]" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </a>
        </div>
    </div>

    <div class="max-w-[1600px] w-full mx-auto px-3 md:px-6 xl:px-[70px] pb-20 pt-0 md:pt-8">
        <form id="checkout-form" wire:submit.prevent="placeOrder" class="grid grid-cols-1 lg:grid-cols-12 gap-4 bg-white p-0">
            
            {{-- Column 1: Product Image (4 cols) --}}
            <div class="lg:col-span-4 flex justify-start items-start">
                <img src="{{ $product->cover_image_url }}" alt="{{ $product->name }}" class="w-full object-contain mix-blend-multiply">
            </div>

            {{-- Column 2: Info & Form (4 cols) --}}
            <div class="lg:col-span-4 flex flex-col">
                <h1 class="text-[26px] font-bold text-gray-900 leading-snug mb-1">{{ $product->name }}</h1>
                
                <div class="flex flex-col gap-1.5 mb-2 mt-2 text-[13px] text-gray-700">
                    @if($product->sku)
                        <div class="flex items-center">
                            <span class="w-20 font-medium">SKU</span>
                            <span class="mr-2">:</span>
                            <span class="font-bold text-gray-900">{{ $product->sku }}</span>
                        </div>
                    @endif
                    <div class="flex items-center">
                        <span class="w-20 font-medium">Brand</span>
                        <span class="mr-2">:</span>
                        <span class="font-bold text-[#094d82] uppercase">{{ $product->brand->name ?? 'TOMZN' }}</span>
                    </div>
                    <div class="flex items-center">
                        <span class="w-20 font-medium">Warranty</span>
                        <span class="mr-2">:</span>
                        <span class="font-bold text-gray-900">{{ $product->warranty ?? '15 Days' }}</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-3 mb-3 mt-1">
                    <span class="text-[28px] font-extrabold text-[#f97316]">৳{{ number_format($product->effective_price, 0) }}</span>
                    @if($product->discount_price && $product->discount_price < $product->regular_price)
                        <span class="text-sm text-gray-400 line-through">৳{{ number_format($product->regular_price, 0) }}</span>
                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-[11px] font-bold">
                            Save ৳{{ number_format($product->regular_price - $product->effective_price, 0) }}
                        </span>
                    @endif
                </div>

                {{-- Quantity Selector inside a single border --}}
                <div class="mb-2 flex items-center justify-between border border-[#9ca3af] rounded-lg p-2 w-full">
                    <span class="text-[13px] text-gray-600 font-medium pl-3">Quantity</span>
                    <div class="flex items-center gap-3">
                        <button type="button" wire:click="decrement" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-green-600 focus:outline-none transition-colors text-xl">
                            -
                        </button>
                        <span class="text-sm font-bold text-green-600 w-4 text-center">{{ $quantity }}</span>
                        <button type="button" wire:click="increment" class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-green-600 focus:outline-none transition-colors text-xl">
                            +
                        </button>
                    </div>
                </div>

                {{-- Checkout Form --}}
                <div class="mt-2">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-7 h-7 rounded-full bg-[#094d82] text-white flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <h2 class="text-[18px] font-bold text-gray-900">Enter your information</h2>
                    </div>

                    <div class="">
                        <fieldset class="falaq-fieldset relative">
                            <legend class="falaq-legend">Full Name <span class="text-red-500">*</span></legend>
                            <div class="flex items-center gap-2 relative z-10">
                                <svg class="w-[14px] h-[14px] text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                <input type="text" wire:model="name" class="w-full border-none p-0 focus:ring-0 text-[13px] h-7 bg-transparent" placeholder="আপনার নাম লিখুন...." required>
                            </div>
                        </fieldset>
                        @error('name') <span class="text-red-500 text-[10px] block -mt-1 mb-2">{{ $message }}</span> @enderror

                        <fieldset class="falaq-fieldset relative">
                            <legend class="falaq-legend">Phone Number <span class="text-red-500">*</span></legend>
                            <div class="flex items-center gap-2 relative z-10">
                                <svg class="w-[14px] h-[14px] text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <input type="tel" wire:model="phone" class="w-full border-none p-0 focus:ring-0 text-[13px] h-7 bg-transparent" placeholder="01XXXXXXXXX" required>
                            </div>
                        </fieldset>
                        @error('phone') <span class="text-red-500 text-[10px] block -mt-1 mb-2">{{ $message }}</span> @enderror

                        <fieldset class="falaq-fieldset relative">
                            <legend class="falaq-legend">Address <span class="text-red-500">*</span></legend>
                            <div class="flex items-center gap-2 relative z-10">
                                <svg class="w-[14px] h-[14px] text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <textarea wire:model="address" rows="3" class="w-full border-none p-0 focus:ring-0 text-[13px] resize-none bg-transparent" placeholder="আপনার ঠিকানা লিখুন...." required></textarea>
                            </div>
                        </fieldset>
                        @error('address') <span class="text-red-500 text-[10px] block -mt-1 mb-2">{{ $message }}</span> @enderror

                        <fieldset class="falaq-fieldset relative">
                            <legend class="falaq-legend">Order Notes (Optional)</legend>
                            <div class="flex items-start gap-2 pt-0.5 relative z-10">
                                <svg class="w-[14px] h-[14px] text-gray-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                <textarea wire:model="note" rows="3" class="w-full border-none p-0 focus:ring-0 text-[13px] resize-none overflow-hidden bg-transparent" placeholder="Share your notes"></textarea>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            {{-- Column 3: Delivery & Summary (4 cols) --}}
            <div class="lg:col-span-4 flex flex-col mt-6 lg:mt-0">
                <div class="border border-gray-100 rounded-2xl p-4 pt-3 shadow-[0_0_15px_rgba(0,0,0,0.03)] bg-white relative overflow-visible">
                    
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-[22px] h-[22px] rounded-full bg-[#094d82] text-white flex items-center justify-center shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <h2 class="text-[16px] font-bold text-gray-900">Select your delivery area</h2>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-4 relative z-10">
                        <label class="cursor-pointer relative w-full">
                            <input type="radio" wire:model.live="delivery_area" value="inside_dhaka" class="peer sr-only">
                            <div class="rounded-[4px] border transition-all peer-checked:border-[#094d82] peer-checked:bg-[#f0f6fa] bg-white border-gray-200 h-16 flex flex-col justify-center items-center text-center relative z-0">
                                <div class="text-[12px] font-medium mb-0.5 text-gray-600">Inside Dhaka</div>
                                <div class="text-[15px] font-bold text-gray-900">৳70</div>
                            </div>
                            @if($delivery_area === 'inside_dhaka')
                                <div class="absolute -top-[9px] right-2 w-[18px] h-[18px] bg-[#094d82] rounded-full flex items-center justify-center text-white border-2 border-white shadow-sm z-10">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            @endif
                        </label>

                        <label class="cursor-pointer relative w-full">
                            <input type="radio" wire:model.live="delivery_area" value="outside_dhaka" class="peer sr-only">
                            <div class="rounded-[4px] border transition-all peer-checked:border-[#094d82] peer-checked:bg-[#f0f6fa] bg-white border-gray-200 h-16 flex flex-col justify-center items-center text-center relative z-0">
                                <div class="text-[12px] font-medium mb-0.5 text-gray-600">Outside Dhaka</div>
                                <div class="text-[15px] font-bold text-gray-900">৳130</div>
                            </div>
                            @if($delivery_area === 'outside_dhaka')
                                <div class="absolute -top-[9px] right-2 w-[18px] h-[18px] bg-[#094d82] rounded-full flex items-center justify-center text-white border-2 border-white shadow-sm z-10">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            @endif
                        </label>
                    </div>

                    {{-- Summary Box --}}
                    <div class="mb-3 border border-gray-200 rounded-lg p-4">
                        <div class="flex gap-2.5 items-center border-b border-gray-100 pb-3 mb-3">
                            <img src="{{ $product->cover_image_url }}" alt="{{ $product->name }}" class="w-9 h-9 object-cover rounded shadow-sm border border-gray-50">
                            <div class="flex-1">
                                <h4 class="text-[11px] font-semibold text-gray-800 line-clamp-2 leading-tight">{{ $product->name }}</h4>
                                <div class="text-[10px] text-[#28a745] font-bold mt-0.5">{{ $quantity }}x</div>
                            </div>
                            <div class="font-bold text-gray-900 text-[13px] shrink-0">৳{{ number_format($product->effective_price * $quantity, 0) }}</div>
                        </div>

                        <div class="space-y-1.5 text-[12px] text-gray-400 font-medium mb-3">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span class="text-gray-800">৳{{ number_format($product->effective_price * $quantity, 0) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Delivery Charge</span>
                                <span class="text-gray-800">৳{{ $delivery_charge }}</span>
                            </div>
                        </div>

                        <div class="pt-3 flex justify-between items-center border-t border-gray-100 mt-3">
                            <span class="font-bold text-gray-800 text-[13px]">Total Price</span>
                            <span class="text-[20px] font-extrabold text-[#f97316]">৳{{ number_format(($product->effective_price * $quantity) + $delivery_charge + $this->upsell_total, 0) }}</span>
                        </div>
                    </div>

                    <p class="text-[10px] text-gray-400 mb-3 leading-[1.6] text-left pr-2">
                        Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="#" class="text-[#28a745] font-medium">privacy policy</a>.
                    </p>

                    {{-- Best Match For Your Order (Upsell) --}}
                    @if($suggested_products && count($suggested_products) > 0)
                    <div class="mb-2">
                        <h3 class="font-bold text-gray-900 mb-3 text-[17px]">Best Match For Your Order</h3>
                        <div class="space-y-3">
                            @foreach($suggested_products as $upsell)
                                <label class="flex items-center gap-3 cursor-pointer group border border-gray-200 rounded-2xl p-3.5 hover:border-[#094d82] transition-all bg-white {{ in_array($upsell->id, $upsell_products ?? []) ? '!border-[#094d82] shadow-sm bg-[#f0f6fa]' : '' }}">
                                    <input type="checkbox" wire:model.live="upsell_products" value="{{ $upsell->id }}" class="peer sr-only">
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300 peer-checked:border-[#094d82] peer-checked:bg-[#094d82] flex items-center justify-center shrink-0 transition-colors">
                                        <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                    <img src="{{ $upsell->cover_image_url }}" alt="{{ $upsell->name }}" class="w-8 h-8 object-contain rounded shrink-0">
                                    <div class="flex-1 pr-2 min-w-0">
                                        <div class="text-[11px] font-semibold text-gray-700 leading-tight mb-0.5 group-hover:text-[#28a745] transition-colors line-clamp-2 overflow-hidden" title="{{ $upsell->name }}">{{ $upsell->name }}</div>
                                    </div>
                                    <div class="text-[12px] font-bold text-[#28a745] whitespace-nowrap shrink-0 flex flex-col items-end">
                                        ৳{{ number_format($upsell->effective_price, 0) }}
                                        @if($upsell->discount_price)
                                            <span class="text-[8px] font-bold text-blue-500 border border-blue-200 rounded-[3px] px-1 bg-blue-50 mt-0.5">Save ৳{{ number_format($upsell->regular_price - $upsell->effective_price, 0) }}</span>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Order Button inside column 3 --}}
                    <div class="hidden lg:flex w-full mt-2">
                        <button type="submit" class="w-full bg-[#094d82] hover:bg-[#063357] text-white font-extrabold py-4 rounded-lg shadow-md transition-all flex justify-center items-center gap-2 text-[22px]">
                            <svg class="w-[24px] h-[24px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                            অর্ডার কনফার্ম করুন
                        </button>
                    </div>

                </div>
            </div>
            
        </form>

        {{-- Expandable Description & Specifications --}}
        <div x-data="{ showDetails: false }" class="mt-4 mb-4 border-t border-gray-200 pt-6 px-4 lg:px-8">
            <button type="button" @click="showDetails = !showDetails" class="w-full flex items-center justify-center gap-2 text-[#094d82] font-bold text-[16px] hover:text-[#063357] transition-colors py-3.5 bg-[#f0f6fa] rounded-lg border border-[#094d82] shadow-sm">
                প্রোডাক্ট সম্পর্কে বিস্তারিত জানতে এখানে ক্লিক করুন
                <svg class="w-5 h-5 transform transition-transform duration-300" :class="{ 'rotate-180': showDetails }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
            </button>

            <div x-show="showDetails" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="mt-6">
                {{-- Tabs Section --}}
                <div id="tabs-section" x-data="{ activeTab: 'description' }" class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="flex border-b border-gray-200 bg-gray-50 px-2 sm:px-4 overflow-x-auto scrollbar-hide">
                        <button type="button" @click="activeTab = 'description'" :class="{ 'border-blue-600 text-blue-600 bg-white': activeTab === 'description', 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-gray-100': activeTab !== 'description' }" class="px-4 py-3 text-sm font-medium border-t-2 border-l border-r -mb-px transition-colors whitespace-nowrap outline-none">Description</button>
                        
                        <button type="button" @click="activeTab = 'specifications'" :class="{ 'border-blue-600 text-blue-600 bg-white': activeTab === 'specifications', 'border-transparent text-gray-600 hover:text-gray-900 hover:bg-gray-100': activeTab !== 'specifications' }" class="px-4 py-3 text-sm font-medium border-t-2 border-l border-r -mb-px transition-colors whitespace-nowrap outline-none">Specifications</button>
                    </div>

                    <div class="p-4 sm:p-6 min-h-[200px]">
                        {{-- Description Tab --}}
                        <div x-show="activeTab === 'description'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                            @if($product->description)
                                <div class="prose max-w-none text-gray-700 prose-sm sm:prose-base">
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
                                                        <th class="w-2/5 px-4 py-3 font-semibold text-gray-700 bg-gray-50 border-r border-gray-100 align-top">{{ $key }}</th>
                                                        <td class="px-4 py-3 text-gray-600 align-top">{{ $value }}</td>
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
                                                        <th class="w-2/5 px-4 py-3 font-semibold text-gray-700 bg-gray-50 border-r border-gray-100 align-top">{{ $key }}</th>
                                                        <td class="px-4 py-3 text-gray-600 align-top">{{ $value }}</td>
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
            </div>
        </div>

    </div>

    {{-- Sticky Order Bar for Mobile ONLY --}}
    <div class="md:hidden fixed bottom-0 left-0 w-full bg-white/75 backdrop-blur-md border-t border-white/50 px-4 py-1.5 shadow-[0_-4px_15px_-1px_rgba(0,0,0,0.08)] z-[60] flex items-center justify-between">
        <div class="text-[15px] font-bold text-gray-800 flex items-center gap-1.5">
            Total: <span class="text-[19px] text-[#f97316]">৳{{ number_format(($product->effective_price * $quantity) + $delivery_charge + $this->upsell_total, 0) }}</span>
        </div>
        <button type="submit" form="checkout-form" class="animate-heartbeat bg-[#094d82] hover:bg-[#063357] text-white font-bold text-[17px] px-6 py-2.5 rounded shadow-md transition-colors flex justify-center items-center gap-1.5 shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
            অর্ডার কনফার্ম করুন
        </button>
    </div>
</div>

@script
<script>
    const requiredInputs = $el.querySelectorAll('[required]');
    
    requiredInputs.forEach(input => {
        // Set initial custom validity if empty
        if (!input.value.trim()) {
            input.setCustomValidity('অনুগ্রহ করে এই ঘরটি পূরণ করুন।');
        }
        
        // Update validity on input
        input.addEventListener('input', function() {
            if (!this.value.trim()) {
                this.setCustomValidity('অনুগ্রহ করে এই ঘরটি পূরণ করুন।');
            } else {
                this.setCustomValidity('');
            }
        });
        
        // Scroll to center on invalid
        input.addEventListener('invalid', function() {
            // A slight delay ensures the browser focuses the first invalid element before we scroll
            setTimeout(() => {
                this.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }, 10);
        });
    });
</script>
@endscript
