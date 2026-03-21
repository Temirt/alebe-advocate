<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Form;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

$formsDir = storage_path('app/public/forms');
$files = scandir($formsDir);

foreach ($files as $file) {
    if ($file === '.' || $file === '..' || !str_ends_with($file, '.pdf')) continue;
    
    // Skip already registered UUID-like files if they are in the DB
    if (preg_match('/^[a-zA-Z0-9]{40}\.pdf$/', $file) || preg_match('/^[a-zA-Z0-9]{34}\.pdf$/', $file)) {
        if (Form::where('file_url', 'like', "%{$file}")->exists()) {
            continue;
        }
    }

    // Process Amharic or other new files
    $title = str_replace('.pdf', '', $file);
    $price = 250.00; // Default price as an example, user can change later
    
    // Check if title already exists to avoid duplicates
    if (Form::where('title', $title)->exists()) {
        echo "Form '{$title}' already exists in DB. Skipping...\n";
        continue;
    }

    // Register in DB
    Form::create([
        'title' => $title,
        'description' => "Professional legal document for: {$title}",
        'price' => $price,
        'file_url' => "/storage/forms/{$file}",
        'is_published' => true,
        'created_by' => 1, // Assuming admin
    ]);

    echo "Registered in DB: {$title} (File: {$file})\n";
}
