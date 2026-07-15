<?php

namespace App\Filament\Resources\WholesaleRequests\Pages;

use App\Filament\Resources\WholesaleRequests\WholesaleRequestResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewWholesaleRequest extends ViewRecord
{
    protected static string $resource = WholesaleRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
