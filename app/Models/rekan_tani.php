<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class rekan_tani extends Model
{
    use HasFactory;

    protected $table = 'rekan_tanis';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama',
        'alamat',
        'foto_profil',
        'no_hp',
        'bukti_usaha',
        'id_akun',
        'id_kota',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function bibit()
    {
        return $this->hasMany(bibit::class, 'id_rekantani', 'id');
    }

    public function kota()
    {
        return $this->belongsTo(kota::class, 'id_kota');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun');
    }
}
