<a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0 group" aria-label="ElectroHome">
    @if(isset($theme) && $theme === 'dark')
        {{-- For dark background (e.g. Footer), use white text logo --}}
        <img src="{{ asset('images/logo-white-text.webp') }}" 
             alt="ElectroHome Logo" 
             class="h-9 md:h-12 w-auto object-contain transition-transform group-hover:scale-105"
             width="220" 
             height="48">
    @else
        {{-- For light background (e.g. Header), use the newly uploaded custom logo --}}
        <img src="{{ asset('images/logo-header.webp') }}" 
             alt="ElectroHome Logo" 
             class="h-9 md:h-12 w-auto object-contain transition-transform group-hover:scale-105"
             width="220" 
             height="48">
    @endif
</a>
