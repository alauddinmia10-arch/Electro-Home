<?php

use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

?>

<div class="bg-gray-50 py-6">
    <div class="max-w-md mx-auto bg-white rounded shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-6 font-bangla">লগইন করুন</h2>
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($otpStep === 'request'): ?>
                <form wire:submit="requestOtp" class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="text" wire:model="otpPhone" class="form-input" placeholder="01XXXXXXXXX" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['otpPhone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm mt-1"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <label class="flex items-center gap-2 mt-2 mb-4">
                        <input type="checkbox" wire:model="remember" class="rounded border-gray-300 text-trust-blue focus:ring-trust-blue">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                    
                    <button type="submit" class="btn btn-primary w-full text-lg">
                        <span wire:loading.remove wire:target="requestOtp">Send OTP</span>
                        <span wire:loading wire:target="requestOtp">Sending...</span>
                    </button>
                </form>
            <?php else: ?>
                <form wire:submit="verifyOtp" class="space-y-5">
                    <div class="text-center mb-4">
                        <p class="text-sm text-gray-600">We've sent a 4-digit code to</p>
                        <p class="font-bold text-gray-800"><?php echo e($otpPhone); ?></p>
                        <p class="text-xs text-gray-500">And your registered email address</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1 text-center">Enter OTP</label>
                        <input type="text" wire:model="otpCode" class="form-input text-center text-xl tracking-[0.5em]" placeholder="••••" maxlength="4" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['otpCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="block text-red-500 text-sm mt-1 text-center"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-full text-lg">
                        <span wire:loading.remove wire:target="verifyOtp">Login</span>
                        <span wire:loading wire:target="verifyOtp">Verifying...</span>
                    </button>

                    <div class="text-center mt-4">
                        <button type="button" wire:click="goBackToPhone" class="text-sm text-trust-blue hover:underline">Change Phone Number</button>
                    </div>
                </form>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">Don't have an account? 
                    <a href="<?php echo e(route('register')); ?>" class="text-trust-blue font-semibold hover:underline">Register here</a>
                </p>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views\livewire/auth/login.blade.php ENDPATH**/ ?>