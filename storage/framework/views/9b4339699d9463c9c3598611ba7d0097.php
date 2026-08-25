<input
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
                'type' => 'hidden',
                $applyStateBindingModifiers('wire:model') => $getStatePath(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)
            ->class(['fi-fo-hidden'])); ?>

/>
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\vendor\filament\forms\resources\views/components/hidden.blade.php ENDPATH**/ ?>