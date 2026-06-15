# TUGAS: Menerapkan Database Baru (Sederhana) ke Proyek Laravel

## 📌 Latar Belakang
Database `inventaris_buah_db` telah disederhanakan dengan menghapus kolom `stok` yang redundan dari tabel `buah`, menambahkan data dummy ke `kategori` & `supplier` (masing-masing 20 record), serta mempertahankan semua fitur:
- Stored procedures (3)
- Triggers (3)
- Views (3)
- Index (3)
- Relasi 1:1 (buah ↔ stok) dan 1:N
- 2 user (admin & pegawai)

**Tujuan:** Menerapkan database baru ini ke dalam proyek Laravel yang sudah ada tanpa mengubah fungsionalitas (manajemen buah, kategori, supplier, transaksi, user, role/permission).

## 🛠️ Persiapan Sebelum Mulai
1. **Backup** database lama dan seluruh kode proyek.
2. Pastikan Anda memiliki akses ke file `.env` (database connection).
3. Pastikan Laravel version minimal 8.x, menggunakan Eloquent.

---

## 📝 Langkah-Langkah Implementasi

### 1. Ganti Database dengan SQL Baru
- Buka phpMyAdmin atau MySQL CLI.
- Jalankan **seluruh script SQL** yang diberikan dalam file `database_baru.sql` (terlampir).
- Pastikan nama database di `.env` adalah `inventaris_buah_db`.
- Verifikasi: cek jumlah record di tabel `kategori` (20), `supplier` (20), `buah` (20), `stok` (20), `transaksi` (27), `users` (2).

### 2. Sesuaikan Model `Buah.php`
Karena kolom `stok` sudah dihapus dari tabel `buah`, ubah model menjadi:

```php
// app/Models/Buah.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buah extends Model
{
    protected $table = 'buah';
    protected $primaryKey = 'id_buah';
    public $timestamps = false;

    protected $fillable = [
        'nama_buah',
        'gambar',
        'harga_jual',
        'id_kategori'
        // HAPUS 'stok'
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

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // Relasi many-to-many ke supplier
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'buah_supplier', 'id_buah', 'id_supplier');
    }

    // Relasi ke transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_buah', 'id_buah');
    }
}