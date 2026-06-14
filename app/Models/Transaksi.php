<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    public $timestamps = false;

    protected $fillable = [
        'id_buah',
        'tgl_transaksi',
        'jenis',
        'jumlah',
        'keterangan',
    ];

    // Relasi Balikan: Transaksi ini mencatat buah tertentu
    public function buah(): BelongsTo
    {
        return $this->belongsTo(Buah::class, 'id_buah', 'id_buah');
    }
}
