<a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0 group" aria-label="ElectroHome">
    @if(isset($theme) && $theme === 'dark')
        <img src="{{ asset('images/logo-dark.webp') }}" 
             alt="ElectroHome Logo" 
             class="h-9 md:h-12 w-auto object-contain transition-transform group-hover:scale-105"
             width="220" 
             height="48">
    @else
        <img src="{{ asset('images/logo.webp') }}" 
             alt="ElectroHome Logo" 
             class="h-9 md:h-12 w-auto object-contain transition-transform group-hover:scale-105"
             width="220" 
             height="48">
    @endif
</a>
