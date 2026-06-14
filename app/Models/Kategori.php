<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
    ];

    // Relasi One-to-Many: Satu kategori memiliki banyak buah
    public function buah(): HasMany
    {
        return $this->hasMany(Buah::class, 'id_kategori', 'id_kategori');
    }
}
