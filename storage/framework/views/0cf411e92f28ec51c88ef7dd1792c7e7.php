<?php

use App\Services\CartService;
use Livewire\Volt\Component;
use App\Models\Product;

?>

<div x-data="{ adding: false }">
    <button type="button" @click="$dispatch('cart-updated-optimistic', { amount: <?php echo e($price); ?>, qty_change: 1 }); $wire.addToCart(); adding = true; setTimeout(() => adding = false, 800)" x-bind:disabled="adding" x-bind:class="adding ? 'bg-[#00a651] hover:bg-[#00a651]' : 'bg-[#0b5c9a] hover:bg-[#094d82]'" class="w-full flex items-center justify-center <?php echo e($buttonClass); ?> text-white font-semibold leading-none py-2 rounded transition-colors whitespace-nowrap <?php echo e($outOfStock ? 'opacity-50 cursor-not-allowed bg-gray-400 hover:bg-gray-400' : ''); ?>" <?php echo e($outOfStock ? 'disabled' : ''); ?>>
        <svg x-show="!adding" class="<?php echo e($svgClass); ?> shrink-0" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 7C12 7.55 11.55 8 11 8C10.45 8 10 7.55 10 7V5H8C7.45 5 7 4.55 7 4C7 3.45 7.45 3 8 3H10V1C10 0.45 10.45 0 11 0C11.55 0 12 0.45 12 1V3H14C14.55 3 15 3.45 15 4C15 4.55 14.55 5 14 5H12V7ZM4.01 19C4.01 17.9 4.9 17 6 17C7.1 17 8 17.9 8 19C8 20.1 7.1 21 6 21C4.9 21 4.01 20.1 4.01 19ZM16 17C14.9 17 14.01 17.9 14.01 19C14.01 20.1 14.9 21 16 21C17.1 21 18 20.1 18 19C18 17.9 17.1 17 16 17ZM14.55 12H7.1L6 14H17C17.55 14 18 14.45 18 15C18 15.55 17.55 16 17 16H6C4.48 16 3.52 14.37 4.25 13.03L5.6 10.59L2 3H1C0.45 3 0 2.55 0 2C0 1.45 0.45 1 1 1H2.64C3.02 1 3.38 1.22 3.54 1.57L7.53 10H14.55L17.94 3.87C18.2 3.39 18.81 3.22 19.29 3.48C19.77 3.75 19.95 4.36 19.68 4.84L16.3 10.97C15.96 11.59 15.3 12 14.55 12Z" fill="currentColor"/></svg>
        <svg x-show="adding" style="display: none;" class="<?php echo e($svgClass); ?> shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
        <span x-show="!adding" class="truncate">Add to Order</span>
        <span x-show="adding" style="display: none;" class="truncate">Added!</span>
    </button>
</div><?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views\livewire/product-card-add-to-cart.blade.php ENDPATH**/ ?>