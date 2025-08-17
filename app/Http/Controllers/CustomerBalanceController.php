<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerBalanceController extends Controller
{
    /**
     * Display a listing of customers with balance info.
     */
    public function index(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('search')) {
            $query->where('customer_id', 'like', '%' . $request->search . '%');
        }

        $balances = $query->latest()->paginate(10);

        return view('admin.customer_balance.index', compact('balances'));
    }

    /**
     * Store or update balance information for a customer.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id'        => 'required|exists:customers,customer_id',
            'available_balance'  => 'required|numeric',
            'pending_balance'    => 'required|numeric',
            'currency'           => 'required|string|max:10',
        ]);

        $customer = Customer::where('customer_id', $request->customer_id)->first();

        if (!$customer) {
            return back()->withErrors(['customer_id' => 'Customer not found.']);
        }

        $customer->available_balance = $request->available_balance;
        $customer->pending_balance   = $request->pending_balance;
        $customer->currency          = $request->currency;
        $customer->save();

        return redirect()->route('admin.customer_balance.index')
                         ->with('success', 'Balance updated successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'available_balance' => 'required|numeric',
            'pending_balance' => 'required|numeric',
            'currency' => 'required|string|max:10',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->available_balance = $request->available_balance;
        $customer->pending_balance = $request->pending_balance;
        $customer->currency = $request->currency;
        $customer->save();

        return redirect()->route('admin.customer_balance.index')->with('success', 'Balance updated successfully.');
    }
}
