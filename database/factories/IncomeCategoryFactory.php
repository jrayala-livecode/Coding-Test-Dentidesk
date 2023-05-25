<?php

namespace Database\Factories;

use App\Models\IncomeCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeCategoryFactory extends Factory
{
    protected $model = IncomeCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
