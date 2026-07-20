<?php

namespace App\Filament\Resources\Categories\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ChildrenRelationManager extends RelationManager
{
    protected static string $relationship = 'children';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                
                \Filament\Forms\Components\Repeater::make('children')
                    ->label('Third Level Categories')
                    ->hiddenLabel()
                    ->relationship('children')
                    ->addActionLabel('New Third Category')
                    ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                    ->defaultItems(0)
                    ->collapsible()
                    ->collapsed()
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, $set) => $set('slug', \Illuminate\Support\Str::slug($state)))
                            ->columnSpan('full'),
                        \Filament\Forms\Components\Hidden::make('slug')
                            ->required()
                            ->unique('categories', 'slug', ignoreRecord: true),
                        TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0)
                            ->columnSpan(1),
                        Toggle::make('status')
                            ->default(true)
                            ->required()
                            ->columnSpan(1),
                    ])
                    ->columns(2),
                    
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
                    
                Toggle::make('status')
                    ->default(true)
                    ->required(),
                    
                \Filament\Forms\Components\Hidden::make('slug')
                    ->required()
                    ->unique('categories', 'slug', ignoreRecord: true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('icon')
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('status')
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
            ->headerActions([
                CreateAction::make()
                    ->label('New Sub Category'),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
