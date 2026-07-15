<?php

namespace App\Filament\Resources\WholesaleRequests\Pages;

use App\Filament\Resources\WholesaleRequests\WholesaleRequestResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWholesaleRequests extends ListRecords
{
    protected static string $resource = WholesaleRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
