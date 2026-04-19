<?php

namespace App\Filament\Resources\Levels\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;

class LevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Level')
                    ->icon('heroicon-o-shield-check')
                    ->description('Masukkan data level user')
                    ->schema([

                        Group::make()
                            ->schema([

                                TextInput::make('level_kode')
                                    ->label('Kode Level')
                                    ->prefixIcon('heroicon-o-key')
                                    ->required(),

                                TextInput::make('level_nama')
                                    ->label('Nama Level')
                                    ->prefixIcon('heroicon-o-user')
                                    ->required(),

                            ])
                            ->columns(2),

                    ])->columnSpanFUll(),
            ]);
    }
}
