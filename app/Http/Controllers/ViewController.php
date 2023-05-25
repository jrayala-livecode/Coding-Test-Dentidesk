<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;

class ViewController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Show the login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function showDashboard()
    {
        return view('dashboard');
    }

    /**
     * Show the transactions view.
     *
     * @return \Illuminate\View\View
     */
    public function showTransactions()
    {
        return view('transactions', [
            'expenseCategories' => ExpenseCategory::all(),
            'incomeCategories' => IncomeCategory::all(),
        ]);
    }
}

