@extends('layouts.admin')

@section('title', 'Transaction History')

@section('content')

    <!-- Add New Transaction Button -->
    <div class="flex justify-end mb-6">
        <a href="{{ route('admin.history.create') }}"
           class="bg-yellow-600 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-full transition duration-300">
            ➕ Add New Transaction
        </a>
    </div>

    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.history.index') }}" class="mb-6 flex gap-2 items-center">
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

    <!-- Has History Message -->
    @if ($hasHistory ?? false)
        <div class="mb-6 p-4 bg-yellow-100 border border-yellow-400 text-yellow-700 rounded">
            This customer already has transaction history. To make changes, click the <strong>Edit</strong> button.
        </div>
    @endif

    <!-- Transactions Table -->
    <table class="min-w-full border border-gray-300 rounded overflow-hidden">
        <thead class="bg-gray-100 text-left text-sm">
            <tr>
                <th class="px-4 py-2 border-b">Customer ID</th>
                <th class="px-4 py-2 border-b">Date</th>
                <th class="px-4 py-2 border-b">Status</th>
                <th class="px-4 py-2 border-b">From</th>
                <th class="px-4 py-2 border-b">To</th>
                <th class="px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($histories as $transaction)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border-b">{{ $transaction->customer_id }}</td>
                    <td class="px-4 py-2 border-b">{{ \Carbon\Carbon::parse($transaction->date)->format('Y-m-d') }}</td>
                    <td class="px-4 py-2 border-b">{{ ucfirst($transaction->status) }}</td>
                    <td class="px-4 py-2 border-b">{{ $transaction->from }}</td>
                    <td class="px-4 py-2 border-b">{{ $transaction->to }}</td>
                    <td class="px-4 py-2 border-b">
                        <a href="{{ route('admin.history.edit', $transaction->id) }}" class="text-[#1C1917] hover:underline mr-3 font-semibold">Edit</a>
                        <form action="{{ route('admin.history.destroy', $transaction->id) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline font-semibold">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center text-gray-500 py-6">No transaction history found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $histories->links() }}
    </div>

@endsection
