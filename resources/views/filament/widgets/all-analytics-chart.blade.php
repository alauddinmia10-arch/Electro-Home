@php
    use Filament\Widgets\View\Components\ChartWidgetComponent;
    use Illuminate\View\ComponentAttributeBag;

    $color = $this->getColor();
    $heading = $this->getHeading();
    $description = $this->getDescription();
    $filters = $this->getFilters();
    $isCollapsible = $this->isCollapsible();
    $type = $this->getType();
    $maxHeight = $this->getMaxHeight();
    $hasMaxHeight = filled($maxHeight) && $maxHeight !== '100%';
@endphp

<style>
    /* MOBILE SPECIFIC STYLES FOR ANALYTICS WIDGET HEADER */
    @media (max-width: 1023px) {
        .custom-analytics-chart .fi-section-header {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 1rem !important;
        }
        .custom-analytics-chart .fi-section-header-heading {
            width: 100% !important;
            white-space: nowrap !important;
            overflow: hidden !important;
            text-overflow: ellipsis !important;
            font-size: 0.95rem !important;
        }
        .custom-analytics-chart .fi-section-header-after-ctn {
            width: 100% !important;
            margin-inline: 0 !important;
        }
        .custom-analytics-chart .mobile-date-picker-ctn {
            position: relative !important;
            inset: auto !important;
            width: 100% !important;
            margin-top: 0 !important;
        }
    }
</style>

<x-filament-widgets::widget class="fi-wi-chart relative custom-analytics-chart">
    <x-filament::section
        :description="$description"
        :heading="$heading"
        :collapsible="$isCollapsible"
    >
        @if ($filters === null || method_exists($this, 'getFiltersSchema'))
            <x-slot name="afterHeader">
                @if ($filters === null)
                    <div class="absolute right-6 top-4 z-10 w-[350px] mobile-date-picker-ctn">
                        {{ $this->form }}
                    </div>
                @endif
                
                @if ($filters !== null)
                    <x-filament::input.wrapper
                        inline-prefix
                        wire:target="filter"
                        class="fi-wi-chart-filter"
                    >
                        <x-filament::input.select
                            inline-prefix
                            wire:model.live="filter"
                        >
                            @foreach ($filters as $value => $label)
                                <option value="{{ $value }}">
                                    {{ $label }}
                                </option>
                            @endforeach
                        </x-filament::input.select>
                    </x-filament::input.wrapper>
                @endif

                @if (method_exists($this, 'getFiltersSchema'))
                    <x-filament::dropdown
                        placement="bottom-end"
                        shift
                        width="xs"
                        class="fi-wi-chart-filter"
                    >
                        <x-slot name="trigger">
                            {{ $this->getFiltersTriggerAction() }}
                        </x-slot>

                        <div class="fi-wi-chart-filter-content">
                            {{ $this->getFiltersSchema() }}

                            @if (method_exists($this, 'hasDeferredFilters') && $this->hasDeferredFilters())
                                <div class="fi-wi-chart-filter-content-actions-ctn">
                                    {{ $this->getFiltersApplyAction() }}
                                    {{ $this->getFiltersResetAction() }}
                                </div>
                            @endif
                        </div>
                    </x-filament::dropdown>
                @endif
            </x-slot>
        @endif

        <div
            @if ($pollingInterval = $this->getPollingInterval())
                wire:poll.{{ $pollingInterval }}="updateChartData"
            @endif
        >
            <div
                x-load
                x-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('chart', 'filament/widgets') }}"
                wire:ignore
                data-chart-type="{{ $type }}"
                x-data="chart({
                            cachedData: @js($this->getCachedData()),
                            options: @js($this->getOptions()),
                            type: @js($type),
                        })"
                {{
                    (new ComponentAttributeBag)
                        ->color(ChartWidgetComponent::class, $color)
                        ->class([
                            'fi-wi-chart-canvas-ctn',
                            'fi-wi-chart-canvas-ctn-no-aspect-ratio' => $hasMaxHeight,
                        ])
                }}
                @if ($hasMaxHeight)
                    style="height: {{ $maxHeight }}; max-height: {{ $maxHeight }}; aspect-ratio: auto !important; padding-bottom: 0 !important;"
                @endif
            >
                <canvas
                    x-ref="canvas"
                    @style([
                        'width: 100%',
                        'height: 100%; max-height: 100%' => ! $hasMaxHeight,
                        ('max-height: ' . e($maxHeight)) => $hasMaxHeight,
                    ])
                ></canvas>

                <span x-ref="backgroundColorElement" class="fi-wi-chart-bg-color"></span>
                <span x-ref="borderColorElement" class="fi-wi-chart-border-color"></span>
                <span x-ref="gridColorElement" class="fi-wi-chart-grid-color"></span>
                <span x-ref="textColorElement" class="fi-wi-chart-text-color"></span>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
