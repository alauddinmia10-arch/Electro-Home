<a href="{{ route('home') }}" class="flex items-center gap-2.5 shrink-0 group" aria-label="ElectroHome">
    {{-- Icon --}}
    <svg class="h-9 md:h-11 w-auto transition-transform group-hover:scale-105" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M 29 60 L 29 45 L 49 25 L 90 25" stroke="#16A34A" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"/>
        <path d="M 90 95 L 45 95 A 16 16 0 0 1 29 79 L 29 60 L 80 60" stroke="{{ $theme === 'dark' ? '#FFFFFF' : '#0F172A' }}" stroke-width="16" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    
    {{-- Text --}}
    <div class="hidden sm:flex flex-col justify-center">
        <span class="text-2xl md:text-3xl font-extrabold leading-none tracking-tight font-['Montserrat',_'Inter',_sans-serif] {{ $theme === 'dark' ? 'text-white' : 'text-[#0F172A]' }}">
            Electro<span class="text-[#16A34A]">Home</span>
        </span>
        <span class="text-[9px] md:text-[10px] font-bold tracking-[0.32em] uppercase mt-1 font-['Montserrat',_'Inter',_sans-serif] {{ $theme === 'dark' ? 'text-gray-400' : 'text-[#64748B]' }}">
            Premium Electronics
        </span>
    </div>
</a>
