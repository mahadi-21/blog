@extends('layouts.blog')

@section('title', 'Home - BlogSpace')

@section('content')
<!-- Hero Section -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">
                Welcome to BlogSpace
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-xl">
                Discover stories, thinking, and expertise from writers on any topic.
            </p>
            <div class="mt-10">
                <a href="{{ route('blog.articles') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 transition">
                    Start Reading
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Featured Posts -->
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900">Featured Articles</h2>
        <p class="mt-4 text-gray-600">Hand-picked articles for you</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach($featuredPosts ?? [] as $post)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
            <img src="{{ $post->image ?? 'https://via.placeholder.com/400x200' }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
            <div class="p-6">
                <div class="flex items-center text-sm text-gray-500 mb-2">
                    <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded">{{ $post->category }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 100) }}</p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ $post->author->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($post->author->name) }}" class="h-8 w-8 rounded-full mr-2">
                        <span class="text-sm text-gray-700">{{ $post->author->name }}</span>
                    </div>
                    <a href="{{ route('blog.post', $post->slug) }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Read More →</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Popular Categories -->
<div class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Popular Categories</h2>
            <p class="mt-4 text-gray-600">Explore articles by topic</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach(['Technology', 'Lifestyle', 'Travel', 'Food', 'Health', 'Business', 'Sports', 'Entertainment'] as $category)
            <a href="#" class="bg-white rounded-lg p-6 text-center hover:shadow-md transition group">
                <i class="fa-solid fa-{{ $category === 'Technology' ? 'laptop-code' : 'tag' }} text-3xl text-indigo-600 mb-3"></i>
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">{{ $category }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ rand(10, 50) }} articles</p>
            </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Newsletter -->
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="bg-indigo-700 rounded-2xl shadow-xl overflow-hidden">
        <div class="px-6 py-12 sm:px-12 lg:py-16 lg:px-16 text-center">
            <h2 class="text-3xl font-bold text-white">Subscribe to Our Newsletter</h2>
            <p class="mt-4 text-indigo-100 text-lg">Get the latest posts delivered right to your inbox.</p>
            <form class="mt-8 sm:flex justify-center">
                <input type="email" placeholder="Enter your email" class="w-full sm:w-96 px-5 py-3 border border-transparent rounded-md text-base focus:outline-none focus:ring-2 focus:ring-white">
                <button type="submit" class="mt-3 sm:mt-0 sm:ml-3 w-full sm:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 focus:outline-none focus:ring-2 focus:ring-white">
                    Subscribe
                </button>
            </form>
        </div>
    </div>
</div>
@endsection