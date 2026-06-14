
<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$res = DB::select('SHOW CREATE TABLE buah');
echo $res[0]->{'Create Table'};
