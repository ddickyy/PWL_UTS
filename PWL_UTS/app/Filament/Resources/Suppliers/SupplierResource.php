<?php

namespace App\Filament\Resources\Suppliers;

use App\Filament\Resources\Suppliers\Pages\CreateSupplier;
use App\Filament\Resources\Suppliers\Pages\EditSupplier;
use App\Filament\Resources\Suppliers\Pages\ListSuppliers;
use App\Filament\Resources\Suppliers\Schemas\SupplierForm;
use App\Filament\Resources\Suppliers\Tables\SuppliersTable;
use App\Models\Supplier;
use App\Models\SupplierModel;
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
use App\Filament\Resources\Suppliers\Pages\ViewSupplier;

class SupplierResource extends Resource
{
    protected static ?string $model = SupplierModel::class;
    protected static ?string $navigationLabel = 'Supplier';
    protected static ?string $modelLabel = 'Supplier';
    protected static ?string $pluralModelLabel = 'Supplier';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-truck';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SupplierForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ($schema) 
            ->components([
                Section::make('Informasi Supplier')
                    ->icon('heroicon-o-truck')
                    ->schema([
                        TextEntry::make('supplier_id')
                            ->label('ID Supplier')
                            ->icon('heroicon-o-key'),
                            TextEntry::make('supplier_nama')
                            ->label('Nama Supplier')
                            ->size('lg')
                            ->weight('bold'),
                            TextEntry::make('supplier_kode')
                                ->label('Kode Supplier')
                                ->badge()
                                ->color('success'),
                            TextEntry::make('supplier_alamat')
                            ->label('Alamat Supplier'),
                     ])
                    ->columns(1),   
                Section::make('Informasi Tambahan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Diperbarui Pada')
                            ->dateTime(),
                     ])
                    ->columns(1),   
             ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return SuppliersTable::configure($table);
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
            'index' => ListSuppliers::route('/'),
            'create' => CreateSupplier::route('/create'),
            'edit' => EditSupplier::route('/{record}/edit'),
            'view' => ViewSupplier::route('/{record}'),
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
