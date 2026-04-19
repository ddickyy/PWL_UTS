<?php

namespace App\Filament\Resources\Kategoris\Schemas;

use Dom\Text;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KategoriForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Kategori')
                    ->icon('heroicon-o-rectangle-stack')
                    ->description('Masukkan data kategori')
                    ->schema([
                        TextInput::make('kategori_kode')
                            ->label('Kode')
                            ->prefixIcon('heroicon-o-key')
                            ->required(),
                        TextInput::make('kategori_nama')
                            ->label('Nama Kategori')
                            ->prefixIcon('heroicon-o-rectangle-stack')
                            ->required(),
                    ])
                    ->columnSpanFUll(),
            ]);
    }
}
