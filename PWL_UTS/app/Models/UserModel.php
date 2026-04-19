<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Filament\Support\Concerns\HasFontFamily;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements FilamentUser, HasName
{
    use HasFactory;
    use SoftDeletes;
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

    protected $casts = [
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function getFilamentName(): string
    {
        return (string) ($this->nama ?? $this->username ?? 'User');
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