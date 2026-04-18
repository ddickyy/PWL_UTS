<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    protected $table = 'm_barang';
    protected $primaryKey = 'barang_id';

    protected $fillable = [
        'kategori_id',
        'barang_kode',
        'barang_nama',
        'harga_beli',
        'harga_jual',
    ];

    // Relasi: barang milik satu kategori
    public function kategori()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }

    // Relasi: satu barang ada di banyak stok
    public function stoks()
    {
        return $this->hasMany(StokModel::class, 'barang_id', 'barang_id');
    }

    // Relasi: satu barang ada di banyak detail penjualan
    public function penjualanDetails()
    {
        return $this->hasMany(PenjualanDetailModel::class, 'barang_id', 'barang_id');
    }
}