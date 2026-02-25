@extends('layouts.blog')

@section('title', 'Categories - BlogSpace')

@section('content')
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">
                    All Categories
                </h1>
                <p class="mt-6 max-w-2xl mx-auto text-xl">
                    Explore our diverse range of topics and find content that interests you
                </p>
            </div>
        </div>
    </div>
    

    <!-- Categories Grid -->
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
         <!-- Categories Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="bg-indigo-100 rounded-full p-3">
                        <i class="fa-solid fa-folder-open text-2xl text-indigo-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Categories</p>
                        <p class="text-2xl font-bold text-gray-900">{{$total_categories ?? 0}}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="bg-green-100 rounded-full p-3">
                        <i class="fa-solid fa-file-lines text-2xl text-green-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Articles</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $total_articles ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="bg-purple-100 rounded-full p-3">
                        <i class="fa-solid fa-users text-2xl text-purple-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Active Authors</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $active_authors ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="bg-yellow-100 rounded-full p-3">
                        <i class="fa-solid fa-eye text-2xl text-yellow-600"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Monthly Views</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($monthlyViews ?? 12500) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <form method="GET" action="{{ route('blog.categories') }}">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-6">

                <!-- Search -->
                <div class="w-full md:w-1/3 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories..."
                        class="w-full px-4 py-3 pl-12 border border-gray-300 rounded-lg">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-gray-400"></i>
                </div>

                <!-- Sort -->
                <div>
                    <select name="sort" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg px-4 py-2 text-sm">

                        <option value="">Sort by: Newest</option>

                        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>
                            Sort by: Popular
                        </option>

                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>
                            Sort by: Name
                        </option>

                        <option value="articles" {{ request('sort') == 'articles' ? 'selected' : '' }}>
                            Sort by: Articles Count
                        </option>

                    </select>
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Filter
                </button>
            </div>
        </form>

       
        <!-- All Categories -->
        <div>
            <div class="flex justify-center items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">All Categories</h2>
               
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('blog.articles', ['category' => $category->id]) }}"
                        class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition group">

                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="bg-indigo-100 rounded-lg p-3">
                                    <i class="fa-solid fa-folder text-2xl text-indigo-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">
                                        {{ $category->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        {{ $category->posts_count }} articles
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $categories->links() }}
        </div>
    </div>



    <!-- Newsletter Section -->


    @push('scripts')
        <script>
            // Category search functionality
            document.getElementById('categorySearch').addEventListener('keyup', function () {
                let searchTerm = this.value.toLowerCase();
                let categories = document.querySelectorAll('.grid > a');

                categories.forEach(category => {
                    let categoryName = category.querySelector('h3').textContent.toLowerCase();
                    if (categoryName.includes(searchTerm)) {
                        category.style.display = 'block';
                    } else {
                        category.style.display = 'none';
                    }
                });
            });
        </script>
    @endpush
@endsection