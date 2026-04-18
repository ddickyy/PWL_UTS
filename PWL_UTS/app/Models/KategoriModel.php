<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $table = 'm_kategori';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'kategori_kode',
        'kategori_nama',
    ];

    // Relasi: satu kategori punya banyak barang
    public function barangs()
    {
        return $this->hasMany(BarangModel::class, 'kategori_id', 'kategori_id');
    }
}