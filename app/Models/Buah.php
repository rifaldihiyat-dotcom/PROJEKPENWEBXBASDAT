<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buah extends Model
{
    protected $table = 'buah';
    protected $primaryKey = 'id_buah';
    public $timestamps = false;

    protected $fillable = [
        'nama_buah',
        'harga_jual',
        'id_kategori',
        'gambar',
    ];

    // Relasi 1:1 ke tabel stok
    public function stok()
    {
        return $this->hasOne(Stok::class, 'id_buah', 'id_buah');
    }

    // Accessor untuk memudahkan akses stok
    public function getStokAttribute()
    {
        return $this->stok ? $this->stok->jumlah : 0;
    }

    // Relasi ke tabel Kategori
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke tabel Supplier (Many-to-Many)
    public function suppliers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'buah_supplier', 'id_buah', 'id_supplier');
    }

    // Relasi ke tabel Transaksi
    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_buah', 'id_buah');
    }
}
