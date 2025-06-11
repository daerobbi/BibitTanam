<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class bibit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bibit';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_bibit',
        'deskripsi',
        'harga',
        'stok',
        'foto_bibit',
        'id_rekantani',
        'id_jenisbibit',
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

    public function rekanTani()
    {
        return $this->belongsTo(rekan_tani::class, 'id_rekantani');
    }

    public function jenisBibit()
    {
        return $this->belongsTo(JenisBibit::class, 'id_jenisbibit');
    }

    public function pengajuan()
    {
        return $this->hasMany(pengajuan::class, 'id_bibit');
    }
}
