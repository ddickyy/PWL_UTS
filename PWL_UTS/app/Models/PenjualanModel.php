<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjualanModel extends Model
{
    protected $table = 't_penjualan';
    protected $primaryKey = 'penjualan_id';

    protected $fillable = [
        'user_id',
        'pembeli',
        'penjualan_kode',
        'penjualan_tanggal',
    ];

    protected $casts = [
        'penjualan_tanggal' => 'datetime',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    // Relasi: satu penjualan punya banyak detail
    public function details()
    {
        return $this->hasMany(PenjualanDetailModel::class, 'penjualan_id', 'penjualan_id');
    }
}