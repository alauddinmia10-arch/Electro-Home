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

    <style>
        @media (max-width: 767px) {
            header .md\:hidden.w-full { display: none !important; }
            footer { display: none !important; }
        }
        @media print {
            @page { margin: 0; }
            html, body { 
                margin: 0 !important; 
                padding: 0 !important; 
                height: auto !important; 
                min-height: 0 !important; 
            }
            main { padding-bottom: 0 !important; }
            .min-h-screen { min-height: 0 !important; }
            header, footer, .mobile-nav, .mobile-nav-item, #floating-cart { display: none !important; }
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
    <div class="bg-[#f9fbf7] pt-1 pb-8 md:pt-4 md:pb-12 print:py-0 min-h-screen print:min-h-0 font-bangla">
        <div class="max-w-[1600px] w-full mx-auto px-2 sm:px-4 flex justify-center items-start">
            <div class="w-full max-w-[600px] px-3 pb-3 pt-1 md:px-6 md:pb-6 md:pt-2 text-center relative overflow-hidden">
                
                
                <div class="hidden print:flex justify-center pt-8 mb-8">
                    <img src="<?php echo e(asset('images/logo-header.webp')); ?>" alt="ElectroHome Logo" class="h-14 w-auto object-contain">
                </div>

                
                <div class="w-20 h-20 bg-[#159a5c] text-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md shadow-green-100 ring-8 ring-green-50" style="-webkit-print-color-adjust: exact; print-color-adjust: exact;">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                
                <h2 class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-2.5 tracking-tight">অর্ডার সফলভাবে সম্পন্ন হয়েছে!</h2>
                
                <p class="text-[15px] md:text-base text-gray-600 mb-2 leading-relaxed px-2">
                    আপনার ইলেকট্রনিক্স পণ্যের দায়িত্ব আমাদের হাতে তুলে দেওয়ার জন্য আন্তরিক ধন্যবাদ। ElectroHome-এর প্রতি আপনার আস্থা আমাদের সবচেয়ে বড় প্রাপ্তি এবং এগিয়ে যাওয়ার অনুপ্রেরণা।
                </p>
                <p class="text-[15px] md:text-base text-gray-600 mb-5 leading-relaxed px-2">
                    আপনার বিশ্বাসের মর্যাদা রাখতে আমরা প্রতিশ্রুতিবদ্ধ।
                </p>

                <div class="mb-5">
                    <p class="text-sm text-gray-500 font-medium mb-1">অর্ডার আইডি</p>
                    <h3 class="text-2xl md:text-3xl font-bold text-[#159a5c]">#<?php echo e($order->invoice_number); ?></h3>
                </div>

                
                <div class="border border-gray-100 rounded-2xl p-4 md:p-5 mb-4 bg-white shadow-sm text-left">
                    <h4 class="font-bold text-gray-800 text-lg mb-3">Order Details</h4>
                    
                    <div class="space-y-3 mb-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <div class="flex justify-between items-start gap-4">
                            <div class="text-sm text-gray-700 leading-snug pr-4">
                                <?php echo e($item->product ? $item->product->name : 'Unknown Product'); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->quantity > 1): ?>
                                    <span class="text-gray-500 font-medium ml-1">x <?php echo e($item->quantity); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="font-bold text-gray-800 whitespace-nowrap">৳<?php echo e(number_format($item->total, 0)); ?></div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                    
                    <div class="border-t border-gray-200 border-dashed pt-3 space-y-2">
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-700">৳<?php echo e(number_format($order->subtotal, 0)); ?></span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>Delivery Charge</span>
                            <span class="font-medium text-gray-700">৳<?php echo e(number_format($order->delivery_charge, 0)); ?></span>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 mt-3 pt-3 flex justify-between items-center">
                        <span class="font-medium text-gray-700">Total Price</span>
                        <span class="font-bold text-[#159a5c] text-lg">৳<?php echo e(number_format($order->total_amount, 0)); ?></span>
                    </div>
                </div>

                
                <div class="border border-gray-100 rounded-2xl p-4 md:p-5 mb-5 bg-white shadow-sm text-left">
                    <h4 class="font-bold text-gray-800 text-lg mb-2">Shipping Address</h4>
                    
                    <div class="text-sm text-gray-700 space-y-1.5">
                        <p class="font-bold text-gray-900"><?php echo e($order->customer_name); ?></p>
                        <p><?php echo e($order->customer_phone); ?></p>
                        <p class="leading-relaxed"><?php echo e($order->full_delivery_address); ?></p>
                    </div>
                </div>

                <p class="text-gray-600 font-medium mb-4">আমরা শীঘ্রই আপনার সাথে যোগাযোগ করব।</p>
                
                
                <div class="flex flex-col sm:flex-row gap-3 justify-center print:hidden">
                    <button onclick="window.print()" class="flex-1 flex items-center justify-center gap-2 border-2 border-[#159a5c] text-[#159a5c] bg-white px-6 py-3.5 rounded-lg hover:bg-green-50 transition-colors font-bold text-[15px]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        Print Receipt
                    </button>
                    <a href="<?php echo e(route('shop')); ?>" class="flex-1 flex items-center justify-center gap-2 bg-[#159a5c] text-white px-6 py-3.5 rounded-lg hover:bg-[#11804c] shadow-md shadow-green-100 transition-colors font-bold text-[15px]">
                        Continue Shopping 
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
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
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views/checkout-success.blade.php ENDPATH**/ ?>