<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$forms = \App\Models\Form::all();
foreach ($forms as $form) {
    echo "ID: {$form->id}, Title: {$form->title}, File: {$form->file_url}, Published: {$form->is_published}\n";
}
