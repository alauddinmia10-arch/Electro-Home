<?php

namespace App\Filament\Resources\WholesaleRequests\Pages;

use App\Filament\Resources\WholesaleRequests\WholesaleRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWholesaleRequests extends ListRecords
{
    public function mount(): void
    {
        parent::mount();
        if (auth()->check()) {
            auth()->user()->unreadNotifications()->where('data', 'like', '%"title":"New Wholesale Request"%')->update(['read_at' => now()]);
        }
    }

    protected static string $resource = WholesaleRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
