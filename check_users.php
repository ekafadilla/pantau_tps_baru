<?php
define('LARAVEL_START', microtime(true));
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== WILAYAH ===\n";
foreach (App\Models\Wilayah::all(['id', 'nama_wilayah']) as $w) {
    echo $w->id . ' | ' . $w->nama_wilayah . "\n";
}

echo "\n=== USERS ===\n";
foreach (App\Models\User::all(['id', 'name', 'email', 'role', 'id_wilayah']) as $u) {
    echo $u->id . ' | ' . str_pad($u->role, 10) . ' | ' . str_pad($u->name, 25) . ' | wilayah: ' . ($u->id_wilayah ?? 'NULL') . "\n";
}
