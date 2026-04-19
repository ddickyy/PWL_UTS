<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\PenjualanModel;
use App\Models\SupplierModel;
use App\Models\UserModel;

class StatsDashboard extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make('Total Barang', BarangModel::count())
                ->description('Jumlah semua barang')
                ->color('primary'),

            Stat::make('Total Kategori', KategoriModel::count())
                ->description('Jumlah kategori')
                ->color('info'),

            Stat::make('Total User', UserModel::count())
                ->description('Pengguna sistem')
                ->color('warning'),

            Stat::make('Total Penjualan', PenjualanModel::count())
                ->description('Transaksi penjualan')
                ->color('success'),
            Stat::make('Total Supplier', SupplierModel::count())
                ->description('Jumlah Supplier saat ini') 
                ->color('info'),

            Stat::make(
                'Total Pendapatan',
                'Rp' . number_format(
                    PenjualanModel::with('details')->get()
                        ->sum(fn($p) => $p->details->sum(fn($d) => $d->harga * $d->jumlah)),
                    0,
                    ',',
                    '.'
                )
            )
                ->description('Total seluruh penjualan')
                ->color('success'),
        ];
    }
}
