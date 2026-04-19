<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Filament\Forms\Components\Repeater;
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
                    ->columnSpanFull()
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
                            ])
                            ->columns(2),

                        Section::make('Detail Barang')
                            ->schema([
                                Repeater::make('details')
                                    ->relationship('details')
                                    ->schema([
                                        Select::make('barang_id')
                                            ->label('Barang')
                                            ->relationship('barang', 'barang_nama')
                                            ->searchable()
                                            ->preload()
                                            ->required()
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                $barang = \App\Models\BarangModel::find($state);
                                                if ($barang) {
                                                    $set('harga', $barang->harga_jual);
                                                }
                                            }),

                                        TextInput::make('jumlah')
                                            ->label('Jumlah')
                                            ->numeric()
                                            ->required(),

                                        TextInput::make('harga')
                                            ->label('Harga')
                                            ->prefix('Rp')
                                            ->numeric()
                                            ->readOnly()
                                            ->required(),
                                    ])
                                    ->columns(3)
                                    ->addActionLabel('Tambah Barang'),
                            ]),

                        Group::make()
                            ->schema([
                                TextInput::make('penjualan_kode')
                                    ->label('Kode Penjualan')
                                    ->prefixIcon('heroicon-o-key')
                                    ->required(),

                                TextInput::make('penjualan_tanggal')
                                    ->label('Tanggal Penjualan')
                                    ->type('date')
                                    ->prefixIcon('heroicon-o-calendar')
                                    ->required(),
                            ])->columns(2),
                    ])
            ]);
    }
}
