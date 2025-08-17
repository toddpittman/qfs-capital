<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Sora', sans-serif;
            background: linear-gradient(180deg, #2d2300 0%, #000000 100%);
        }
    </style>
</head>
<body class="relative min-h-screen flex items-center justify-center px-4">

    <!-- Logo top-left -->
    <div class="absolute top-5 left-5">
        <img src="{{ asset('logomark-colored.png') }}" alt="QFS Logo" class="h-8 w-auto" />
    </div>

    <div class="bg-black bg-opacity-90 rounded-xl shadow-lg p-10 w-full max-w-md">
        <h1 class="text-3xl font-semibold mb-6 text-[#E7AC08] text-center">Quantum Financial System</h1>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <label for="customer_id" class="block font-semibold text-white mb-1">Customer ID</label>
            <input id="customer_id" type="text" name="customer_id" required autofocus
                class="w-full mb-4 px-4 py-2 rounded focus:outline-none focus:ring-2
                @error('customer_id') border-red-500 ring-red-500 @else border-yellow-900 ring-yellow-600 @enderror"
                value="{{ old('customer_id') }}"
            />
            @error('customer_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label for="password" class="block font-semibold text-white mb-1">Password</label>
            <input id="password" type="password" name="password" required
                class="w-full mb-4 px-4 py-2 rounded focus:outline-none focus:ring-2
                @error('password') border-red-500 ring-red-500 @else border-yellow-900 ring-yellow-600 @enderror"
            />
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button type="submit"
                style="background-color: #E7AC08;"
                onmouseover="this.style.backgroundColor='#c69c06';"
                onmouseout="this.style.backgroundColor='#E7AC08';"
                class="w-full text-[#1C1917] font-bold py-3 rounded-full shadow-md transition duration-300">
                Log In
            </button>
        </form>
    </div>

</body>
</html>
