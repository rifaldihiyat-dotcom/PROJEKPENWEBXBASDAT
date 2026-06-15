<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = 'stok';
    protected $primaryKey = 'id_stok'; // Asumsi jika ada, jika tidak, bisa dihapus. Biasanya PK-nya id_stok
    public $timestamps = false;

    protected $fillable = [
        'id_buah',
        'jumlah'
    ];

    public function buah()
    {
        return $this->belongsTo(Buah::class, 'id_buah', 'id_buah');
    }
}
