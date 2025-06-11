<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';

    // Kalau primary key UUID, tambahkan ini:
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'jumlah_permintaan',
        'tanggal_dibutuhkan',
        'tanggal_pengiriman',
        'lokasi_pengiriman',
        'keterangan',
        'narahubung',
        'status_pengajuan',
        'status_pembayaran',
        'status_pengiriman',
        'foto_invoice',
        'bukti_bayar',
        'id_bibit',
        'id_agens'
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
        return $this->belongsTo(Bibit::class, 'id_bibit')->withTrashed();
    }

    public function agen()
    {
        return $this->belongsTo(Agen::class, 'id_agens');
    }
}
