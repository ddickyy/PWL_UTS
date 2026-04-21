<?php

namespace App\Filament\Resources\Penjualans\Pages;

use App\Filament\Resources\Penjualans\PenjualanResource;
use Filament\Resources\Pages\EditRecord;
use App\Models\StokModel;
use Illuminate\Support\Facades\DB;
use Filament\Notifications\Notification;

class EditPenjualan extends EditRecord
{
    protected static string $resource = PenjualanResource::class;

    protected array $oldDetails = [];

    protected function beforeSave(): void
    {
        $this->oldDetails = $this->record
            ->details()
            ->get()
            ->keyBy('id')
            ->toArray();
    }

    protected function afterSave(): void
    {
        DB::transaction(function () {

            foreach ($this->record->details as $detail) {

                $oldQty = $this->oldDetails[$detail->id]['jumlah'] ?? 0;
                $newQty = $detail->jumlah;

                $selisih = $newQty - $oldQty;

                if ($selisih == 0) continue;

                $stok = StokModel::where('barang_id', $detail->barang_id)
                    ->lockForUpdate()
                    ->orderBy('stok_tanggal', 'desc')
                    ->first();

                if (!$stok) {
                    Notification::make()
                        ->title('Stok tidak ditemukan')
                        ->danger()
                        ->send();
                    return;
                }

                // 🔥 TAMBAH JUMLAH → KURANGI STOK
                if ($selisih > 0) {

                    if ($stok->stok_jumlah < $selisih) {
                        Notification::make()
                            ->title('Stok tidak mencukupi')
                            ->danger()
                            ->send();
                        return;
                    }

                    $stok->stok_jumlah -= $selisih;
                }

                // 🔥 KURANG JUMLAH → BALIKKAN STOK
                if ($selisih < 0) {
                    $stok->stok_jumlah += abs($selisih);
                }

                $stok->save();
            }

        });
    }
}