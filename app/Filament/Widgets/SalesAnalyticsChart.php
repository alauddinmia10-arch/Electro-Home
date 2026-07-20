<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SalesAnalyticsChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static bool $isLazy = false;
    
    protected int | string | array $columnSpan = [
        'default' => 1,
        'md' => 1,
        'lg' => 2,
        'xl' => 2,
        '2xl' => 2,
    ];
    
    protected ?string $maxHeight = '250px';
    
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
