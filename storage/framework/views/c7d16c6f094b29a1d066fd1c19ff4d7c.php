<?php

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

?>

<button wire:click.prevent="toggleWishlist" class="absolute top-2 right-2 w-8 h-8 bg-white/80 backdrop-blur rounded-full flex items-center justify-center text-gray-400 hover:text-soft-coral hover:bg-white shadow-sm transition-all z-20 group" title="Add to Wishlist">
    <svg class="w-4 h-4 <?php echo e($inWishlist ? 'text-soft-coral fill-current' : 'group-hover:fill-current'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
    </svg>
</button><?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\ElectroHome.BD\ElectroHome.BD\resources\views\livewire/wishlist-button.blade.php ENDPATH**/ ?>