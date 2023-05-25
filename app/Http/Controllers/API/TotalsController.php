<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use Illuminate\Support\Facades\Auth;

class TotalsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function monthlyTotal(Request $request)
    {
        $user = Auth::user();

        $incomes = $user->incomes()
            ->with('category')
            ->when($request->has('year'), function ($query) use ($request) {
                return $query->whereYear('created_at', $request->year);
            })
            ->when($request->has('month'), function ($query) use ($request) {
                return $query->whereMonth('created_at', $request->month);
            })
            ->get();

        $expenses = $user->expenses()
            ->with('category')
            ->when($request->has('year'), function ($query) use ($request) {
                return $query->whereYear('created_at', $request->year);
            })
            ->when($request->has('month'), function ($query) use ($request) {
                return $query->whereMonth('created_at', $request->month);
            })
            ->get();

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');
        $total = $totalIncome - $totalExpense;

        return response()->json([
            'total' => $total,
            'totalIncome' => $totalIncome,
            'totalExpense' => $totalExpense,
        ]);
    }

    public function getIncomeAndExpensesByCategory(Request $request)
    {
        $user = Auth::user();
        $year = $request->input('year');
        $month = $request->input('month');

        // Get income by category
        $incomeByCategory = IncomeCategory::with(['incomes' => function ($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                ->when($year, function ($query) use ($year) {
                    $query->whereYear('created_at', $year);
                })
                ->when($month, function ($query) use ($month) {
                    $query->whereMonth('created_at', $month);
                });
        }])
            ->get()
            ->map(function ($category) {
                $totalAmount = $category->incomes->sum('amount');
                return [
                    'category' => $category->name,
                    'total_amount' => $totalAmount,
                ];
            });

        // Get expenses by category
        $expensesByCategory = ExpenseCategory::with(['expenses' => function ($query) use ($user, $year, $month) {
            $query->where('user_id', $user->id)
                ->when($year, function ($query) use ($year) {
                    $query->whereYear('created_at', $year);
                })
                ->when($month, function ($query) use ($month) {
                    $query->whereMonth('created_at', $month);
                });
            }])
            ->get()
            ->map(function ($category) {
                $totalAmount = $category->expenses->sum('amount');
                return [
                    'category' => $category->name,
                    'total_amount' => $totalAmount,
                ];
            });

        return response()->json([
            'income_by_category' => $incomeByCategory,
            'expenses_by_category' => $expensesByCategory,
        ]);
    }
}
