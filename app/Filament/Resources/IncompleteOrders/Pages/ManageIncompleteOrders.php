<?php

namespace App\Filament\Resources\IncompleteOrders\Pages;

use App\Filament\Resources\IncompleteOrders\IncompleteOrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageIncompleteOrders extends ManageRecords
{
    public function mount(): void
    {
        parent::mount();
        if (auth()->check()) {
            auth()->user()->unreadNotifications()->where('data', 'like', '%"title":"New Incomplete Order"%')->update(['read_at' => now()]);
        }
    }

    protected static string $resource = IncompleteOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
