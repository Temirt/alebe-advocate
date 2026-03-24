<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Form;

class LegalFormTest extends TestCase
{
    /**
     * Test if the legal forms store page loads successfully.
     */
    public function test_legal_forms_page_loads_successfully(): void
    {
        $response = $this->get('/legal-forms');
        $response->assertStatus(200);
        $response->assertSee('Legal Forms Store');
    }

    /**
     * Test if search works on the legal forms page.
     */
    public function test_legal_forms_search_works(): void
    {
        // Add a temporary form to test search
        $form = Form::factory()->create([
            'title' => 'Affidavit for Property',
            'is_published' => true,
        ]);

        $response = $this->get('/legal-forms?search=Affidavit');
        $response->assertStatus(200);
        $response->assertSee('Affidavit for Property');
        
        // Cleanup after test
        $form->delete();
    }
}
