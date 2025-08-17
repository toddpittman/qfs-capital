<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Sora', sans-serif;
            background: #000000; /* solid black background */
            color: #E7AC08;

            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        a {
            color: #E7AC08;
            text-decoration: none;
        }
        a:hover {
            color: #c69c06;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: transparent;
            font-weight: 600;
            font-size: 1.25rem;
        }
        main {
            width: 100%;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        button.btn, a.btn {
            background-color: #E7AC08;
            color: #1C1917;
            font-weight: 700;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        button.btn:hover, a.btn:hover {
            background-color: #c69c06;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            color: black;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.4);
            table-layout: fixed;
            word-wrap: break-word;
        }
        th, td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #ddd;
            text-align: left;
            white-space: normal;
            word-break: break-word;
            vertical-align: middle;
        }
        th {
            background: #f9f5e1;
            color: #5a4c1a;
        }
        tr:hover {
            background-color: #fff7b3;
        }
    </style>
</head>
<body>

<header class="flex justify-between items-center p-4">
    <!-- Left side: Title -->
    <div>
        <a href="{{ route('customers.index') }}" class="text-yellow-800 font-semibold hover:text-yellow-600">
            Admin Panel
        </a>
    </div>

    <!-- Center: Buttons with background -->
    <div class="flex gap-4 justify-center flex-1">
        <a href="{{ route('customers.create') }}" class="btn">Add New Customer</a>
        <a href="{{ route('admin.history.index') }}" class="btn">History</a>
        <a href="{{ route('admin.customer_balance.index') }}" class="btn">
            Customer Balance
        </a>
    </div>

    <!-- Right side: Logout as text -->
    <div>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-yellow-800 font-semibold hover:text-yellow-600 ml-4 bg-transparent border-none p-0 cursor-pointer">
                Logout
            </button>
        </form>
    </div>
</header>

<main>
    @yield('content')
</main>

</body>
</html>
