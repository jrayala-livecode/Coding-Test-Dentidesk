<?php

namespace Tests\Feature\API;

use App\Models\Category;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test the index method of ExpenseController.
     */
    public function testIndex()
    {
        $user = User::factory()->create();
        Expense::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/expenses');

        $response->assertOk()
            ->assertJsonCount(3)
            ->assertJsonStructure([
                '*' => ['id', 'user_id', 'category_id', 'description', 'amount', 'created_at', 'updated_at'],
            ]);
    }

    /**
     * Test the store method of ExpenseController.
     */
    public function testStore()
    {
        $user = User::factory()->create();
        
        $expenseData = Expense::factory()->make([
            'user_id' => $user->id
        ])->toArray();

        $response = $this->actingAs($user)->postJson('/api/expenses', $expenseData);

        $response->assertCreated()
            ->assertJson($expenseData);
        
        $this->assertDatabaseHas('expenses', $expenseData);
    }

    /**
     * Test the show method of ExpenseController.
     */
    public function testShow()
    {
        $user = User::factory()->create();
        $expense = Expense::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson("/api/expenses/{$expense->id}");

        $response->assertOk()
            ->assertJson($expense->toArray());
    }

    /**
     * Test the update method of ExpenseController.
     */
    public function testUpdate()
    {
        $user = User::factory()->create();

        $expense = Expense::factory()->create(['user_id' => $user->id]);

        $updatedExpenseData = Expense::factory()->make(['user_id' => $user->id])->toArray();

        $response = $this->actingAs($user)->putJson("/api/expenses/{$expense->id}", $updatedExpenseData);

        $response->assertOk()
            ->assertJson($updatedExpenseData);
        
        $this->assertDatabaseHas('expenses', $updatedExpenseData);
    }

    /**
     * Test the destroy method of ExpenseController.
     */
    public function testDestroy()
    {
        $user = User::factory()->create();
        $expense = Expense::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/api/expenses/{$expense->id}");

        $response->assertOk()
            ->assertJson(['message' => 'Expense deleted successfully']);
        
        $this->assertDatabaseMissing('expenses', ['id' => $expense->id]);
    }
}
