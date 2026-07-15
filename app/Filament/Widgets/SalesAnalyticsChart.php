<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SalesAnalyticsChart extends ChartWidget
{
    protected int | string | array $columnSpan = 'full';
    
    protected ?string $heading = 'Sales Analytics';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Sales Chart (Dummy Data)',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
