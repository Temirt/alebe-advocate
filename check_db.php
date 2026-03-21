<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$sessionId = 'wJWA3A17czxvJaSEphYkbEYFIZrQk8L4CuzIIliu';
$exists = \DB::table('sessions')->where('id', $sessionId)->exists();
echo "Session Exists: " . ($exists ? 'YES' : 'NO') . "\n";

$tables = \DB::select("SELECT name FROM sqlite_master WHERE type='table'");
echo "Tables: " . implode(', ', array_column($tables, 'name')) . "\n";
