<?php

namespace App\Filament\Resources\Penjualans\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use App\Models\BarangModel;
use App\Models\StokModel;

class PenjualanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Penjualan')
                    ->schema([

                        Group::make()
                            ->schema([
                                Select::make('user_id')
                                    ->relationship('user', 'nama')
                                    ->searchable()
                                    ->preload()
                                    ->required(),

                                TextInput::make('pembeli')
                                    ->required(),
                            ])
                            ->columns(2),

                        Section::make('Detail Barang')
                            ->schema([

                                Repeater::make('details')
                                    ->relationship('details')
                                    ->schema([

                                        Grid::make(2)->schema([

                                            Select::make('barang_id')
                                                ->label('Barang')
                                                ->relationship('barang', 'barang_nama')
                                                ->searchable()
                                                ->preload()
                                                ->required()
                                                ->live()
                                                ->afterStateUpdated(function ($state, callable $set) {
                                                    $barang = BarangModel::find($state);

                                                    if ($barang) {
                                                        $set('harga', $barang->harga_jual);
                                                    }

                                                    $stok = StokModel::where('barang_id', $state)
                                                        ->orderBy('stok_tanggal', 'desc')
                                                        ->first();

                                                    $set('stok_available', $stok?->stok_jumlah ?? 0);
                                                })
                                                ->afterStateHydrated(function ($state, callable $set) {
                                                    if (!$state) {
                                                        return;
                                                    }

                                                    $barang = BarangModel::find($state);

                                                    if ($barang) {
                                                        $set('harga', $barang->harga_jual);
                                                    }

                                                    $stok = StokModel::where('barang_id', $state)
                                                        ->orderBy('stok_tanggal', 'desc')
                                                        ->first();

                                                    $set('stok_available', $stok?->stok_jumlah ?? 0);
                                                }),

                                            TextInput::make('stok_available')
                                                ->label('Stok')
                                                ->disabled()
                                                ->dehydrated(false),

                                            TextInput::make('jumlah')
                                                ->label('Jumlah')
                                                ->numeric()
                                                ->minValue(1)
                                                ->maxValue(fn($get) => $get('stok_available') ?? 0)
                                                ->required(),

                                            TextInput::make('harga')
                                                ->label('Harga')
                                                ->numeric()
                                                ->readOnly()
                                                ->required(),

                                        ]),
                                    ])
                                    ->columns(1),
                            ]),

                        Group::make()
                            ->schema([
                                TextInput::make('penjualan_kode')
                                    ->required(),

                                DatePicker::make('penjualan_tanggal')
                                    ->required(),
                            ])
                            ->columns(2),

                    ])
            ]);
    }
}
