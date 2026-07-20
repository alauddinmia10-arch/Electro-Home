<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (\Illuminate\Database\Eloquent\Builder $query) => $query->whereNull('parent_id'))
            ->columns([
                ImageColumn::make('image'),
                ImageColumn::make('icon'),
                TextColumn::make('name')
                    ->searchable(),
                IconColumn::make('status')
                    ->label('Is active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\Action::make('top')
                    ->label('Top')
                    ->icon('heroicon-o-arrow-up')
                    ->action(function (\App\Models\Category $record) {
                        $minSort = \App\Models\Category::whereNull('parent_id')->min('sort_order');
                        $record->update(['sort_order' => $minSort ? $minSort - 1 : 0]);
                    }),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
