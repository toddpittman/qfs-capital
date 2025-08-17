@extends('layouts.admin')

@section('title', 'Add New Transaction')

@section('content')
<div class="w-full max-w-screen-xl mx-auto p-10 rounded-xl"
     style="background: linear-gradient(180deg, rgba(45,35,0,0.9) 0%, rgba(0,0,0,0.7) 100%);
            backdrop-filter: blur(4px);
            box-shadow: none;">
    <h2 class="text-yellow-800 font-semibold text-2xl mb-6">Add New Transaction</h2>

    <form action="{{ route('admin.history.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="customer_id" class="block text-yellow-800 text-sm font-semibold mb-2">Customer ID</label>
            <input type="text" name="customer_id" id="customer_id" value="{{ old('customer_id') }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('customer_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="date" class="block text-yellow-800 text-sm font-semibold mb-2">Date</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="status" class="block text-yellow-800 text-sm font-semibold mb-2">Status</label>
            <select name="status" id="status"
                class="w-full border border-yellow-800 rounded py-2 px-3 bg-yellow-50 text-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
                <option value="" disabled selected>Select status</option>
                <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="failed" {{ old('status') === 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
            @error('status')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="from" class="block text-yellow-800 text-sm font-semibold mb-2">From</label>
            <input type="text" name="from" id="from" value="{{ old('from') }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('from')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="to" class="block text-yellow-800 text-sm font-semibold mb-2">To</label>
            <input type="text" name="to" id="to" value="{{ old('to') }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('to')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.history.index') }}"
               class="bg-yellow-600 hover:bg-yellow-700 text-black font-bold py-2 px-4 rounded-full transition duration-300">
                Cancel
            </a>
            <button type="submit"
                class="bg-yellow-600 hover:bg-yellow-700 text-black font-bold py-2 px-6 rounded-full transition duration-300">
                Save
            </button>
        </div>
    </form>
</div>
@endsection
