@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')

    <!-- Search Bar -->
    <form method="GET" action="{{ route('admin.dashboard') }}" class="mb-6 flex gap-2 items-center">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by Customer ID"
            class="w-full max-w-sm p-2 rounded border border-gray-300 text-black"
        />
        <button type="submit" class="btn">Search</button>
    </form>

    @if (session('success'))
        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Payout Amount</th>
                <th>Payout Date</th>
                <th>Residence</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($customers as $customer)
                <tr>
                    <td>{{ $customer->customer_id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->surname }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>{{ number_format($customer->payout_amount, 2) }}</td>
                    <td>{{ $customer->payout_date ? $customer->payout_date->format('Y-m-d') : '' }}</td>
                    <td>{{ $customer->place_of_residence }}</td>
                    <td>
                        <a href="{{ route('customers.edit', $customer) }}" class="font-semibold mr-4 hover:underline">Edit</a>
                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline-block"
                              onsubmit="return confirm('Are you sure you want to delete this customer?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 font-semibold">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="9" class="text-center py-6 text-gray-500">No customers found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="mt-6">
        {{ $customers->links() }}
    </div>

@endsection
