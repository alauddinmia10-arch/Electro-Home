<?php $__env->startComponent('layouts.app'); ?>
<div class="bg-gray-100 py-2 md:py-6">
    <div class="max-w-[1600px] w-full mx-auto px-2 md:px-2 md:px-4 xl:px-[70px] flex justify-center items-start">
        <div class="w-full max-w-2xl bg-white rounded-md shadow-sm border border-gray-200 p-3 md:p-6 flex flex-col justify-center text-center">
            <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-8">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h2 class="text-[32px] sm:text-4xl md:text-5xl font-bold text-gray-800 mb-6 font-bangla leading-tight">অভিনন্দন, আপনার অর্ডারটি<br>সফল হয়েছে!</h2>
            <div class="text-2xl md:text-3xl text-gray-600 mb-4 leading-tight flex flex-col items-center gap-2">
                <span>আপনার অর্ডার ইনভয়েস নাম্বার:</span>
                <span class="text-xl md:text-2xl font-semibold text-black"><?php echo e($order->invoice_number); ?></span>
            </div>
            
            <div class="bg-blue-50 rounded py-6 px-2 md:px-6 mb-4 text-2xl md:text-3xl text-blue-800 font-bangla font-medium leading-tight">
                আপনার অর্ডারের বর্তমান অবস্থা (Status) জানতে লগইন করে ড্যাশবোর্ড চেক করুন।
            </div>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center mt-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary bg-[var(--color-trust-blue)] text-white px-8 py-4 rounded hover:brightness-90 hover:bg-[var(--color-trust-blue)] border-none transition font-bangla text-3xl md:text-4xl w-full sm:w-auto">লগইন করুন</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary bg-[var(--color-trust-blue)] text-white px-8 py-4 rounded hover:brightness-90 hover:bg-[var(--color-trust-blue)] border-none transition font-bangla text-3xl md:text-4xl w-full sm:w-auto">ড্যাশবোর্ড</a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <a href="<?php echo e(route('home')); ?>" class="btn bg-green-600 text-white border-none px-8 py-4 rounded hover:brightness-90 hover:bg-green-600 transition font-bangla text-3xl md:text-4xl shadow-sm w-full sm:w-auto">হোমে ফিরে যান</a>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\ElectroHome.BD\ElectroHome.BD\resources\views/checkout-success.blade.php ENDPATH**/ ?>