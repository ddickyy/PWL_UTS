<?php

namespace App\Filament\Resources\Penjualans;

use App\Filament\Resources\Penjualans\Pages\CreatePenjualan;
use App\Filament\Resources\Penjualans\Pages\EditPenjualan;
use App\Filament\Resources\Penjualans\Pages\ListPenjualans;
use App\Filament\Resources\Penjualans\Schemas\PenjualanForm;
use App\Filament\Resources\Penjualans\Tables\PenjualansTable;
use App\Models\Penjualan;
use App\Models\PenjualanModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use App\Filament\Resources\Penjualans\Pages\ViewPenjualan;
use Filament\Infolists\Components\RepeatableEntry;

class PenjualanResource extends Resource
{
    protected static ?string $model = PenjualanModel::class;
    protected static ?string $navigationLabel = 'Penjualan';
    protected static ?string $modelLabel = 'Penjualan';
    protected static ?string $pluralModelLabel = 'Penjualan';
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $recordTitleAttribute = 'name';

    public static function infolist(Schema $schema): Schema
    {
        return ($schema)
            ->components([
                Section::make('Informasi Penjualan')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        TextEntry::make('penjualan_id')
                            ->label('ID Penjualan')
                            ->icon('heroicon-o-key'),

                        TextEntry::make('penjualan_kode')
                            ->label('Kode Penjualan'),


                        TextEntry::make('pembeli')
                            ->label('Nama Pembeli')
                            ->size('lg')
                            ->weight('bold'),

                        TextEntry::make('total_harga')
                            ->label('Total Pembayaran')
                            ->formatStateUsing(fn($state) => 'Rp ' . number_format((int) $state, 0, ',', '.')),
                    ])
                    ->columns(1),
                Section::make('Detail Barang')
                    ->icon('heroicon-o-rectangle-stack')
                    ->schema([
                        RepeatableEntry::make('details')
                            ->schema([
                                TextEntry::make('barang.barang_nama')
                                    ->label('Barang'),

                                TextEntry::make('jumlah')
                                    ->label('Jumlah'),

                                TextEntry::make('harga')
                                    ->label('Harga')
                                    ->formatStateUsing(fn($state) => 'Rp ' . number_format((int) $state, 0, ',', '.')),
                            ])
                            ->columns(3),
                    ]),
                Section::make('Informasi Tambahan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->icon('heroicon-o-calendar')
                            ->placeholder('-'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')
                            ->icon('heroicon-o-rectangle-stack')
                            ->placeholder('-'),
                        TextEntry::make('deleted_at')
                            ->label('Dihapus Pada')
                            ->icon('heroicon-o-trash')
                            ->placeholder('-'),
                    ])
                    ->columns(1),
            ])->columns(3);
    }

    public static function form(Schema $schema): Schema
    {
        return PenjualanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenjualansTable::configure($table);
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
            'index' => ListPenjualans::route('/'),
            'create' => CreatePenjualan::route('/create'),
            'edit' => EditPenjualan::route('/{record}/edit'),
            'view' => ViewPenjualan::route('/{record}'),
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
