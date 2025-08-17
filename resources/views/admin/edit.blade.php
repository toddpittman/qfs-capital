@extends('layouts.admin')

@section('title', 'Edit Customer')

@section('content')
<div class="w-full max-w-screen-xl mx-auto p-10 rounded-xl"
     style="background: linear-gradient(180deg, rgba(45,35,0,0.9) 0%, rgba(0,0,0,0.7) 100%);
            backdrop-filter: blur(4px);
            box-shadow: none;">
    <h2 class="text-yellow-800 font-semibold text-2xl mb-6">Edit Customer</h2>

    <form action="{{ route('customers.update', $customer) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-yellow-800 text-sm font-semibold mb-2">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $customer->name) }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="surname" class="block text-yellow-800 text-sm font-semibold mb-2">Surname</label>
            <input type="text" name="surname" id="surname" value="{{ old('surname', $customer->surname) }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('surname')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-yellow-800 text-sm font-semibold mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $customer->email) }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="phone_number" class="block text-yellow-800 text-sm font-semibold mb-2">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', $customer->phone_number) }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('phone_number')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="payout_amount" class="block text-yellow-800 text-sm font-semibold mb-2">Payout Amount</label>
            <input type="number" step="0.01" max="99999999999999.99" name="payout_amount" id="payout_amount"
                value="{{ old('payout_amount', $customer->payout_amount) }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('payout_amount')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="payout_date" class="block text-yellow-800 text-sm font-semibold mb-2">Payout Date</label>
            <input type="date" name="payout_date" id="payout_date" value="{{ old('payout_date', $customer->payout_date->format('Y-m-d')) }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('payout_date')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="place_of_residence" class="block text-yellow-800 text-sm font-semibold mb-2">Place of Residence</label>
            <input type="text" name="place_of_residence" id="place_of_residence" value="{{ old('place_of_residence', $customer->place_of_residence) }}"
                class="w-full border border-yellow-800 rounded py-2 px-3 text-yellow-900 bg-yellow-50 focus:outline-none focus:ring-2 focus:ring-yellow-600" required>
            @error('place_of_residence')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('customers.index') }}"
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
