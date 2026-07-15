<?php

namespace App\Filament\Resources\WholesaleRequests\Pages;

use App\Filament\Resources\WholesaleRequests\WholesaleRequestResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditWholesaleRequest extends EditRecord
{
    protected static string $resource = WholesaleRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
