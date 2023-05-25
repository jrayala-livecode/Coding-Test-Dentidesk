<?php
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\ExpenseCategory;

class ExpenseCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        ExpenseCategory::factory()->count(5)->create();

        $response = $this->get('/api/expense-categories');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }

    public function testShow()
    {
        $expenseCategory = ExpenseCategory::factory()->create();

        $response = $this->get('/api/expense-categories/'.$expenseCategory->id);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $expenseCategory->id,
                'name' => $expenseCategory->name,
                'description' => $expenseCategory->description,
            ]);
    }
}
