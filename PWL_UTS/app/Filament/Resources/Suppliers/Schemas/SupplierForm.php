<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Supplier')
                    ->icon('heroicon-o-truck')
                    ->description('Masukkan data supplier')
                    ->schema([
                        TextInput::make('supplier_kode')
                            ->label('Kode Supplier')
                            ->prefixIcon('heroicon-o-key')
                            ->required(),
                        TextInput::make('supplier_nama')
                            ->label('Nama Supplier')
                            ->prefixIcon('heroicon-o-truck')
                            ->required(),
                        TextInput::make('supplier_alamat')
                            ->label('Alamat Supplier')
                            ->prefixIcon('heroicon-o-map-pin')
                            ->required(),
                    ])->columns(3)
                    ->columnSpanFull(),
            ]);
    }
}
