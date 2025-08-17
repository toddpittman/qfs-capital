<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Transaction;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CustomerBalanceController;

Route::get('/', fn() => redirect('/login'));

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') return redirect('/admin-dashboard');

    $user = Auth::user();
    $customer = $user->customer;
    $payoutAmount = $customer?->payout_amount ?? 0;
    $transactions = Transaction::where('customer_id', $user->customer_id)->latest()->get();

    return view('dashboard', compact('payoutAmount', 'transactions', 'user', 'customer'));
})->middleware(['auth'])->name('dashboard');

// ✅ Admin Dashboard — using direct middleware class reference
Route::get('/admin-dashboard', function (Request $request) {
    $query = $request->input('search');
    $customers = Customer::when($query, fn($q) => $q->where('customer_id', 'like', "%{$query}%"))->paginate(10);

    return view('admin.dashboard', compact('customers'));
})->middleware(['auth', \App\Http\Middleware\IsAdmin::class])->name('admin.dashboard');

// ✅ Admin > Customer Balance & History - using direct middleware class reference
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/customer-balance', [CustomerBalanceController::class, 'index'])->name('customer_balance.index');
    Route::post('/customer-balance', [CustomerBalanceController::class, 'store'])->name('customer_balance.store');
    Route::put('/customer-balance/{id}', [CustomerBalanceController::class, 'update'])->name('customer_balance.update');

    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/history/create', [HistoryController::class, 'create'])->name('history.create');
    Route::post('/history', [HistoryController::class, 'store'])->name('history.store');
    Route::get('/history/{transaction}/edit', [HistoryController::class, 'edit'])->name('history.edit');
    Route::put('/history/{transaction}', [HistoryController::class, 'update'])->name('history.update');
    Route::delete('/history/{transaction}', [HistoryController::class, 'destroy'])->name('history.destroy');
});

// ✅ Customer Routes
Route::middleware('auth')->group(function () {
    Route::resource('customers', CustomerController::class);
    Route::view('/invest', 'customers.invest')->name('invest.page');
    Route::view('/withdraw', 'customers.withdraw')->name('withdraw.page');
});

require __DIR__.'/auth.php';
