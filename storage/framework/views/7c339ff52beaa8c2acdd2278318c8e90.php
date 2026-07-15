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

    <div class="max-w-2xl mx-auto py-16 px-4">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-8 text-center text-white">
                <h2 class="text-2xl font-bold mb-2">SSLCommerz (Mock Sandbox)</h2>
                <p class="opacity-90">This is a local testing gateway.</p>
            </div>
            
            <div class="p-8 text-center space-y-6">
                <p class="text-gray-600">Simulate a payment response for Order: <span class="font-bold text-gray-900"><?php echo e($tran_id); ?></span></p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    <!-- Success -->
                    <form action="<?php echo e(route('payment.success')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="tran_id" value="<?php echo e($tran_id); ?>">
                        <input type="hidden" name="val_id" value="mock_val_id_<?php echo e(time()); ?>">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-medium rounded-lg shadow-md transition-colors">
                            Simulate Success
                        </button>
                    </form>

                    <!-- Fail -->
                    <form action="<?php echo e(route('payment.fail')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="tran_id" value="<?php echo e($tran_id); ?>">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-medium rounded-lg shadow-md transition-colors">
                            Simulate Failure
                        </button>
                    </form>

                    <!-- Cancel -->
                    <form action="<?php echo e(route('payment.cancel')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="tran_id" value="<?php echo e($tran_id); ?>">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg shadow-md transition-colors">
                            Simulate Cancel
                        </button>
                    </form>
                </div>
                
                <p class="text-xs text-gray-400 mt-8">Note: In production with real credentials, this page is skipped and users are sent directly to the bank payment portal.</p>
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
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\electro-bd\resources\views\payment\mock.blade.php ENDPATH**/ ?>