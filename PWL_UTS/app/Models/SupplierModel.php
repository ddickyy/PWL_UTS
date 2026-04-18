<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    protected $table = 'm_supplier';
    protected $primaryKey = 'supplier_id';

    protected $fillable = [
        'supplier_kode',
        'supplier_nama',
        'supplier_alamat',
    ];

    // Relasi: satu supplier punya banyak stok
    public function stoks()
    {
        return $this->hasMany(StokModel::class, 'supplier_id', 'supplier_id');
    }
}