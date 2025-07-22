<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="AllKenyans.tech" class="h-8 w-auto">
                        <span class="ml-2 text-xl font-bold text-gray-900 dark:text-white">AllKenyans.tech</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:ml-10 sm:flex">
                    @auth
                        <a href="{{ route('dashboard.home') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Dashboard
                        </a>
                    @endauth
                </div>
            </div>

            <div class="flex items-center">
                @auth
                    <span class="text-gray-600 dark:text-gray-300 px-3 py-2 text-sm">
                        {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        Sign in
                    </a>
                    <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Sign up
                    </a>
                @endauth

                <!-- Dark Mode Toggle -->
                <div class="ml-4 border-l border-gray-200 dark:border-gray-700 pl-4">
                    <x-dark-mode-toggle />
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div class="sm:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
            @auth
                <a href="{{ route('dashboard.home') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block w-full text-left px-3 py-2 rounded-md text-base font-medium">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                    Sign in
                </a>
                <a href="{{ route('register') }}" class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                    Sign up
                </a>
            @endauth
        </div>
    </div>
</nav>
