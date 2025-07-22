<header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 relative">
            <!-- Logo -->
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <img src="{{ asset('images/logo.png') }}" alt="AllKenyans.tech" class="h-10 w-auto sm:h-12 transition-transform duration-200 hover:scale-105">
                        <span class="ml-2 text-lg sm:text-xl font-bold text-gray-900 hidden sm:inline">AllKenyans.tech</span>
                    </a>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard.home') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
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
                    <form method="POST" action="{{ route('logout') }}" class="inline">
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
                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                        Sign up
                    </a>
                @endguest

                <!-- Dark Mode Toggle -->
                <div class="ml-2 border-l border-gray-200 pl-4">
                    <x-dark-mode-toggle class="w-8 h-8 hover:bg-gray-100 rounded-lg transition-colors duration-200"/>
                </div>
            </div>
        </div>
    </div>
</header>
