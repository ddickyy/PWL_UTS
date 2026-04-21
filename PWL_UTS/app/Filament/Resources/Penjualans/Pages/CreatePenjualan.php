<?php

namespace App\Filament\Resources\Penjualans\Pages;

use App\Filament\Resources\Penjualans\PenjualanResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\StokModel;
use Illuminate\Support\Facades\DB;

class CreatePenjualan extends CreateRecord
{
    protected static string $resource = PenjualanResource::class;
    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function afterCreate(): void
    {
        DB::transaction(function () {

            foreach ($this->record->details as $detail) {

                $stok = StokModel::where('barang_id', $detail->barang_id)
                    ->lockForUpdate()
                    ->orderBy('stok_tanggal', 'desc')
                    ->first();

                if (!$stok) {
                    throw new \Exception('Stok tidak ditemukan');
                }

                if ($stok->stok_jumlah < $detail->jumlah) {
                    throw new \Exception('Stok tidak mencukupi');
                }

                $stok->stok_jumlah -= $detail->jumlah;
                $stok->save();
            }
        });
    }
}
