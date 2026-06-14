<?php
// One-off script to set sample stok for Buah::first()
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Buah;

$buah = Buah::first();
if (! $buah) {
    echo "No buah rows found\n";
    exit(1);
}
$buah->stok = 10;
$buah->save();

echo "Updated buah id={$buah->id_buah} stok={$buah->stok}\n";
