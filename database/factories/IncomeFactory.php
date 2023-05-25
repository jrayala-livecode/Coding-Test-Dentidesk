<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Income;
use App\Models\IncomeCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'category_id' => IncomeCategory::factory(),
            'description' => $this->faker->sentence,
            'amount' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
