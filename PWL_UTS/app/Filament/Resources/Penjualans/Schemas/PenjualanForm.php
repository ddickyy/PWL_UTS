<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Penjualan')
                    ->icon('heroicon-o-shopping-cart')
                    ->description('Masukkan data penjualan')
                    ->schema([
                        Group::make()
                            ->schema([

                                Select::make('user_id')
                                    ->label('User')
                                    ->relationship('user', 'nama')
                                    ->preload()
                                    ->prefixIcon('heroicon-o-user')
                                    ->searchable()
                                    ->required(),
                                TextInput::make('pembeli')
                                    ->label('Pembeli')
                                    ->prefixIcon('heroicon-o-user')
                                    ->required(),
                            ])->columns(2),
                        Group::make()
                            ->schema([
                                TextInput::make('penjualan_kode')
                                    ->label('Kode Penjualan')
                                    ->prefixIcon('heroicon-o-key')
                                    ->required(),
                                TextInput::make('penjualan_tanggal')
                                    ->label('Tanggal Penjualan')
                                    ->prefixIcon('heroicon-o-calendar')
                                    ->type('date')
                                    ->required(),
                            ])->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
