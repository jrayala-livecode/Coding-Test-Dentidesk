<?php

namespace App\Http\Controllers\API;

use App\Models\Income;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $incomes = $user->incomes()->with('category')->get();

        return response()->json($incomes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:income_categories,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        $user = Auth::user();
        $income = $user->incomes()->create($validatedData);

        return response()->json($income, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Income $income)
    {
        $user = Auth::user();

        if ($income->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json($income);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Income $income)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'category_id' => 'required|exists:income_categories,id',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        if ($income->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $income->update($validatedData);

        return response()->json($income);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Income $income)
    {
        $user = Auth::user();

        if ($income->user_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $income->delete();

        return response()->json(['message' => 'Income deleted successfully']);
    }
}
