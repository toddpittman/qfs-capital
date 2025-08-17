@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')

<div class="flex flex-col lg:flex-row gap-6 mx-auto w-[88vw] lg:w-[95vw] mt-8 px-4 lg:px-0">

  <!-- Left side: Balances, Transactions, Notifications -->
  <div class="flex flex-col gap-6 w-full lg:w-2/3">

    <!-- Total Balances -->
    <div class="bg-gradient-to-b from-[#2D2300CC] via-[#000000B3] to-[#000000B3] rounded-2xl shadow-lg p-4 md:p-6 text-[#E7AC08] min-h-[300px] md:min-h-[350px] flex flex-col justify-center">
      <div class="text-center">
        <p class="text-2xl md:text-3xl font-bold">${{ number_format($payoutAmount ?? 0, 2) }}</p>
        <p class="opacity-80 mt-2 text-xl md:text-3xl">Total Balance</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6 mt-8 md:mt-10">
        <div class="bg-black bg-opacity-40 p-3 md:p-4 rounded-lg text-center border border-yellow-600">
          <p class="text-xl md:text-2xl font-semibold">
            ${{ number_format($customer->available_balance ?? 0, 2) }}
          </p>
          <p class="text-yellow-400 opacity-80 mt-1 text-sm md:text-base">Available Balance</p>
        </div>
        <div class="bg-black bg-opacity-40 p-3 md:p-4 rounded-lg text-center border border-yellow-600">
          <p class="text-xl md:text-2xl font-semibold">
            ${{ number_format($customer->pending_balance ?? 0, 2) }}
          </p>
          <p class="text-yellow-400 opacity-80 mt-1 text-sm md:text-base">Pending Balance</p>
        </div>
      </div>

      <div class="text-center mt-4 text-yellow-400 text-sm">
        Currency: <strong>{{ $customer->currency ?? 'USD' }}</strong>
      </div>
    </div>

    <!-- Transactions + Notifications -->
    <div class="flex flex-col md:flex-row gap-6">

      <!-- Transaction History -->
      <div class="bg-[#1e1e1e] rounded-2xl shadow-lg p-4 md:p-6 text-yellow-300 w-full md:w-2/3 max-h-[400px]">
        <h3 class="text-lg md:text-xl font-semibold mb-4">Transaction History</h3>

        <!-- Mobile: Stack layout -->
        <div class="block md:hidden space-y-3 overflow-y-auto max-h-[300px]">
          @forelse ($transactions as $transaction)
            <div class="bg-black bg-opacity-30 p-3 rounded-lg border-l-4
              @if(strtolower($transaction->status) === 'completed') border-yellow-500
              @elseif(strtolower($transaction->status) === 'pending') border-yellow-400
              @elseif(strtolower($transaction->status) === 'failed') border-red-500
              @else border-yellow-300
              @endif
            ">
              <div class="flex justify-between items-center mb-2">
                <span class="font-semibold text-sm
                  @if(strtolower($transaction->status) === 'completed') text-yellow-500
                  @elseif(strtolower($transaction->status) === 'pending') text-yellow-400
                  @elseif(strtolower($transaction->status) === 'failed') text-red-500
                  @else text-yellow-300
                  @endif
                ">
                  {{ ucfirst($transaction->status) }}
                </span>
                <span class="text-xs text-yellow-400">
                  {{ \Carbon\Carbon::parse($transaction->date)->format('M d') }}
                </span>
              </div>
              <div class="text-xs text-yellow-300">
                <div class="mb-1">{{ $transaction->from }} → {{ $transaction->to }}</div>
              </div>
            </div>
          @empty
            <div class="text-center py-4 text-yellow-600">
              <p>No transactions found.</p>
            </div>
          @endforelse
        </div>

        <!-- Desktop: Table layout (unchanged) -->
        <div class="hidden md:block overflow-x-auto">
          <table class="min-w-full table-fixed">
            <thead>
              <tr class="border-b border-yellow-600">
                <th class="py-2 px-3 text-left text-yellow-400">Status</th>
                <th class="py-2 px-3 text-left text-yellow-400">Date</th>
                <th class="py-2 px-3 text-left text-yellow-400">From</th>
                <th class="py-2 px-3 text-left text-yellow-400">To</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($transactions as $transaction)
                <tr class="border-b border-yellow-700 hover:bg-yellow-700/30">
                  <td class="py-2 px-3">
                    <span class="font-semibold
                      @if(strtolower($transaction->status) === 'completed') text-green-500
                      @elseif(strtolower($transaction->status) === 'pending') text-yellow-400
                      @elseif(strtolower($transaction->status) === 'failed') text-red-500
                      @else text-yellow-300
                      @endif
                    ">
                      {{ ucfirst($transaction->status) }}
                    </span>
                  </td>
                  <td class="py-2 px-3">{{ \Carbon\Carbon::parse($transaction->date)->format('M d') }}</td>
                  <td class="py-2 px-3">{{ $transaction->from }}</td>
                  <td class="py-2 px-3">{{ $transaction->to }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="4" class="text-center py-4 text-yellow-600">No transactions found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      <!-- Notifications -->
      <div class="bg-[#1e1e1e] rounded-2xl shadow-lg p-4 md:p-6 text-yellow-300 w-full md:w-1/3">
        <h3 class="font-semibold text-lg md:text-xl mb-3 flex items-center gap-2">
          Notifications
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </h3>
        <p class="text-sm md:text-base">Your account has been flagged for large transactions.</p>
        <p class="mt-3 font-bold text-yellow-400 text-sm md:text-base">To proceed, a mandatory clearance payment is required before your full balance can be released.</p>
      </div>

    </div>
  </div>

  <!-- Right side: Profile -->
  <div class="w-full lg:w-1/3 flex flex-col gap-6">
    <div class="bg-gradient-to-b from-[#2D2300CC] via-[#000000B3] to-[#000000B3] rounded-2xl shadow-lg p-4 md:p-6 text-[#E7AC08] flex flex-col items-center min-h-[500px] md:min-h-[640px]">
      <img src="{{ asset('user.JPG') }}" alt="User profile" class="w-16 h-16 md:w-20 md:h-20 rounded-full mb-3 border-2 border-yellow-500 object-cover" />
      <h3 class="text-xl md:text-2xl font-semibold mb-1 text-center">{{ Auth::user()->name ?: Auth::user()->customer_id }}</h3>
      <p class="opacity-70 mb-1 text-sm md:text-base">Quantum ID. {{ Auth::user()->id }}</p>
      <p class="opacity-70 mb-4 text-sm md:text-base">Member Since {{ Auth::user()->created_at->format('F j, Y') }}</p>
      <p class="opacity-70 mb-4 text-sm md:text-base">Quantum member</p>
      <div class="flex justify-center mt-4 md:mt-12">
        <img src="{{ asset('verified.PNG') }}" alt="Verification Badge" class="h-40 md:h-60 mt-4 md:mt-12 object-contain" />
      </div>
    </div>
  </div>

</div>

@endsection
