@extends('layouts.admin')

@section('title', 'Customer Balances')

@section('content')

<!-- Search Bar -->
<form method="GET" action="{{ route('admin.customer_balance.index') }}" class="mb-6 flex gap-2 items-center">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search by Customer ID"
        class="w-full max-w-sm p-2 rounded border border-gray-300 text-black"
    />
    <button type="submit" class="btn">Search</button>
</form>

<!-- Success Message -->
@if (session('success'))
    <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

<!-- Add New Balance Form -->
<div class="bg-black border border-yellow-700 rounded-xl p-4 mb-6">
    <h3 class="text-yellow-400 font-semibold text-lg mb-4">Add Customer Balance</h3>

    <form action="{{ route('admin.customer_balance.store') }}" method="POST" class="flex flex-wrap items-center gap-4">
        @csrf

        <input
            type="text"
            name="customer_id"
            placeholder="Customer ID"
            class="flex-1 min-w-[140px] p-2 rounded border border-yellow-700 bg-yellow-50 text-yellow-900"
            required
        />
        <input
            type="number"
            name="available_balance"
            step="0.01"
            placeholder="Available"
            class="flex-1 min-w-[140px] p-2 rounded border border-yellow-700 bg-yellow-50 text-yellow-900"
            required
        />
        <input
            type="number"
            name="pending_balance"
            step="0.01"
            placeholder="Pending"
            class="flex-1 min-w-[140px] p-2 rounded border border-yellow-700 bg-yellow-50 text-yellow-900"
            required
        />
        <input
            type="text"
            name="currency"
            placeholder="Currency"
            class="flex-1 min-w-[100px] p-2 rounded border border-yellow-700 bg-yellow-50 text-yellow-900"
            required
        />
        <button
            type="submit"
            class="bg-yellow-600 hover:bg-yellow-700 text-black font-bold py-2 px-6 rounded transition duration-300"
        >
            Save
        </button>
    </form>
</div>

<!-- Table -->
<table class="min-w-full border border-gray-300 rounded overflow-hidden">
    <thead class="bg-gray-100 text-left text-sm">
        <tr>
            <th class="px-4 py-2 border-b">Customer ID</th>
            <th class="px-4 py-2 border-b">Available</th>
            <th class="px-4 py-2 border-b">Pending</th>
            <th class="px-4 py-2 border-b">Currency</th>
            <th class="px-4 py-2 border-b">Updated At</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($balances as $balance)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border-b">{{ $balance->customer_id }}</td>
                <td class="px-4 py-2 border-b">{{ number_format($balance->available_balance, 2) }}</td>
                <td class="px-4 py-2 border-b">{{ number_format($balance->pending_balance, 2) }}</td>
                <td class="px-4 py-2 border-b">{{ strtoupper($balance->currency) }}</td>
                <td class="px-4 py-2 border-b">{{ $balance->updated_at->format('Y-m-d') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center py-6 text-gray-500">No balances found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Pagination -->
<div class="mt-6">
    {{ $balances->links() }}
</div>

@endsection
