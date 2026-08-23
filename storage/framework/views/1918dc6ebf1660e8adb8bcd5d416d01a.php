<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['category']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['category']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $name = strtolower($category->name ?? '');
    $svg = '';
    $classes = "w-6 h-6 shrink-0 transition-transform group-hover:scale-110 ";

    if (str_contains($name, 'solar panel')) {
        $classes .= "text-sky-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10l2.5-7h13l2.5 7M3 10h18M3 10l-1.5 4h21l-1.5-4m-18 0l2 10h12l2-10m-14 0l1 10m10-10l-1 10m-5-10v10m-4.5-5h9" /></svg>';
    } elseif (str_contains($name, 'inverter')) {
        $classes .= "text-emerald-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="4" y="2" width="16" height="20" rx="2" /><rect x="7" y="6" width="10" height="4" rx="1" fill="currentColor" fill-opacity="0.2"/><circle cx="12" cy="15" r="2" /><path d="M12 19v-2M9 15h1m4 0h1" stroke-linecap="round"/></svg>';
    } elseif (str_contains($name, 'combo package')) {
        $classes .= "text-purple-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="8" width="18" height="14" rx="2" /><path d="M12 8v14M3 13h18M12 8c0-2.5-2-4-4-4S4 5.5 4 8h8zm0 0c0-2.5 2-4 4-4s4 1.5 4 4h-8z" /></svg>';
    } elseif (str_contains($name, 'package') && str_contains($name, 'solar')) {
        $classes .= "text-indigo-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M2 14l2-6h8l2 6M2 14h12m-12 0l-1 3h14l-1-3m-12 0l1 5h8l1-5m-9 0l.5 5m4.5-5v5m-2.5-2.5h5" /><rect x="15" y="8" width="7" height="12" rx="1" /><path d="M16 11h5M16 14h5M18.5 8v-2" stroke-linecap="round"/></svg>';
    } elseif (str_contains($name, 'batter')) { // Matches battery and batteries
        $classes .= "text-green-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="6" width="18" height="12" rx="2" /><path d="M21 10v4M6 12h3M7.5 10.5v3M15 12h3" stroke-linecap="round" /><rect x="5" y="8" width="14" height="8" rx="1" fill="currentColor" fill-opacity="0.2" /></svg>';
    } elseif (str_contains($name, 'dc wire') || str_contains($name, 'cable')) {
        $classes .= "text-rose-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="6" width="14" height="12" rx="2" /><path d="M9 6v12M15 6v12" /><path d="M2 12h3M19 12h3" /></svg>';
    } elseif (str_contains($name, 'charger') || str_contains($name, 'adapter')) {
        $classes .= "text-sky-600";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="8" width="12" height="10" rx="2" /><path d="M9 8V5h2v3M13 8V5h2v3M12 18v3" /></svg>';
    } elseif (str_contains($name, 'tool') || str_contains($name, 'equipment')) {
        $classes .= "text-gray-600";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" /></svg>';
    } elseif (str_contains($name, 'sensor')) {
        $classes .= "text-orange-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 12m-3 0a3 3 0 1 0 6 0 3 3 0 1 0 -6 0" /><path d="M12 2v2M12 20v2M2 12h2M20 12h2M5 5l1.5 1.5M17.5 17.5L19 19M5 19l1.5-1.5M17.5 6.5L19 5" /></svg>';
    } elseif (str_contains($name, 'microcontroller') || str_contains($name, 'arduino')) {
        $classes .= "text-teal-600";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="6" y="6" width="12" height="12" rx="1" /><path d="M9 6V4M15 6V4M9 20v-2M15 20v-2M6 9H4M6 15H4M20 9h-2M20 15h-2" /></svg>';
    } elseif (str_contains($name, 'motor') || str_contains($name, 'driver')) {
        $classes .= "text-slate-600";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="6" /><path d="M12 2v4M12 18v4M2 12h4M18 12h4M5 5l2.5 2.5M16.5 16.5L19 19M5 19l2.5-2.5M16.5 7.5L19 5" /></svg>';
    } elseif (str_contains($name, 'display') || str_contains($name, 'led')) {
        $classes .= "text-cyan-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="12" rx="2" /><path d="M8 20h8M12 16v4" /></svg>';
    } elseif (str_contains($name, 'communication') || str_contains($name, 'module')) {
        $classes .= "text-indigo-400";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.55a11 11 0 0 1 14.08 0" /><path d="M1.42 9a16 16 0 0 1 21.16 0" /><path d="M8.53 16.11a6 6 0 0 1 6.95 0" /><line x1="12" y1="20" x2="12.01" y2="20" stroke-width="3" /></svg>';
    } elseif (str_contains($name, 'connector') || str_contains($name, 'cable')) {
        $classes .= "text-fuchsia-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" /><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" /></svg>';
    } elseif (str_contains($name, 'resistor') || str_contains($name, 'capacitor')) {
        $classes .= "text-lime-600";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12h4l1.5-3 3 6 3-6 3 6 1.5-3h4" /></svg>';
    } elseif (str_contains($name, 'power module')) {
        $classes .= "text-amber-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z" /></svg>';
    } elseif (str_contains($name, 'portable') && str_contains($name, 'power station')) {
        $classes .= "text-amber-600";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="4" y="8" width="16" height="12" rx="2" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 8V5a2 2 0 012-2h4a2 2 0 012 2v3" /><circle cx="9" cy="14" r="2" /><path stroke-linecap="round" stroke-linejoin="round" d="M14 13h3m-3 3h3" /></svg>';
    } elseif (str_contains($name, 'power station')) {
        $classes .= "text-yellow-600";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="9" width="18" height="12" rx="2" /><path stroke-linecap="round" stroke-linejoin="round" d="M8 9V6a2 2 0 012-2h4a2 2 0 012 2v3" /><path d="M12 11l-2 3h4l-2 3" stroke-linecap="round" stroke-linejoin="round" /></svg>';
    } elseif (str_contains($name, 'street light')) {
        $classes .= "text-teal-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22V6M12 6a4 4 0 00-4-4h4M8 6h8M9 6l-1 4h8l-1-4M10 22h4" /></svg>';
    } elseif (str_contains($name, 'charge controller')) {
        $classes .= "text-blue-500";
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="5" y="4" width="14" height="16" rx="2" /><rect x="8" y="7" width="8" height="4" rx="1" fill="currentColor" fill-opacity="0.2" /><circle cx="9" cy="15" r="1" fill="currentColor" /><circle cx="12" cy="15" r="1" fill="currentColor" /><circle cx="15" cy="15" r="1" fill="currentColor" /><path d="M8 18h2m4 0h2" stroke-linecap="round"/></svg>';
    } else {
        $classes .= "text-gray-400";
        // Fallback: A nice grid/box icon instead of a padlock!
        $svg = '<svg class="'.$classes.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>';
    }
?>

<?php echo $svg; ?>

<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\ElectroHome.BD\ElectroHome.BD\resources\views/components/category-icon.blade.php ENDPATH**/ ?>