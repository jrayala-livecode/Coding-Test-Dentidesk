<?php

namespace Tests\Feature\API;

use App\Models\Category;
use App\Models\Income;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IncomeControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test the index method of IncomeController.
     */
    public function testIndex()
    {
        $user = User::factory()->create();
        Income::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/api/incomes');

        $response->assertOk()
            ->assertJsonCount(3)
            ->assertJsonStructure([
                '*' => ['id', 'user_id', 'category_id', 'description', 'amount', 'created_at', 'updated_at'],
            ]);
    }

    /**
     * Test the store method of IncomeController.
     */
    public function testStore()
    {
        $user = User::factory()->create();
        
        $incomeData = Income::factory()->make([
            'user_id' => $user->id
        ])->toArray();

        $response = $this->actingAs($user)->postJson('/api/incomes', $incomeData);

        $response->assertCreated()
            ->assertJson($incomeData);
        
        $this->assertDatabaseHas('incomes', $incomeData);
    }

    /**
     * Test the show method of IncomeController.
     */
    public function testShow()
    {
        $user = User::factory()->create();
        $income = Income::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson("/api/incomes/{$income->id}");

        $response->assertOk()
            ->assertJson($income->toArray());
    }

    /**
     * Test the update method of IncomeController.
     */
    public function testUpdate()
    {
        $user = User::factory()->create();

        $income = Income::factory()->create(['user_id' => $user->id]);

        $updatedIncomeData = Income::factory()->make(['user_id' => $user->id])->toArray();


        $response = $this->actingAs($user)->putJson("/api/incomes/{$income->id}", $updatedIncomeData);

        $response->assertOk()
            ->assertJson($updatedIncomeData);
        
        $this->assertDatabaseHas('incomes', $updatedIncomeData);
    }

    /**
     * Test the destroy method of IncomeController.
     */
    public function testDestroy()
    {
        $user = User::factory()->create();
        $income = Income::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/api/incomes/{$income->id}");

        $response->assertOk()
            ->assertJson(['message' => 'Income deleted successfully']);
        
        $this->assertDatabaseMissing('incomes', ['id' => $income->id]);
    }
}
