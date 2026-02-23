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
    <nav class="bg-white shadow-lg border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('blog.home') }}" class="flex items-center space-x-2">
                        <i class="fa-solid fa-blog text-2xl text-indigo-600"></i>
                        <span class="font-bold text-xl text-gray-800">BlogSpace</span>
                    </a>
                </div>


                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center sm:space-x-8">

                   @if(Auth::check() && Auth::user()->role=='admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                                       {{ request()->routeIs('admin.dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600 -mb-[4px]' : 'text-gray-700' }}">
                            Admin Dashboard
                        </a>
                        <a href="{{ route('admin.articles.approve') }}" class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                                       {{ request()->routeIs('admin.articles.approve') ? 'text-indigo-600 border-b-2 border-indigo-600 -mb-[4px]' : 'text-gray-700' }}">
                            Articles Approve
                        </a>
                        <a href="{{ route('admin.categories') }}" class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                                       {{ request()->routeIs('admin.categories.*') || request()->routeIs('admin.categories') ?'text-indigo-600 border-b-2 border-indigo-600 -mb-[4px]' : 'text-gray-700' }}">
                            Categories
                        </a>
                        <a href="{{ route('admin.users') }}" class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                                       {{ request()->routeIs('admin.users') ? 'text-indigo-600 border-b-2 border-indigo-600 -mb-[4px]' : 'text-gray-700' }}">
                            Users
                        </a>
                        <a href="{{ route('admin.settings') }}" class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                                       {{ request()->routeIs('admin.settings') ? 'text-indigo-600 border-b-2 border-indigo-600 -mb-[4px]' : 'text-gray-700' }}">
                            Settings
                        </a>
                        <a href="{{ route('admin.messages') }}" class="px-3 py-2 text-sm font-medium transition hover:text-indigo-600
                                       {{ request()->routeIs('admin.messages') ? 'text-indigo-600 border-b-2 border-indigo-600 -mb-[4px]' : 'text-gray-700' }}">
                            User Messages
                        </a>
                        <a href=""></a>
                    @endif

                       
                   

                    


                </div>
                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    @auth
                        <!-- Notifications -->
                        <button class="text-gray-600 hover:text-indigo-600 relative">
                            <i class="fa-regular fa-bell text-xl"></i>
                            <span
                                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">3</span>
                        </button>

                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                class="flex items-center space-x-2 text-gray-700 hover:text-indigo-600">
                                <img src="{{ Auth::user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                    alt="Avatar" class="h-8 w-8 rounded-full border-2 border-indigo-200">
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 border">
                                @if(Auth::user()->is_author)
                                    <a href="{{ route('author.dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Dashboard</a>
                                    <a href="{{ route('author.posts.create') }}"
                                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Write Post</a>
                                @endif
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-gray-700 hover:text-indigo-600 px-3 py-2 text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">Sign
                            Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
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
        {{$slot}}
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">About</h3>
                    <p class="mt-4 text-gray-500 text-sm">BlogSpace is a platform for sharing ideas, stories, and
                        insights with the world.</p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Quick Links</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="{{ route('blog.home') }}"
                                class="text-gray-500 hover:text-indigo-600 text-sm">Home</a></li>
                        <li><a href="{{ route('blog.articles') }}"
                                class="text-gray-500 hover:text-indigo-600 text-sm">Articles</a></li>
                        <li><a href="{{ route('blog.categories') }}"
                                class="text-gray-500 hover:text-indigo-600 text-sm">Categories</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Categories</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-gray-500 hover:text-indigo-600 text-sm">Technology</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-indigo-600 text-sm">Lifestyle</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-indigo-600 text-sm">Travel</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-indigo-600 text-sm">Food</a></li>
                    </ul>
                </div>

                <!-- Follow Us -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Follow Us</h3>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-indigo-600"><i
                                class="fa-brands fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600"><i
                                class="fa-brands fa-facebook text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600"><i
                                class="fa-brands fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600"><i
                                class="fa-brands fa-linkedin text-xl"></i></a>
                    </div>
                </div>
            </div>

            <div class="mt-8 border-t border-gray-200 pt-8">
                <p class="text-gray-400 text-sm text-center">&copy; {{ date('Y') }} BlogSpace. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>

</html>