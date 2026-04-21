<?php

namespace App\Filament\Resources\Penjualans\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\DB;
use App\Models\StokModel;

use function Laravel\Prompts\select;

class PenjualansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('penjualan_kode')
                    ->label('Kode')
                    ->searchable(),
                TextColumn::make('user.nama')
                    ->label('Nama User')
                    ->searchable(),
                TextColumn::make('pembeli')
                    ->label('Nama Pembeli')
                    ->searchable(),
                TextColumn::make('total_harga')
                    ->label('Total Bayar')
                    ->formatStateUsing(fn($state) => 'Rp' . number_format((int) $state, 0, ',', '.')),
                TextColumn::make('penjualan_tanggal')
                    ->label('Tanggal')
                    ->date(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make()
                    ->before(function ($record) {

                        DB::transaction(function () use ($record) {

                            foreach ($record->details as $detail) {

                                $stok = StokModel::where('barang_id', $detail->barang_id)
                                    ->lockForUpdate()
                                    ->orderBy('stok_tanggal', 'desc')
                                    ->first();

                                if ($stok) {
                                    $stok->stok_jumlah += $detail->jumlah;
                                    $stok->save();
                                }
                            }
                        });
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
