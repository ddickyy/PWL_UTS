<?php

namespace App\Filament\Resources\Stoks;

use App\Filament\Resources\Stoks\Pages\CreateStok;
use App\Filament\Resources\Stoks\Pages\EditStok;
use App\Filament\Resources\Stoks\Pages\ListStoks;
use App\Filament\Resources\Stoks\Schemas\StokForm;
use App\Filament\Resources\Stoks\Tables\StoksTable;
use App\Models\Stok;
use App\Models\StokModel;
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
use App\Filament\Resources\Stoks\Pages\ViewStok;

class StokResource extends Resource
{
    protected static ?string $model = StokModel::class;
    protected static ?string $navigationLabel = 'Stok';
    protected static ?string $modelLabel = 'Stok';
    protected static ?string $pluralModelLabel = 'Stok';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return StokForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StoksTable::configure($table);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ($schema) 
            ->components([
                Section::make('Informasi Stok')
                    ->icon('heroicon-o-archive-box')
                    ->schema([
                        TextEntry::make('stok_id')
                            ->label('ID Stok')
                            ->icon('heroicon-o-key'),
                        TextEntry::make('barang.barang_nama')
                            ->label('Nama Barang')
                            ->size('lg')
                            ->weight('bold'),
                        TextEntry::make('stok_jumlah')
                            ->label('Jumlah Stok')
                            ->badge()
                            ->color('success'),
                     ])
                    ->columns(1),   
                Section::make('Informasi Tambahan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada'),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada'),
                     ])
                    ->columns(1),   
             ])->columns(2);
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
            'index' => ListStoks::route('/'),
            'create' => CreateStok::route('/create'),
            'edit' => EditStok::route('/{record}/edit'),
            'view' => ViewStok::route('/{record}'),
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
