@extends('layouts.blog')

@section('title', 'Articles - BlogSpace')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-l from-blue-900 to-cyan-700 border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8  rounded-lg">
            <h1 class="text-4xl font-bold text-white">All Articles</h1>
            <p class="mt-2 text-lg text-cyan-100">
                Browse our latest articles and updates
            </p>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Search -->
            <div class="flex-1 max-w-lg">
                <form action="{{ route('blog.articles') }}" method="GET" class="flex">
                    <input type="text" name="search" placeholder="Search articles..." value="{{ request('search') }}"
                        class="flex-1 rounded-l-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <button type="submit" class="bg-indigo-600 text-white px-4 rounded-r-lg hover:bg-indigo-700">
                        <i class="fa-solid fa-search"></i>
                    </button>
                </form>
            </div>

            <!-- Category Filter -->
            <div class="flex items-center space-x-2">
                <select name="category"
                    class="rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">All Categories</option>
                    <option value="technology">Technology</option>
                    <option value="lifestyle">Lifestyle</option>
                    <option value="travel">Travel</option>
                    <option value="food">Food</option>
                </select>

                <select name="sort"
                    class="rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="latest">Latest</option>
                    <option value="popular">Most Popular</option>
                    <option value="oldest">Oldest</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Articles Grid -->
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $i => $post)
                <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                    <img src="{{ asset($post->featured_image) }}" alt="Article {{ $i }}"
                        class="w-full h-[200px] px-4 py-3 object-cover">

                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            @php
                                if (!function_exists('calculateReadingTime')) {
                                    function calculateReadingTime($content)
                                    {
                                        $words = str_word_count(strip_tags($content));
                                        $minutes = ceil($words / 200); // Average reading speed: 200 words per minute
                                        return $minutes . ' min read';
                                    }
                                }
                            @endphp

                            <!-- Then use it: -->
                            <span>{{ calculateReadingTime($post->content) }}</span>
                        </div>

                        <h2 class="text-xl font-semibold text-gray-900 mb-2">
                            <a href="" class="hover:text-indigo-600">
                                {{ $post->title }}
                            </a>
                        </h2>

                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($post->content, 150) }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">

                                <span class="ml-2 text-sm text-gray-700">{{ $post->author->name }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fa-regular fa-heart mr-1"></i> 24
                                <i class="fa-regular fa-comment ml-3 mr-1"></i> 12
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            <nav class="flex justify-center">
                {{ $posts->links() }}
            </nav>
        </div>
    </div>
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-indigo-700 rounded-2xl shadow-xl overflow-hidden">
            <div class="px-6 py-12 sm:px-12 lg:py-16 lg:px-16">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <div>
                        <h2 class="text-3xl font-bold text-white">Stay Updated</h2>
                        <p class="mt-4 text-indigo-100 text-lg">
                            Get notified when we publish new articles in your favorite categories.
                        </p>
                    </div>
                    <div>
                        <form class="sm:flex">
                            <input type="email" placeholder="Enter your email"
                                class="w-full px-5 py-3 border border-transparent rounded-md text-base focus:outline-none focus:ring-2 focus:ring-white">
                            <button type="submit"
                                class="mt-3 sm:mt-0 sm:ml-3 w-full sm:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-white">
                                Subscribe
                            </button>
                        </form>
                        <p class="mt-3 text-xs text-indigo-200">
                            We respect your privacy. Unsubscribe at any time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection