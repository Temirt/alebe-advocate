<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\PracticeArea;
use App\Models\Attorney;
use App\Models\CaseResult;
use App\Models\Testimonial;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        // Practice Areas
        $practiceAreas = [
            [
                'title' => 'Criminal Defense',
                'slug' => 'criminal-defense',
                'description' => 'Aggressive defense against all criminal charges including theft, assault, drug offenses, and white-collar crimes.',
                'content' => 'Our criminal defense practice provides comprehensive representation...',
                'icon' => 'shield',
                'order' => 1
            ],
            [
                'title' => 'Family & Inheritance Law',
                'slug' => 'family-inheritance-law',
                'description' => 'Compassionate handling of divorce, child custody, adoption, and estate matters.',
                'content' => 'Family law matters require sensitivity and expertise...',
                'icon' => 'users',
                'order' => 2
            ],
            [
                'title' => 'Property & Land Law',
                'slug' => 'property-land-law',
                'description' => 'Expert guidance on real estate transactions, land disputes, and property rights.',
                'content' => 'Property law in Ethiopia requires specialized knowledge...',
                'icon' => 'home',
                'order' => 3
            ],
            [
                'title' => 'Contract Law',
                'slug' => 'contract-law',
                'description' => 'Drafting, reviewing, and enforcing contracts to protect your business interests.',
                'content' => 'Contracts form the foundation of business relationships...',
                'icon' => 'document',
                'order' => 4
            ],
        ];
        
        foreach ($practiceAreas as $area) {
            PracticeArea::create($area);
        }
        
        // Attorneys
        Attorney::create([
            'name' => 'Alex Alebe',
            'slug' => 'alex-alebe',
            'title' => 'Managing Partner',
            'bio' => 'Founding partner with over 15 years of experience in Ethiopian law...',
            'education' => ['LL.B, Addis Ababa University', 'LL.M, Harvard Law School'],
            'bar_admissions' => ['Ethiopian Federal Bar', 'Oromia Regional Bar'],
            'awards' => ['Best Lawyer 2023', 'Top 40 Under 40'],
            'email' => 'alex@alebeadvocate.et',
            'phone' => '+251911259606',
            'order' => 1
        ]);
        
        // Case Results
        CaseResult::create([
            'title' => 'High-Profile Acquittal',
            'description' => 'Secured full acquittal for client facing serious criminal charges...',
            'practice_area' => 'Criminal Defense',
            'result_type' => 'Acquitted',
            'date' => '2023-06-15',
            'is_featured' => true
        ]);
        
        // Testimonials
        Testimonial::create([
            'client_name' => 'Abebe Kebede',
            'client_title' => 'Business Owner',
            'content' => 'Alebe Advocate handled my property dispute with professionalism and achieved an excellent outcome. Highly recommended.',
            'rating' => 5,
            'is_approved' => true
        ]);
    }
}
