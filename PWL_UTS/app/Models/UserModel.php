<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'level_id',
        'username',
        'nama',
        'password',
        'email',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function level()
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }

    public function stoks()
    {
        return $this->hasMany(StokModel::class, 'user_id', 'user_id');
    }

    public function penjualans()
    {
        return $this->hasMany(PenjualanModel::class, 'user_id', 'user_id');
    }
}