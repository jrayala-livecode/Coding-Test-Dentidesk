<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\IncomeCategory;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sueldo',
                'description' => '',
            ],
            [
                'name' => 'Ventas',
                'description' => '',
            ],
            [
                'name' => 'Honorarios',
                'description' => '',
            ],
            [
                'name' => 'Inversiones',
                'description' => '',
            ],
            [
                'name' => 'Alquileres',
                'description' => '',
            ],
            [
                'name' => 'Intereses',
                'description' => '',
            ],
            [
                'name' => 'Subsidios',
                'description' => '',
            ],
            [
                'name' => 'Bonificaciones',
                'description' => '',
            ],
            [
                'name' => 'Regalías',
                'description' => '',
            ],
            [
                'name' => 'Otros',
                'description' => '',
            ],
            // Add more categories as needed
        ];

        foreach ($categories as $categoryData) {
            IncomeCategory::create($categoryData);
        }
    }
}