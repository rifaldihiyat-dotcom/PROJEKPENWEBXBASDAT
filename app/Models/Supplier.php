<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    public $timestamps = false;

    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telepon',
    ];

    // Relasi Many-to-Many: Satu supplier bisa menyuplai banyak buah
    public function buahs(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Buah::class, 'buah_supplier', 'id_supplier', 'id_buah');
    }
}
