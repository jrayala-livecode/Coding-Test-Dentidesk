<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;

class IncomeCategoryController extends Controller
{
    /**
     * Display a listing of the income categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $incomeCategories = IncomeCategory::all();

        return response()->json($incomeCategories);
    }
    
    /**
     * Display the specified income category.
     *
     * @param  \App\Models\IncomeCategory  $incomeCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(IncomeCategory $incomeCategory)
    {
        return response()->json($incomeCategory);
    }
}
