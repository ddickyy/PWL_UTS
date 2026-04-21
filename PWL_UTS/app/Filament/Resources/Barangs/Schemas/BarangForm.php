<?php

namespace App\Filament\Resources\Barangs\Schemas;

use App\Models\SupplierModel;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;

class BarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                section::make('Informasi Barang')
                    ->icon('heroicon-o-archive-box')
                    ->description('Masukkan data barang')
                    ->schema([

                        Group::make()
                            ->schema([

                                TextInput::make('barang_kode')
                                    ->label('Kode Barang')
                                    ->prefixIcon('heroicon-o-key')
                                    ->required(),

                                TextInput::make('barang_nama')
                                    ->label('Nama Barang')
                                    ->prefixIcon('heroicon-o-archive-box')
                                    ->required(),

                                Select::make('supplier_id')
                                    ->label('Supplier')
                                    ->options(SupplierModel::pluck('supplier_nama', 'supplier_id'))
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->dehydrated(false),

                                TextInput::make('stok_awal')
                                    ->label('Stok Awal')
                                    ->numeric()
                                    ->minValue(0)
                                    ->dehydrated(false)
                                    ->required(),

                                TextInput::make('harga_beli')
                                    ->label('Harga Beli')
                                    ->prefix('Rp')
                                    ->numeric()
                                    ->required(),

                                TextInput::make('harga_jual')
                                    ->label('Harga Jual')
                                    ->prefix('Rp')
                                    ->numeric()
                                    ->required(),

                                Select::make('kategori_id')
                                    ->label('Kategori')
                                    ->relationship('kategori', 'kategori_nama')
                                    ->preload()
                                    ->searchable()
                                    ->required(),

                            ])
                            ->columns(2),

                    ])
                    ->columnSpanFUll(),
            ]);
    }
}
