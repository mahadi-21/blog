<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Blog'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg border-b border-gray-200" x-data="{ mobileMenuOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
               @php
                    // Get all settings and convert to key-value array
                    $settingsCollection = \App\Models\Setting::all();
                    $settings = [];

                    foreach ($settingsCollection as $setting) {
                        $settings[$setting->key] = $setting->value;
                    }

                    // Set defaults to prevent undefined index errors
                    $generalSettings = $settings['general'] ?? [
                        'site_name' => 'My Blog',
                        'site_email' => '',
                        'site_phone' => '',
                        'site_description' => '',
                    ];

                    $appearanceSettings = $settings['appearance'] ?? [
                        'site_logo' => '',
                        'site_favicon' => '',
                    ];
                @endphp
                
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2">
                        @if(!empty($appearanceSettings['site_logo']))
                            <img src="{{ asset($appearanceSettings['site_logo']) }}" 
                                 alt="{{ $generalSettings['site_name'] }}" 
                                 class="h-12 w-auto">
                                 <span class="font-bold text-xl text-gray-800">
                                {{ $generalSettings['site_name'] }}
                            </span>
                        @else
                            <span class="font-bold text-xl text-gray-800">
                                {{ $generalSettings['site_name'] }}
                            </span>
                        @endif
                    </a>
                </div>


                <!-- Desktop Navigation Links -->
                <div class="hidden md:flex md:items-center md:space-x-8">
                    @if(Auth::check() && Auth::user()->role=='admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                            {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-700' }}">
                            <i class="fa-solid fa-gauge mr-1"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.articles.approve') }}" 
                            class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                            {{ request()->routeIs('admin.articles.approve') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-700' }}">
                            <i class="fa-solid fa-check-circle mr-1"></i> Approve
                        </a>
                        <a href="{{ route('admin.categories') }}" 
                            class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                            {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.categories') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-700' }}">
                            <i class="fa-solid fa-tags mr-1"></i> Categories
                        </a>
                        <a href="{{ route('admin.users') }}" 
                            class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                            {{ request()->routeIs('admin.users') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-700' }}">
                            <i class="fa-solid fa-users mr-1"></i> Users
                        </a>
                        <a href="{{ route('admin.settings') }}" 
                            class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                            {{ request()->routeIs('admin.settings') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-700' }}">
                            <i class="fa-solid fa-gear mr-1"></i> Settings
                        </a>
                        <a href="{{ route('admin.messages') }}" 
                            class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                            {{ request()->routeIs('admin.messages') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-700' }}">
                            <i class="fa-solid fa-envelope mr-1"></i> Messages
                        </a>
                    @endif
                </div>

                <!-- User Menu & Mobile Menu Button -->
                <div class="flex items-center space-x-4">
                    <!-- User Dropdown (Desktop) -->
                    @auth
                        <div class="relative hidden md:block" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600">
                                <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                    alt="Avatar" class="h-8 w-8 rounded-full border-2 border-indigo-200">
                                <span class="hidden lg:inline">{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 border"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 transform scale-95"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-95">
                                @if(Auth::user()->is_author)
                                    <a href="{{ route('author.dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                                        <i class="fa-solid fa-pen mr-2"></i> Author Dashboard
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                        <i class="fa-solid fa-sign-out-alt mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="hidden md:flex items-center space-x-4">
                            <a href="{{ route('login') }}"
                                class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}"
                                class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">Sign Up</a>
                        </div>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-700 hover:text-indigo-600 focus:outline-none">
                        <i class="fa-solid fa-bars text-2xl" x-show="!mobileMenuOpen"></i>
                        <i class="fa-solid fa-times text-2xl" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak
             class="md:hidden bg-white border-t border-gray-200 shadow-lg"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2">
            
            <!-- User Info in Mobile -->
            @auth
                <div class="px-4 py-3 border-b border-gray-200 bg-gray-50">
                    <div class="flex items-center space-x-3">
                        <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                             alt="Avatar" class="h-10 w-10 rounded-full border-2 border-indigo-200">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            @if(Auth::user()->role)
                                <span class="inline-block mt-1 text-xs px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full">
                                    {{ ucfirst(Auth::user()->role) }}
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="px-4 py-3 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="flex-1 text-center bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                            <i class="fa-solid fa-sign-in-alt mr-2"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="flex-1 text-center bg-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-300 transition">
                            <i class="fa-solid fa-user-plus mr-2"></i> Sign Up
                        </a>
                    </div>
                </div>
            @endauth

            <!-- Mobile Navigation Links -->
            @if(Auth::check() && Auth::user()->role=='admin')
                <div class="px-4 py-3 space-y-1">
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-gauge mr-3 w-5"></i> Dashboard
                    </a>

                    <a href="{{ route('admin.articles.approve') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.articles.approve') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-check-circle mr-3 w-5"></i> Articles Approve
                    </a>

                    <a href="{{ route('admin.categories') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.categories') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-tags mr-3 w-5"></i> Categories
                    </a>

                    <a href="{{ route('admin.users') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.users') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-users mr-3 w-5"></i> Users
                    </a>

                    <a href="{{ route('admin.settings') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.settings') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-gear mr-3 w-5"></i> Settings
                    </a>

                    <a href="{{ route('admin.messages') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium {{ request()->routeIs('admin.messages') ? 'text-indigo-600 bg-indigo-50' : 'text-gray-700 hover:text-indigo-600 hover:bg-gray-50' }}">
                        <i class="fa-solid fa-envelope mr-3 w-5"></i> Messages
                    </a>
                </div>
            @endif

            <!-- Author Links in Mobile (if author) -->
            @if(Auth::check() && Auth::user()->is_author)
                <div class="px-4 py-3 border-t border-gray-200">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-wider px-3 mb-2">Author Tools</h3>
                    <a href="{{ route('author.dashboard') }}"
                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">
                        <i class="fa-solid fa-pen mr-3 w-5"></i> Author Dashboard
                    </a>
                </div>
            @endif

            <!-- Logout Button in Mobile -->
            @auth
                <div class="px-4 py-3 border-t border-gray-200">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-red-600 hover:text-red-700 hover:bg-red-50">
                            <i class="fa-solid fa-sign-out-alt mr-3 w-5"></i> Logout
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md flex justify-between items-center" role="alert">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-check text-green-500 mr-3 text-xl"></i>
                    <p>{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-700 hover:text-green-900">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md flex justify-between items-center" role="alert">
                <div class="flex items-center">
                    <i class="fa-solid fa-circle-exclamation text-red-500 mr-3 text-xl"></i>
                    <p>{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-700 hover:text-red-900">
                    <i class="fa-solid fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if($errors->any())
        <div class="max-w-7xl mx-auto mt-4 px-4 sm:px-6 lg:px-8" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-md" role="alert">
                <div class="flex items-center mb-2">
                    <i class="fa-solid fa-exclamation-triangle text-yellow-500 mr-3 text-xl"></i>
                    <p class="font-medium">Please fix the following errors:</p>
                </div>
                <ul class="list-disc list-inside ml-6 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">About</h3>
                    <p class="mt-4 text-gray-500 text-sm">{{$settings['general']['site_description']}}</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Quick Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="{{ route('admin.dashboard') }}"
                                class="text-gray-500 hover:text-indigo-600 text-sm flex items-center">
                                <i class="fa-solid fa-gauge mr-2"></i> Dashboard
                            </a>
                        </li>
                        <li><a href="{{ route('admin.articles.approve') }}"
                                class="text-gray-500 hover:text-indigo-600 text-sm flex items-center">
                                <i class="fa-solid fa-check-circle mr-2"></i> Articles Approval
                            </a>
                        </li>
                        <li><a href="{{ route('admin.categories') }}"
                                class="text-gray-500 hover:text-indigo-600 text-sm flex items-center">
                                <i class="fa-solid fa-tags mr-2"></i> Categories
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Follow Us -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Follow Us</h3>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition">
                            <i class="fa-brands fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition">
                            <i class="fa-brands fa-facebook text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition">
                            <i class="fa-brands fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition">
                            <i class="fa-brands fa-linkedin text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-8">
                <p class="text-gray-400 text-sm text-center">&copy; {{ date('Y') }} BlogSpace. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</body>
</html>