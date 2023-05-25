<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\ExpenseCategory;

class ExpenseCategorySeeder extends Seeder
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
                'name' => 'Comida',
                'description' => 'Gastos relacionados con comida y restaurantes',
            ],
            [
                'name' => 'Transporte',
                'description' => 'Gastos relacionados con transporte',
            ],
            [
                'name' => 'Vivienda',
                'description' => 'Gastos relacionados con vivienda y servicios públicos',
            ],
            [
                'name' => 'Servicios Públicos',
                'description' => 'Gastos relacionados con servicios públicos (por ejemplo, electricidad, agua)',
            ],
            [
                'name' => 'Entretenimiento',
                'description' => 'Gastos relacionados con entretenimiento y actividades de ocio',
            ],
            [
                'name' => 'Educación',
                'description' => 'Gastos relacionados con educación y aprendizaje',
            ],
            [
                'name' => 'Salud',
                'description' => 'Gastos relacionados con atención médica y gastos médicos',
            ],
            [
                'name' => 'Seguros',
                'description' => 'Gastos relacionados con pólizas de seguros',
            ],
            [
                'name' => 'Deudas',
                'description' => 'Gastos relacionados con pagos de deudas',
            ],
            [
                'name' => 'Otros',
                'description' => 'Otros gastos diversos',
            ],
        ];

        foreach ($categories as $categoryData) {
            ExpenseCategory::create($categoryData);
        }
    }
}
