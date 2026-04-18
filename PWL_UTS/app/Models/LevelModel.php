<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LevelModel extends Model
{
    // Nama tabel yang digunakan
    protected $table = 'm_level';

    // Primary key tabel
    protected $primaryKey = 'level_id';

    // Kolom yang boleh diisi (mass assignment)
    protected $fillable = [
        'level_kode',
        'level_nama',
    ];

    // Relasi: satu level punya banyak user
    public function users()
    {
        return $this->hasMany(UserModel::class, 'level_id', 'level_id');
    }
}