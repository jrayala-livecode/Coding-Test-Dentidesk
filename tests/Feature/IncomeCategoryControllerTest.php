<?php

namespace Tests\Feature\API;

use App\Models\IncomeCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IncomeCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the index method.
     *
     * @return void
     */
    public function testIndex()
    {
        IncomeCategory::factory()->count(5)->create();

        $response = $this->getJson('/api/income-categories');

        $response->assertOk()
            ->assertJsonCount(5);
    }

    /**
     * Test the show method.
     *
     * @return void
     */
    public function testShow()
    {
        $incomeCategory = IncomeCategory::factory()->create();

        $response = $this->getJson('/api/income-categories/' . $incomeCategory->id);

        $response->assertOk()
            ->assertJson([
                'id' => $incomeCategory->id,
                'name' => $incomeCategory->name,
                'description' => $incomeCategory->description,
            ]);
    }
}
