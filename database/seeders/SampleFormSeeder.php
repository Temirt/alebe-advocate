<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;

class SampleFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a published sample form so the public /forms page shows content
        Form::create([
            'title' => 'Sample Legal Consultation',
            'description' => 'This is a sample form entry for testing the public forms listing. It represents a legal consultation offering with a sample price and optional file attachment.',
            'price' => 5000,
            'file_url' => null,
            'created_by' => 1,
            'is_published' => 1,
        ]);
    }
}
