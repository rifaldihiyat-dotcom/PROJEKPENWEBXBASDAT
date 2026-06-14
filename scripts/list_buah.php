<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Buah;

$buah = Buah::with('kategori')->get()->map(function($b){
    return [
        'id' => $b->id_buah,
        'nama' => $b->nama_buah,
        'kategori' => $b->kategori->nama_kategori ?? null,
        'harga' => $b->harga_jual,
    ];
});

echo $buah->toJson(JSON_PRETTY_PRINT);
