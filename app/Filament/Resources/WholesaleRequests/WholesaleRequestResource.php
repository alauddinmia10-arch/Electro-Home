<?php

namespace App\Filament\Resources\WholesaleRequests;

use App\Filament\Resources\WholesaleRequests\Pages\CreateWholesaleRequest;
use App\Filament\Resources\WholesaleRequests\Pages\EditWholesaleRequest;
use App\Filament\Resources\WholesaleRequests\Pages\ListWholesaleRequests;
use App\Filament\Resources\WholesaleRequests\Pages\ViewWholesaleRequest;
use App\Filament\Resources\WholesaleRequests\Schemas\WholesaleRequestForm;
use App\Filament\Resources\WholesaleRequests\Schemas\WholesaleRequestInfolist;
use App\Filament\Resources\WholesaleRequests\Tables\WholesaleRequestsTable;
use App\Models\WholesaleRequest;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class WholesaleRequestResource extends Resource
{
    protected static ?string $model = WholesaleRequest::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string | \UnitEnum | null $navigationGroup = 'MANAGEMENT';
    protected static ?int $navigationSort = 7;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return WholesaleRequestForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return WholesaleRequestInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WholesaleRequestsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWholesaleRequests::route('/'),
            'create' => CreateWholesaleRequest::route('/create'),
            'view' => ViewWholesaleRequest::route('/{record}'),
            'edit' => EditWholesaleRequest::route('/{record}/edit'),
        ];
    }
}
