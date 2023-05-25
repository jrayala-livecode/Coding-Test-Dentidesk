<?php

namespace App\Http\Controllers\API;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $expenses = $user->expenses()->with('category')->get();

        return response()->json($expenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $user = Auth::user();
        $expense = $user->expenses()->create($validatedData);

        return response()->json($expense, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        $user = Auth::user();

        if ($expense->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($expense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expense $expense)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'category_id' => 'required|exists:expense_categories,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        if ($expense->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $expense->update($validatedData);

        return response()->json($expense);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        $user = Auth::user();

        if ($expense->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $expense->delete();

        return response()->json(['message' => 'Expense deleted successfully']);
    }
}
