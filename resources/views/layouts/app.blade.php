<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100">
    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                </div>

                <div class="flex items-center">
                    @auth
                        <a href="{{ route('dashboard.blocked') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Dashboard
                        </a>
                        <a href="{{ route('report.create') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Report Account
                        </a>
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.reports') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                                Admin Reports
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline ml-3">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                                Logout
                            </button>
                        </form>
                    @endauth
                    
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                            Sign in
                        </a>
                        <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Sign up
                        </a>
                        <a href="{{ route('auth.google') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24">
                                <path d="M12.545,12.151L12.545,12.151c0,1.054,0.849,1.913,1.912,1.913h3.825c0.353,0.688,0.551,1.465,0.551,2.286c0,2.837-2.3,5.141-5.137,5.141c-2.838,0-5.137-2.304-5.137-5.141c0-2.836,2.299-5.141,5.137-5.141c1.152,0,2.213,0.386,3.074,1.028l1.325-1.325C16.555,9.512,14.839,8.811,12.995,8.811c-4.045,0-7.317,3.274-7.317,7.319s3.272,7.317,7.317,7.317c4.045,0,7.317-3.272,7.317-7.317c0-0.49-0.048-0.967-0.139-1.428h-7.628V12.151z" fill="currentColor"/>
                            </svg>
                            Sign in with Google
                        </a>
                    @endguest
                </div>
                </div>
            </div>
        </div>
    </nav>

    <main class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>
</body>
</html>
