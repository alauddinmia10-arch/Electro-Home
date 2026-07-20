<?php

namespace App\Filament\Resources\Admins\Schemas;

use Filament\Schemas\Schema;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Hash;

class AdminForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar')
                    ->label('Profile Picture')
                    ->image()
                    ->avatar()
                    ->directory('avatars')
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255),
                \Filament\Forms\Components\Select::make('role')
                    ->label('Admin Role (Designation)')
                    ->options([
                        'super_admin' => 'Administrator',
                        'admin' => 'Admin',
                        'manager' => 'Manager',
                    ])
                    ->required()
                    ->default('admin'),
            ]);
    }
}
