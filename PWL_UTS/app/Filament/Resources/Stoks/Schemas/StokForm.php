<?php

namespace App\Filament\Resources\Stoks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Group;

class StokForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Stok')
                    ->icon('heroicon-o-rectangle-stack')
                    ->description('Masukkan data stok')
                    ->schema([
                        Group::make()
                            ->schema([
                                Select::make('supplier_id')
                                    ->label('Supplier')
                                    ->relationship('supplier', 'supplier_nama')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                Select::make('barang_id')
                                    ->label('Barang')
                                    ->relationship('barang', 'barang_nama')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                Select::make('user_id')
                                    ->label('User')
                                    ->relationship('user', 'nama')
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                            ])
                            ->columns(3),
                        Group::make()
                            ->schema([
                                TextInput::make('stok_tanggal')
                                    ->label('Tanggal')
                                    ->required()
                                    ->type('date'),
                                TextInput::make('stok_jumlah')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->required(),
                            ])->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
