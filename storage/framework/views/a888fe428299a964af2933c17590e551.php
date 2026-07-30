<?php

use Livewire\Volt\Component;
use Carbon\Carbon;

?>

<div 
    x-data="{
        endTime: new Date('<?php echo e($endTime); ?>').getTime(),
        days: '00',
        hours: '00',
        minutes: '00',
        seconds: '00',
        start() {
            setInterval(() => {
                let now = new Date().getTime();
                let distance = this.endTime - now;

                if (distance < 0) {
                    this.days = '00';
                    this.hours = '00';
                    this.minutes = '00';
                    this.seconds = '00';
                    return;
                }

                this.days = String(Math.floor(distance / (1000 * 60 * 60 * 24))).padStart(2, '0');
                this.hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
                this.minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
                this.seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');
            }, 1000);
        }
    }" 
    x-init="start()"
    class="flex items-center gap-2"
>
    <div class="flex items-center justify-center bg-red-100 text-red-600 font-bold w-10 h-10 rounded">
        <span x-text="days"></span>
    </div>
    <span class="text-red-600 font-bold">:</span>
    <div class="flex items-center justify-center bg-red-100 text-red-600 font-bold w-10 h-10 rounded">
        <span x-text="hours"></span>
    </div>
    <span class="text-red-600 font-bold">:</span>
    <div class="flex items-center justify-center bg-red-100 text-red-600 font-bold w-10 h-10 rounded">
        <span x-text="minutes"></span>
    </div>
    <span class="text-red-600 font-bold">:</span>
    <div class="flex items-center justify-center bg-red-100 text-red-600 font-bold w-10 h-10 rounded">
        <span x-text="seconds"></span>
    </div>
</div><?php /**PATH C:\Users\Hafeez Hameed\.gemini\antigravity-ide\scratch\ElectroHome.BD\resources\views\livewire/flash-sale-timer.blade.php ENDPATH**/ ?>