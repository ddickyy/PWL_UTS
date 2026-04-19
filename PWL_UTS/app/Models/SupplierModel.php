<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierModel extends Model
{
    protected $table = 'm_supplier';
    protected $primaryKey = 'supplier_id';
    use SoftDeletes;
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