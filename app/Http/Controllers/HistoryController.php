<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Customer;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    // Display a paginated list of transactions with related customer info
    public function index(Request $request)
    {
        $query = Transaction::query();

        $hasHistory = false;

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('customer_id', 'like', "%$search%");

            // Check if this customer already has transactions (exact match)
            $hasHistory = Transaction::where('customer_id', $search)->exists();
        }

        $histories = $query->latest()->paginate(10);

        return view('admin.history.index', compact('histories', 'hasHistory'));
    }

    // Show form to create a new transaction history entry
    public function create()
    {
        $customers = Customer::orderBy('name')->get();
        return view('admin.history.create', compact('customers'));
    }

    // Store new transaction after validation
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'date' => 'required|date',
            'status' => 'required|string|max:255',
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
        ]);

        Transaction::create($request->only([
            'customer_id',
            'date',
            'status',
            'from',
            'to',
        ]));

        return redirect()->route('admin.history.index')->with('success', 'Transaction added successfully.');
    }

    // Show form to edit an existing transaction
    public function edit(Transaction $transaction)
    {
        return view('admin.history.edit', compact('transaction'));
    }

    // Update an existing transaction
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'date' => 'required|date',
            'status' => 'required|string|max:255',
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
        ]);

        $transaction->update($request->only([
            'customer_id',
            'date',
            'status',
            'from',
            'to',
        ]));

        return redirect()->route('admin.history.index')->with('success', 'Transaction updated successfully.');
    }

    // Delete a transaction
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.history.index')->with('success', 'Transaction deleted successfully.');
    }
}
