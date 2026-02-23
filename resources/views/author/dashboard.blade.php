@extends('layouts.blog')

@section('title', 'Author Dashboard - BlogSpace')

@section('content')
<!-- Dashboard Header -->
<div class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Author Dashboard</h1>
                <p class="mt-2 text-gray-600">Welcome back, {{ Auth::user()->name }}!</p>
            </div>
            <a href="{{ route('author.post.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                <i class="fa-solid fa-plus mr-2"></i>Write New Post
            </a>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Posts</p>
                    <p class="text-2xl font-bold text-gray-900">{{$total_posts}}</p>
                </div>
                <div class="bg-indigo-100 rounded-full p-3">
                    <i class="fa-solid fa-pen text-indigo-600"></i>
                </div>
            </div>
           
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Views</p>
                    <p class="text-2xl font-bold text-gray-900">12.5K</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fa-solid fa-eye text-green-600"></i>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">↑ 8% from last month</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Comments</p>
                    <p class="text-2xl font-bold text-gray-900">156</p>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fa-solid fa-comment text-yellow-600"></i>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">↑ 23% from last month</p>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Likes</p>
                    <p class="text-2xl font-bold text-gray-900">892</p>
                </div>
                <div class="bg-red-100 rounded-full p-3">
                    <i class="fa-solid fa-heart text-red-600"></i>
                </div>
            </div>
            <p class="text-sm text-green-600 mt-2">↑ 15% from last month</p>
        </div>
    </div>
</div>

<!-- Recent Posts -->
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Recent Posts</h2>
        </div>
        
        <div class="divide-y divide-gray-200">
            @foreach($posts as $i => $post)
            <div class="px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset($post->featured_image) }}" alt="Post thumbnail" class="h-12 w-12 rounded object-cover">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">{{ $post->title }}</h3>
                        <p class="text-xs text-gray-500">Published on {{ $post->created_at->format('M d, Y') }} • 2.5K views</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{ $post->status }}</span>
                    {{-- <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fa-solid fa-pen"></i></a> --}}
                    <form action="{{ route('author.post.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="text-gray-400 hover:text-red-600">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        
       
    </div>
</div>
@if ($rejected_posts > 0)


<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Rejected Posts</h2>
        </div>
        
        <div class="divide-y divide-gray-200">
            @foreach($rejected_posts as $i => $post)
            <div class="px-6 py-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset($post->featured_image) }}" alt="Post thumbnail" class="h-12 w-12 rounded object-cover">
                    <div>
                        <h3 class="text-sm font-medium text-gray-900">{{ $post->title }}</h3>
                        <p class="text-xs text-gray-500">Published on {{ $post->created_at->format('M d, Y') }} • 2.5K views</p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">{{ $post->status }}</span>
                    {{-- <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fa-solid fa-pen"></i></a> --}}
                    <form action="{{ route('author.post.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="text-gray-400 hover:text-red-600">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        
       
    </div>
</div>
@endif

@endsection