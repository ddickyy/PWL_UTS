<?php

namespace App\Filament\Resources\Barangs\Pages;

use App\Filament\Resources\Barangs\BarangResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\StokModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CreateBarang extends CreateRecord
{
    protected static string $resource = BarangResource::class;
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

            // 🔥 DEBUG (hapus nanti)
            // dd($this->data);

            StokModel::create([
                'barang_id' => $this->record->barang_id,
                'supplier_id' => $this->data['supplier_id'] ?? null,
                'user_id' => Auth::user()->user_id,
                'stok_jumlah' => $this->data['stok_awal'] ?? 0,
                'stok_tanggal' => now(),
            ]);
        });
    }
}
