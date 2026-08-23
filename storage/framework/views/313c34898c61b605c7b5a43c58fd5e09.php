<?php

use App\Models\District;
use App\Models\Thana;
use App\Services\CartService;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;

?>

<?php
    $cartItems = app(\App\Services\CartService::class)->getItems();
?>

<div class="flex flex-col lg:flex-row gap-2 lg:gap-8">
    
    <div class="flex-1 space-y-2">
        
        
        <div class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-100 bg-white text-center">
                <h2 class="text-xl font-extrabold text-gray-800 tracking-wider font-bangla uppercase">YOUR ORDER</h2>
            </div>
            
            
            <div class="bg-gray-50/80 border-b border-gray-200 px-4 py-2.5 flex justify-between items-center text-xs font-bold text-gray-600 uppercase tracking-wider">
                <span>PRODUCT</span>
                <span>SUBTOTAL</span>
            </div>

            
            <div class="divide-y divide-gray-100">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="px-4 py-3.5 flex items-center justify-between gap-3">
                        
                        <div class="flex items-center gap-3 min-w-0 flex-1">
                            <a href="<?php echo e(route('product.show', $item->product->slug)); ?>" class="w-14 h-14 shrink-0 bg-white rounded border border-gray-100 overflow-hidden block p-0.5">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product->cover_image_url): ?>
                                    <img src="<?php echo e($item->product->cover_image_url); ?>" alt="<?php echo e($item->product->name); ?>" class="w-full h-full object-contain mix-blend-multiply">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </a>
                            <div class="min-w-0 flex-1">
                                <a href="<?php echo e(route('product.show', $item->product->slug)); ?>" class="font-semibold text-gray-800 text-sm leading-snug line-clamp-2 hover:text-[var(--color-trust-blue)]">
                                    <?php echo e($item->product->name); ?>

                                </a>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->product->sku): ?>
                                    <div class="text-[11px] text-gray-400 font-mono mt-0.5">SKU: <?php echo e($item->product->sku); ?></div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <div class="text-xs text-gray-500 font-medium mt-1">× <?php echo e($item->quantity); ?></div>
                            </div>
                        </div>

                        
                        <div class="text-right shrink-0 self-end pb-0.5">
                            <span class="font-bold text-gray-800 text-sm">৳<?php echo e(number_format($item->product->effective_price * $item->quantity, 0)); ?></span>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>

        
        <form wire:submit="submit" x-data x-on:submit="window.isOrderSubmitting = true" class="bg-white rounded-md shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-5 md:p-7 border-b border-gray-100">
                <div class="text-center mb-5">
                    <h2 class="text-[26px] font-extrabold text-gray-800 tracking-wider font-bangla uppercase">BILLING & SHIPPING</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4.5 mb-4.5">
                    <div>
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">আপনার নাম / Full Name *</label>
                        <input type="text" wire:model.blur="name" class="form-input text-xl" placeholder="আপনার নাম লিখুন..." required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    <div>
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">মোবাইল নাম্বার / Phone Number *</label>
                        <input type="tel" wire:model.blur="phone" class="form-input text-xl" placeholder="01XXXXXXXXX" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4.5 mb-4.5 min-w-0 max-w-full">
                    
                    <div x-data="{ open: false, search: '' }" class="relative min-w-0 max-w-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">District / জেলা *</label>
                        
                        <div @click="open = !open" 
                             class="form-input flex items-center justify-between cursor-pointer py-2.5 px-3 bg-white text-xl select-none">
                            <span class="truncate text-gray-800 font-medium">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($district): ?>
                                    <?php $selectedD = $districts->firstWhere('name', $district); ?>
                                    <?php echo e($selectedD ? ($selectedD->name . ' - ' . $selectedD->bn_name) : $district); ?>

                                <?php else: ?>
                                    <span class="text-gray-400">জেলা সিলেক্ট করুন</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                            <svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>

                        <div x-show="open" @click.away="open = false" x-cloak 
                             class="absolute z-50 left-0 right-0 top-full mt-1 bg-white border border-gray-200 rounded-md shadow-xl w-full text-left overflow-hidden block">
                            <div class="p-2 bg-white border-b border-gray-100">
                                <input type="text" x-model="search" placeholder="জেলা খুঁজুন..." class="w-full px-2.5 py-2 text-[18px] border border-gray-200 rounded focus:outline-none focus:border-[var(--color-trust-blue)]">
                            </div>
                            <div class="py-1 overflow-y-auto overscroll-contain touch-pan-y block" style="max-height: 400px; -webkit-overflow-scrolling: touch;">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <div x-show="!search || <?php echo e(json_encode(strtolower($d->name . ' ' . $d->bn_name))); ?>.includes(search.toLowerCase())"
                                         wire:click="selectDistrict(<?php echo e(json_encode($d->name)); ?>)"
                                         @click="open = false; search = '';"
                                         class="px-3 py-3 text-xl font-medium text-gray-700 hover:bg-blue-50 hover:text-[var(--color-trust-blue)] cursor-pointer transition-colors leading-snug <?php echo e($district === $d->name ? 'bg-blue-50 text-[var(--color-trust-blue)] font-bold' : ''); ?>">
                                        <?php echo e($d->name); ?> - <?php echo e($d->bn_name); ?>

                                    </div>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    
                    <div x-data="{ open: false, search: '' }" class="relative min-w-0 max-w-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">Thana / থানা *</label>
                        
                        <div @click="if(<?php echo e($thanas->isEmpty() ? 'false' : 'true'); ?>) open = !open" 
                             class="form-input flex items-center justify-between cursor-pointer py-2.5 px-3 bg-white text-xl select-none <?php if($thanas->isEmpty()): ?> opacity-60 cursor-not-allowed bg-gray-50 <?php endif; ?>">
                            <span class="truncate text-gray-800 font-medium">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($thana): ?>
                                    <?php $selectedT = $thanas->firstWhere('name', $thana); ?>
                                    <?php echo e($selectedT ? ($selectedT->name . ' - ' . $selectedT->bn_name) : $thana); ?>

                                <?php else: ?>
                                    <span class="text-gray-400">থানা সিলেক্ট করুন</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                            <svg class="w-4 h-4 text-gray-400 shrink-0 ml-2 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$thanas->isEmpty()): ?>
                            <div x-show="open" @click.away="open = false" x-cloak 
                                 class="absolute z-50 left-0 right-0 top-full mt-1 bg-white border border-gray-200 rounded-md shadow-xl w-full text-left overflow-hidden block">
                                <div class="p-2 bg-white border-b border-gray-100">
                                    <input type="text" x-model="search" placeholder="থানা খুঁজুন..." class="w-full px-2.5 py-2 text-[18px] border border-gray-200 rounded focus:outline-none focus:border-[var(--color-trust-blue)]">
                                </div>
                                <div class="py-1 overflow-y-auto overscroll-contain touch-pan-y block" style="max-height: 400px; -webkit-overflow-scrolling: touch;">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $thanas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <div x-show="!search || <?php echo e(json_encode(strtolower($t->name . ' ' . $t->bn_name))); ?>.includes(search.toLowerCase())"
                                             wire:click="selectThana(<?php echo e(json_encode($t->name)); ?>)"
                                             @click="open = false; search = '';"
                                             class="px-3 py-3 text-xl font-medium text-gray-700 hover:bg-blue-50 hover:text-[var(--color-trust-blue)] cursor-pointer transition-colors leading-snug <?php echo e($thana === $t->name ? 'bg-blue-50 text-[var(--color-trust-blue)] font-bold' : ''); ?>">
                                            <?php echo e($t->name); ?> - <?php echo e($t->bn_name); ?>

                                        </div>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['thana'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                <div class="mb-4.5">
                    <label class="block text-xl font-semibold text-gray-800 mb-1.5">সম্পূর্ণ ঠিকানা / Full Address *</label>
                    <textarea wire:model.blur="address" class="form-input resize-none text-xl" rows="3" placeholder="বাসা/ফ্ল্যাট নম্বর, রোড নম্বর, এলাকা লিখুন..." required></textarea>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4.5 mb-4.5">
                    <div>
                        <label class="block text-xl font-semibold text-gray-800 mb-1.5">Alternative Phone (Optional)</label>
                        <input type="tel" wire:model.blur="altPhone" class="form-input text-xl" placeholder="01XXXXXXXXX">
                    </div>
                </div>

                <div>
                    <label class="block text-xl font-semibold text-gray-800 mb-1.5">Order Note (Optional)</label>
                    <textarea wire:model="note" class="form-input resize-none text-xl" rows="2" placeholder="ডেলিভারির বিষয়ে বিশেষ কোনো তথ্য..."></textarea>
                </div>
            </div>

            <div class="p-5 md:p-7 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800 mb-4 font-bangla">পেমেন্ট মেথড</h2>
                <div class="space-y-3">
                    <label class="flex items-center p-4 border rounded cursor-pointer transition-colors hover:bg-white bg-white border-[var(--color-trust-blue)]">
                        <input type="radio" wire:model="paymentMethod" value="cod" class="w-5 h-5 text-[var(--color-trust-blue)] focus:ring-[var(--color-trust-blue)] border-gray-300">
                        <div class="ml-4 flex-1">
                            <span class="block font-bold text-gray-800 text-base">Cash on Delivery (COD)</span>
                            <span class="block text-sm text-gray-500">পণ্য হাতে পেয়ে পেমেন্ট করুন</span>
                        </div>
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </label>
                    <label class="flex items-center p-4 border rounded cursor-pointer transition-colors hover:bg-white <?php echo e($paymentMethod === 'online' ? 'bg-white border-[var(--color-trust-blue)]' : 'border-gray-200'); ?>">
                        <input type="radio" wire:model="paymentMethod" value="online" class="w-5 h-5 text-[var(--color-trust-blue)] focus:ring-[var(--color-trust-blue)] border-gray-300">
                        <div class="ml-4 flex-1">
                            <span class="block font-bold text-gray-800 text-base">Online Payment (SSLCommerz)</span>
                            <span class="block text-sm text-gray-500">বিকাশ, নগদ, রকেট বা কার্ডে পেমেন্ট করুন</span>
                        </div>
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                    </label>
                </div>
            </div>
        </form>
    </div>

    
    <div class="w-full lg:w-96 shrink-0">
        <div class="bg-white rounded-md shadow-sm border border-gray-200 p-3 md:p-6 sticky top-24">
            <div class="space-y-4 text-[18px] md:text-sm text-gray-600 mb-6 mt-2">
                <div class="flex justify-between">
                    <span>Subtotal (<?php echo e($cartItems->sum('quantity')); ?> items)</span>
                    <span class="font-semibold text-gray-800">৳<?php echo e(number_format($subtotal, 0)); ?></span>
                </div>
                <div class="flex justify-between">
                    <span>Delivery Charge</span>
                    <span class="font-semibold text-gray-800">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($deliveryCharge == 0): ?>
                            <span class="text-green-600 font-bold">Free</span>
                        <?php else: ?>
                            ৳<?php echo e(number_format($deliveryCharge, 0)); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </span>
                </div>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($freeDeliveryRemaining > 0): ?>
                <div class="free-delivery-banner mb-6">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span>আর মাত্র <strong>৳<?php echo e(number_format($freeDeliveryRemaining, 0)); ?></strong> টাকার বাজার করলেই পাচ্ছেন <strong>ফ্রি ডেলিভারি</strong>!</span>
                </div>
            <?php else: ?>
                <div class="bg-green-50 border border-green-200 text-green-700 px-2 md:px-4 py-3 md:py-3 rounded text-[20px] md:text-sm flex items-center justify-center gap-2 mb-6 font-bold text-center leading-tight">
                    🎉 অভিনন্দন! আপনি ফ্রি ডেলিভারি পাচ্ছেন।
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="border-t border-gray-100 pt-4 mb-6 flex justify-between items-end">
                <span class="font-bold text-gray-800 text-xl md:text-base">Total</span>
                <span class="text-3xl md:text-2xl font-bold text-price">৳<?php echo e(number_format($total, 0)); ?></span>
            </div>

            <button wire:click="submit" class="btn btn-confirm w-full py-3 md:py-3 text-2xl md:text-lg flex justify-center items-center gap-2 !bg-[#1f618d] hover:!bg-[#174a6c]">
                Confirm Order <svg class="w-5 h-5 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </button>
            <div wire:loading wire:target="submit" class="text-center text-sm text-gray-500 mt-2">
                Processing your order...
            </div>
            
            <p class="text-[14px] md:text-xs text-gray-400 text-center mt-4">
                By confirming the order, you agree to our Terms of Service and Privacy Policy.
            </p>
        </div>
    </div>
</div>

    <?php
        $__scriptKey = '618718923-0';
        ob_start();
    ?>
<script>
    window.isOrderSubmitting = false;

    document.addEventListener('livewire:initialized', () => {
        Livewire.hook('commit', ({ component, succeed, fail }) => {
            succeed(() => {
                setTimeout(() => { window.isOrderSubmitting = false; }, 100);
            });
            fail(() => {
                window.isOrderSubmitting = false;
            });
        });
    });

    const saveIncomplete = () => {
        if (!window.isOrderSubmitting) {
            let data = {
                session_id: '<?php echo e(session()->getId()); ?>',
                name: $wire.name,
                phone: $wire.phone,
                district: $wire.district,
                thana: $wire.thana,
                address: $wire.address,
                altPhone: $wire.altPhone,
                _token: '<?php echo e(csrf_token()); ?>',
                cart_data: {
                    subtotal: $wire.subtotal,
                    total: $wire.total
                }
            };
            const blob = new Blob([JSON.stringify(data)], { type: 'application/json' });
            navigator.sendBeacon('/api/checkout/abandon', blob);
        }
    };

    document.addEventListener("visibilitychange", function() {
        if (document.visibilityState === 'hidden') {
            saveIncomplete();
        }
    });

    window.addEventListener("beforeunload", function() {
        saveIncomplete();
    });
</script>
    <?php
        $__output = ob_get_clean();

        \Livewire\store($this)->push('scripts', $__output, $__scriptKey)
    ?><?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\ElectroHome.BD\ElectroHome.BD\resources\views\livewire/checkout-process.blade.php ENDPATH**/ ?>