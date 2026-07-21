<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Grid;

class SalesAnalytics extends Page implements HasForms
{
    use InteractsWithForms;

    public static function getNavigationIcon(): string|null
    {
        return 'heroicon-o-chart-bar';
    }

    protected static string|\UnitEnum|null $navigationGroup = 'MANAGEMENT';
    protected static ?int $navigationSort = 1;

    protected string $view = 'filament.pages.sales-analytics';

    public string $activeTab = 'all';
    public ?array $filters = [
        'breakdown' => 'organic',
    ];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->components([
                Grid::make(5)
                    ->schema([
                        \App\Filament\Forms\Components\FacebookDateRangePicker::make('date_range')
                            ->columnSpan(3)
                            ->hiddenLabel()
                            ->live(),
                        \Filament\Forms\Components\Select::make('breakdown')
                            ->columnSpan(2)
                            ->hiddenLabel() // Hides the label text above the input
                            ->options([
                                'organic' => 'Breakdown: Organic',
                                'ads' => 'Breakdown: Ads',
                            ])
                            ->default('organic')
                            ->live(),
                    ])
            ])
            ->statePath('filters');
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('filters')
                ->view('filament.pages.header-filters'),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [
            static::getUrl() => 'Sales Analytics',
            '' => 'List',
        ];
    }
}
