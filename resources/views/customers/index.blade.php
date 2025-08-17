<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Customers</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('customers.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add New Customer</a>

            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Surname</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Email</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Phone</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Payout Amount</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Payout Date</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Residence</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($customers as $customer)
                            <tr>
                                <td class="px-6 py-4">{{ $customer->name }}</td>
                                <td class="px-6 py-4">{{ $customer->surname }}</td>
                                <td class="px-6 py-4">{{ $customer->email }}</td>
                                <td class="px-6 py-4">{{ $customer->phone_number }}</td>
                                <td class="px-6 py-4">{{ $customer->payout_amount }}</td>
                                <td class="px-6 py-4">{{ $customer->payout_date }}</td>
                                <td class="px-6 py-4">{{ $customer->place_of_residence }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('customers.edit', $customer) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline ml-2" onclick="return confirm('Delete this customer?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
