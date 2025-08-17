<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $customers = Customer::when($query, function ($q) use ($query) {
            return $q->where('customer_id', 'like', "%{$query}%");
        })->paginate(10);

        return view('admin.dashboard', compact('customers'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required|string',
            'payout_amount' => 'required|numeric',
            'payout_date' => 'required|date',
            'place_of_residence' => 'required|string',
        ]);

        // Generate customer ID: full name (lowercase, no spaces) + 2 random digits
        $cleanName = strtolower(preg_replace('/\s+/', '', $request->name));
        $randomDigits = rand(10, 99);
        $customerId = $cleanName . $randomDigits;

        // Generate random password (10 characters)
        $randomPassword = Str::random(10);
        $hashedPassword = bcrypt($randomPassword);

        // Prepare customer data
        $customerData = $request->all();
        $customerData['customer_id'] = $customerId;
        $customerData['password'] = $hashedPassword;

        // Create customer record
        $customer = Customer::create($customerData);

        // Create user record for authentication
        User::create([
            'customer_id' => $customerId,
            'password' => $hashedPassword,
            'role' => 'customer',
            // Optionally add 'name' and 'email' if needed and your users table has those fields
        ]);

        // Return success with credentials for admin to share
        return redirect()->route('customers.index')->with('success', "Customer created successfully. Customer ID: {$customerId}, Password: {$randomPassword}");
    }

    public function edit(Customer $customer)
    {
        return view('admin.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone_number' => 'required|string',
            'payout_amount' => 'required|numeric|between:0,9999999999999.99',
            'payout_date' => 'required|date',
            'place_of_residence' => 'required|string',
        ]);

        $customer->update($request->all());

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
