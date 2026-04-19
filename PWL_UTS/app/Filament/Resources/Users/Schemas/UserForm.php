<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi User')
                    ->icon('heroicon-o-rectangle-stack')
                    ->description('Masukkan data user')
                    ->schema([
                        Select::make('level_id')
                            ->label('Level')
                            ->relationship('level', 'level_nama')
                            ->prefixIcon('heroicon-o-shield-check')
                            ->preload()
                            ->searchable()
                            ->required(),
                        TextInput::make('username')
                            ->label('Username')
                            ->prefixIcon('heroicon-o-user')
                            ->required(),
                        TextInput::make('nama')
                            ->label('Nama')
                            ->prefixIcon('heroicon-o-user')
                            ->required(),

                        TextInput::make('email')
                            ->label('Email')
                            ->prefixIcon('heroicon-o-envelope')
                            ->email()
                            ->required(),

                        TextInput::make('password')
                            ->label('Password')
                            ->prefixIcon('heroicon-o-lock-closed')
                            ->password()
                            ->required(),
                    ])->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
