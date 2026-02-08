<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\BudgetTransaction;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index()
    {
        $year = date('Y');
        $budgets = Budget::withSum('transactions', 'amount')
            ->where('year', $year)
            ->orderBy('type', 'desc') // Income first
            ->get();

        $totalIncome = $budgets->where('type', 'income')->sum('amount');
        $realizedIncome = $budgets->where('type', 'income')->sum('transactions_sum_amount');

        $totalExpense = $budgets->where('type', 'expense')->sum('amount');
        $realizedExpense = $budgets->where('type', 'expense')->sum('transactions_sum_amount');

        return view('pages.budget.index', compact('budgets', 'totalIncome', 'realizedIncome', 'totalExpense', 'realizedExpense', 'year'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:income,expense',
            'category' => 'required|string',
            'amount' => 'required|numeric',
            'year' => 'required|integer',
            'description' => 'nullable|string',
        ]);

        Budget::create($validated);
        return back()->with('success', 'Anggaran berhasil ditambahkan.');
    }

    public function storeTransaction(Request $request)
    {
        $validated = $request->validate([
            'budget_id' => 'required|exists:budgets,id',
            'date' => 'required|date',
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);

        BudgetTransaction::create($validated);
        return back()->with('success', 'Transaksi berhasil dicatat.');
    }
}