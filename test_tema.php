<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$temas = DB::table('tema_portal')->get();
$webs = DB::table('direcciones_web')->get();
echo "TEMAS:\n" . json_encode($temas, JSON_PRETTY_PRINT) . "\n";
echo "WEBS:\n" . json_encode($webs, JSON_PRETTY_PRINT) . "\n";
