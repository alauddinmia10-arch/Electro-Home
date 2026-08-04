<a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2.5 shrink-0 group" aria-label="ElectroHome">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($theme) && $theme === 'dark'): ?>
        
        <img src="<?php echo e(asset('images/logo-white-text.webp')); ?>" 
             alt="ElectroHome Logo" 
             class="h-9 md:h-12 w-auto object-contain transition-transform group-hover:scale-105"
             width="220" 
             height="48">
    <?php else: ?>
        
        <img src="<?php echo e(asset('images/logo-header.webp')); ?>" 
             alt="ElectroHome Logo" 
             class="h-9 md:h-12 w-auto object-contain transition-transform group-hover:scale-105"
             width="220" 
             height="48">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</a>
<?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\ElectroHome.BD\resources\views/components/logo.blade.php ENDPATH**/ ?>