<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;

class LegalFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = [
            ["title" => "Sample Legal Consultation", "price" => 1500, "file_url" => "sample.pdf"],
            ["title" => "በመሬት ላይ የተፈጸመ ሁከት ይወገድልኝ", "price" => 250, "file_url" => "/storage/forms/በመሬት ላይ የተፈጸመ ሁከት ይወገድልኝ.pdf"],
            ["title" => "የይግባኝ አቤቱታ", "price" => 250, "file_url" => "/storage/forms/የይግባኝ አቤቱታ.pdf"],
            ["title" => "የውል ማፍረሻ ክስ", "price" => 250, "file_url" => "/storage/forms/የውል ማፍረሻ ክስ.pdf"],
            ["title" => "የፍች ስምምነት", "price" => 250, "file_url" => "/storage/forms/የፍች ስምምነት.pdf"],
            ["title" => "የቤት ሽያጭ ውል", "price" => 250, "file_url" => "/storage/forms/የቤት ሽያጭ ውል.pdf"],
            ["title" => "የመኪና ሽያጭ ውል", "price" => 250, "file_url" => "/storage/forms/የመኪና ሽያጭ ውል.pdf"],
            ["title" => "የኪራይ ውል", "price" => 250, "file_url" => "/storage/forms/የኪራይ ውል.pdf"],
            ["title" => "የውክልና ስልጣን", "price" => 250, "file_url" => "/storage/forms/የውክልና ስልጣን.pdf"],
            ["title" => "የኑዛዜ ወረቀት", "price" => 250, "file_url" => "/storage/forms/የኑዛዜ ወረቀት.pdf"],
            ["title" => "የስራ ውል ስምምነት", "price" => 250, "file_url" => "/storage/forms/የስራ ውል ስምምነት.pdf"],
            ["title" => "በግልግል ዳኝነት እንዲታይ የሚቀርብ አቤቱታ", "price" => 250, "file_url" => "/storage/forms/በግልግል ዳኝነት እንዲታይ የሚቀርብ አቤቱታ.pdf"],
            ["title" => "የጋራ ይዞታ መብት የመጠቀም መብት ይከበርልኝ", "price" => 250, "file_url" => "/storage/forms/የጋራ ይዞታ መብት የመጠቀም መብት ይከበርልኝ.pdf"],
            ["title" => "ደንበር ተገፋብኝ", "price" => 250, "file_url" => "/storage/forms/ደንበር ተገፋብኝ.pdf"]
        ];

        foreach ($forms as $formData) {
            Form::updateOrCreate(
                ['title' => $formData['title']],
                [
                    'price' => $formData['price'],
                    'file_url' => $formData['file_url'],
                    'description' => "Professional legal document for: " . $formData['title'],
                    'is_published' => true,
                    'created_by' => 1
                ]
            );
        }
    }
}
