@extends('layouts.blog')

@section('title', $post->title ?? 'Article - BlogSpace')

@section('content')
<!-- Article Header -->
<div class="bg-white border-b border-gray-200">
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="mb-6">
            <a href="{{ route('blog.articles') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Articles
            </a>
        </div>

        <h1 class="text-4xl font-bold text-gray-900 mb-4">The Future of Web Development: Trends to Watch in 2024</h1>
        
        <div class="flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center">
                <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Author" class="h-12 w-12 rounded-full">
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-900">John Doe</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span>Published on Jan 15, 2024</span>
                        <span class="mx-2">•</span>
                        <span>8 min read</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <button class="text-gray-500 hover:text-red-500">
                    <i class="fa-regular fa-heart text-xl"></i>
                    <span class="ml-1">24</span>
                </button>
                <button class="text-gray-500 hover:text-indigo-600">
                    <i class="fa-regular fa-bookmark text-xl"></i>
                </button>
                <button class="text-gray-500 hover:text-indigo-600">
                    <i class="fa-regular fa-share-from-square text-xl"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Article Content -->
<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Featured Image -->
    <img src="https://via.placeholder.com/1200x600" alt="Featured Image" class="w-full h-96 object-cover rounded-lg shadow-lg mb-8">

    <!-- Article Body -->
    <article class="prose prose-lg max-w-none">
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>

        <h2>Introduction</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

        <h2>Key Trends in 2024</h2>
        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

        <ul>
            <li><strong>Artificial Intelligence:</strong> AI-powered development tools and code assistants</li>
            <li><strong>WebAssembly:</strong> High-performance applications in the browser</li>
            <li><strong>Serverless Architecture:</strong> Scalable and cost-effective solutions</li>
            <li><strong>Progressive Web Apps:</strong> Native-like experiences on the web</li>
        </ul>

        <h2>The Rise of AI in Development</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

        <blockquote>
            <p>"The future of web development lies in the seamless integration of AI tools that augment developer capabilities rather than replace them."</p>
            <cite>- Jane Smith, Tech Lead at Company</cite>
        </blockquote>

        <h2>Conclusion</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </article>

    <!-- Tags -->
    <div class="mt-8 pt-8 border-t border-gray-200">
        <div class="flex flex-wrap gap-2">
            <span class="text-sm text-gray-600 mr-2">Tags:</span>
            <a href="#" class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-indigo-100 hover:text-indigo-700">#webdevelopment</a>
            <a href="#" class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-indigo-100 hover:text-indigo-700">#technology</a>
            <a href="#" class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-indigo-100 hover:text-indigo-700">#trends2024</a>
            <a href="#" class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-indigo-100 hover:text-indigo-700">#ai</a>
        </div>
    </div>

    <!-- Author Bio -->
    <div class="mt-8 bg-gray-50 rounded-lg p-6">
        <div class="flex items-start">
            <img src="https://ui-avatars.com/api/?name=John+Doe" alt="Author" class="h-16 w-16 rounded-full">
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">About John Doe</h3>
                <p class="text-gray-600 mt-1">John is a senior web developer with over 10 years of experience. He specializes in JavaScript frameworks and loves sharing knowledge through writing and speaking at conferences.</p>
                <div class="mt-3 flex space-x-3">
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="text-gray-400 hover:text-indigo-600"><i class="fa-brands fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div class="mt-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Comments (12)</h3>

        <!-- Comment Form -->
        @auth
        <form class="mb-8">
            <textarea rows="4" placeholder="Leave a comment..." class="w-full rounded-lg border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            <button type="submit" class="mt-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Post Comment</button>
        </form>
        @else
        <div class="bg-gray-50 rounded-lg p-6 text-center mb-8">
            <p class="text-gray-600">Please <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800">login</a> to leave a comment.</p>
        </div>
        @endauth

        <!-- Comments List -->
        <div class="space-y-6">
            @for($i = 1; $i <= 3; $i++)
            <div class="flex space-x-4">
                <img src="https://ui-avatars.com/api/?name=User+{{ $i }}" alt="User" class="h-10 w-10 rounded-full">
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <h4 class="font-semibold text-gray-900">User {{ $i }}</h4>
                        <span class="text-sm text-gray-500">2 days ago</span>
                    </div>
                    <p class="text-gray-600 mt-1">Great article! Really enjoyed reading about the future trends in web development. Looking forward to more content like this.</p>
                    <button class="text-sm text-indigo-600 hover:text-indigo-800 mt-2">Reply</button>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
@endsection