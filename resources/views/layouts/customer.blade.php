<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Customer Dashboard')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            font-family: 'Sora', sans-serif;
            background: linear-gradient(180deg, rgba(45,35,0,0.9) 0%, rgba(0,0,0,0.7) 100%);
            color: #E7AC08;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
        }
        a, button {
            font-family: 'Sora', sans-serif;
        }
        a {
            color: #E7AC08;
            text-decoration: none;
        }
        a:hover {
            color: #c69c06;
        }
        nav {
            background: transparent;
            font-weight: 600;
            font-size: 1.125rem;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        nav .left img {
            height: 25px;
            width: auto;
        }
        nav .left span {
            color: white;
            font-weight: normal;
            font-size: 1rem;
            cursor: pointer;
        }
        nav .menu-button {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: #E7AC08;
        }
        nav .menu {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        nav .menu a.btn, nav .menu button.btn {
            background-color: #E7AC08;
            color: #1C1917;
            font-weight: 200;
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 6px rgba(231, 172, 8, 0.5);
            font-size: 1rem;
            letter-spacing: 0.03em;
        }
        nav .menu a.btn:hover, nav .menu button.btn:hover {
            background-color: #E7AC08;
            box-shadow: 0 4px 12px rgba(198, 156, 6, 0.7);
        }
        nav .right form {
            margin: 0;
        }
        nav .right button.logout-btn {
            background: none;
            border: none;
            color: #E7AC08;
            font-weight: 400;
            font-size: 1rem;
            cursor: pointer;
            padding: 0;
            transition: color 0.3s ease;
        }
        nav .right button.logout-btn:hover {
            color: #c69c06;
            text-decoration: underline;
        }
        main {
            flex-grow: 1;
            max-width: 95vw;
            margin: 2rem auto;
            padding: 0 1rem;
            box-sizing: border-box;
        }

        /* Mobile styles */
        @media (max-width: 768px) {
            nav .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                right: 0;
                background: rgba(0,0,0,0.9);
                padding: 1rem 2rem;
                border-radius: 0 0 12px 12px;
                box-shadow: 0 8px 15px rgba(0,0,0,0.5);
                z-index: 50;
            }
            nav .menu.show {
                display: flex;
            }
            nav .menu-button {
                display: block;
            }
            nav .center {
                margin-left: 0 !important;
            }
        }
    </style>
</head>
<body x-data="{ menuOpen: false }">
    <nav>
        <div class="left">
            <img src="{{ asset('logomark-colored.png') }}" alt="QFS Logo" @click="window.location='{{ route('dashboard') }}'" />
            <span @click="window.location='{{ route('dashboard') }}'">Quantum Financial System</span>
        </div>

        <div class="menu-button" @click="menuOpen = !menuOpen">
            <svg x-show="!menuOpen" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="menuOpen" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <div :class="{'menu show': menuOpen, 'menu': !menuOpen}" class="menu center">
            <a href="{{ route('invest.page') }}" class="btn">Invest</a>
            <a href="{{ route('withdraw.page') }}" class="btn">Withdraw</a>
        </div>

        <div class="right">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
