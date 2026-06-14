landin# Logika Menambahkan Log Transaksi saat Pembelian di Landing Page

## Tujuan

Saat user melakukan pembelian dari landing page (flow: tambah ke keranjang → checkout → bayar), sistem harus:

1. Mengurangi stok barang di tabel `buah`.
2. Menambahkan log/riwayat transaksi ke tabel `transaksi`.

## Ringkasan Implementasi di Project

Logika ini sudah dipasangkan pada endpoint checkout.

- **Route**: `POST /checkout`
- **Controller**: `CheckoutController@store`
- **Model**: `Buah`, `Transaksi`

Lokasi kode:

- `routes/web.php`
- `app/Http/Controllers/CheckoutController.php`
- `app/Models/Transaksi.php`
- `app/Models/Buah.php`

## Alur Logika Detail

### 1) Frontend mengirim data cart ke backend

File: `resources/views/keranjang.blade.php`

Pada submit form `#checkoutForm`, frontend:

- mengambil cart dari `localStorage`
- mengirim request JSON ke endpoint checkout:

```json
{
    "cart": [
        { "id": 1, "qty": 2 },
        { "id": 5, "qty": 1 }
    ]
}
```

### 2) Backend memvalidasi input dan membuka transaksi DB

File: `app/Http/Controllers/CheckoutController.php`

Method `store(Request $request)` melakukan:

- validasi request:
    - `cart` wajib array
    - setiap elemen: `id` integer, `qty` integer min 1
- `DB::beginTransaction()`

### 3) Mengurangi stok (decrement) dengan penguncian baris

Untuk tiap item pada cart:

- ambil data buah dengan row lock agar aman dari kondisi balapan:

```php
$buah = Buah::where('id_buah', $item['id'])->lockForUpdate()->first();
```

Jika kolom `stok` ada pada tabel `buah`:

- cek apakah stok cukup
- jika tidak cukup → `ValidationException`
- jika cukup → decrement stok dan simpan

### 4) Menambahkan log transaksi ke tabel `transaksi`

Masih di dalam loop yang sama, setelah stok aman:

```php
Transaksi::create([
  'id_buah' => $buah->id_buah,
  'tgl_transaksi' => now()->format('Y-m-d'),
  'jenis' => 'keluar',
  'jumlah' => $qty,
  'keterangan' => 'Pembelian via landing page',
]);
```

Artinya:

- **Satu item cart → satu baris transaksi**

### 5) Commit / rollback

- Jika sukses: `DB::commit()`
- Jika validasi gagal: `DB::rollBack()` lalu exception dilempar
- Jika error lain: `DB::rollBack()` dan return response error

## Struktur Model Transaksi

File: `app/Models/Transaksi.php`

Model mengarah ke tabel `transaksi`:

- primary key: `id_transaksi`
- `timestamps = false`
- field yang bisa diisi (`$fillable`):
    - `id_buah`
    - `tgl_transaksi`
    - `jenis`
    - `jumlah`
    - `keterangan`

## Output yang Dicapai

Setelah checkout berhasil:

1. `buah.stok` berkurang sesuai qty.
2. Tabel `transaksi` bertambah record berisi:
    - `jenis = keluar`
    - `keterangan = Pembelian via landing page`

## Catatan Tambahan (opsional)

Saat ini pencatatan transaksi dibuat per **item cart**.
Jika kebutuhan kamu adalah:

- 1 checkout = 1 transaksi (header),
- lalu item-item disimpan sebagai detail,
  maka perlu desain tambahan (misal tabel `transaksi_detail`).
