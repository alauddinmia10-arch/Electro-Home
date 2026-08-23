<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildSchema()); ?>

</div>
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\ElectroHome.BD\ElectroHome.BD\vendor\filament\schemas\resources\views/components/grid.blade.php ENDPATH**/ ?>