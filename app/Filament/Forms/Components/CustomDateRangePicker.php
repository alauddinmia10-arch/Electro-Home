<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class CustomDateRangePicker extends Field
{
    protected string $view = 'filament.forms.components.custom-date-range-picker';
    
    protected bool $isBorderless = false;

    public function borderless(bool $condition = true): static
    {
        $this->isBorderless = $condition;
        return $this;
    }

    public function isBorderless(): bool
    {
        return $this->isBorderless;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->default([
            'startDate' => now()->subDays(27)->format('Y-m-d'),
            'endDate' => now()->format('Y-m-d'),
            'label' => 'Last 28 days',
        ]);
    }
}
