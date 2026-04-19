<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StokModel extends Model
{
    protected $table = 't_stok';
    protected $primaryKey = 'stok_id';
    use SoftDeletes;
    protected $fillable = [
        'supplier_id',
        'barang_id',
        'user_id',
        'stok_tanggal',
        'stok_jumlah',
    ];

    // Otomatis konversi tipe data
    protected $casts = [
        'stok_tanggal' => 'datetime',
    ];

    // Relasi ke supplier
    public function supplier()
    {
        return $this->belongsTo(SupplierModel::class, 'supplier_id', 'supplier_id');
    }

    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(BarangModel::class, 'barang_id', 'barang_id');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }
}