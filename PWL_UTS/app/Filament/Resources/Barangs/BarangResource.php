<?php

namespace App\Filament\Resources\Barangs;

use App\Filament\Resources\Barangs\Pages\CreateBarang;
use App\Filament\Resources\Barangs\Pages\EditBarang;
use App\Filament\Resources\Barangs\Pages\ListBarangs;
use App\Filament\Resources\Barangs\Schemas\BarangForm;
use App\Filament\Resources\Barangs\Tables\BarangsTable;
use App\Filament\Resources\Barangs\Pages\ViewBarang;
use App\Models\Barang;
use App\Models\BarangModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;

class BarangResource extends Resource
{
    protected static ?string $model = BarangModel::class;
    protected static ?string $navigationLabel = 'Barang';
    protected static ?string $modelLabel = 'Barang';
    protected static ?string $pluralModelLabel = 'Barang';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $recordTitleAttribute = 'name';
    public static function infolist($schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        TextEntry::make('barang_nama')
                            ->label('Nama Barang')
                            ->size('lg')
                            ->weight('bold'),

                        TextEntry::make('kategori.kategori_nama')
                            ->label('Kategori')
                            ->badge()
                            ->color('success'),
                    ])
                    ->columns(2),

                Section::make('Detail Barang')
                    ->icon('heroicon-o-archive-box')
                    ->schema([
                        TextEntry::make('barang_kode')
                            ->label('Kode')
                            ->icon('heroicon-o-key'),

                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime('d M Y')
                            ->icon('heroicon-o-calendar')
                            ->placeholder('-'),
                    ])
                    ->columns(2),

                Section::make('Informasi Harga')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        TextEntry::make('harga_beli')
                            ->label('Harga Beli')
                            ->money('IDR')
                            ->color('gray'),

                        TextEntry::make('harga_jual')
                            ->label('Harga Jual')
                            ->money('IDR')
                            ->color('success')
                            ->weight('bold'),
                    ])
                    ->columns(2),
            ])->columns(3);
    }
    public static function form(Schema $schema): Schema
    {
        return BarangForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BarangsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBarangs::route('/'),
            'create' => CreateBarang::route('/create'),
            'edit' => EditBarang::route('/{record}/edit'),
            'view' => ViewBarang::route('/{record}'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
