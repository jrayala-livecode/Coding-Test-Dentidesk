<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the expense categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $expenseCategories = ExpenseCategory::all();

        return response()->json($expenseCategories);
    }
    
    /**
     * Display the specified expense category.
     *
     * @param  \App\Models\ExpenseCategory  $expenseCategory
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ExpenseCategory $expenseCategory)
    {
        return response()->json($expenseCategory);
    }
}
