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
    <!-- Search and Filter -->
    <div class="mb-12">
        <div class="max-w-xl mx-auto">
            <div class="relative">
                <input type="text" 
                       placeholder="Search categories..." 
                       class="w-full px-4 py-3 pl-12 pr-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       id="categorySearch">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-gray-400"></i>
            </div>
        </div>
    </div>

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

    <!-- Featured Categories -->
    {{-- <div class="mb-12"> 
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Featured Categories</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($featuredCategories ?? [
                ['name' => 'Technology', 'icon' => 'laptop-code', 'color' => 'blue', 'count' => 42, 'description' => 'Latest in tech, programming, and digital innovation'],
                ['name' => 'Health & Wellness', 'icon' => 'heart-pulse', 'color' => 'red', 'count' => 38, 'description' => 'Tips for a healthier lifestyle and mental wellbeing'],
                ['name' => 'Travel', 'icon' => 'plane', 'color' => 'green', 'count' => 29, 'description' => 'Adventure stories and travel guides from around the world']
            ] as $category)
            <div class="bg-gradient-to-br from-{{ $category['color'] }}-50 to-{{ $category['color'] }}-100 rounded-xl p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white rounded-full p-3 shadow-sm">
                        <i class="fa-solid fa-{{ $category['icon'] }} text-2xl text-{{ $category['color'] }}-600"></i>
                    </div>
                    <span class="bg-white px-3 py-1 rounded-full text-sm font-medium text-{{ $category['color'] }}-600">
                        {{ $category['count'] }} articles
                    </span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $category['name'] }}</h3>
                <p class="text-gray-600 text-sm mb-4">{{ $category['description'] }}</p>
                <a href="" 
                   class="inline-flex items-center text-{{ $category['color'] }}-600 hover:text-{{ $category['color'] }}-800 font-medium">
                    Explore Category
                    <i class="fa-solid fa-arrow-right ml-2"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div> --}}

    <!-- All Categories -->
    <div>
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900">All Categories</h2>
            <div class="flex space-x-2">
                <select class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>Sort by: Popular</option>
                    <option>Sort by: Name</option>
                    <option>Sort by: Newest</option>
                    <option>Sort by: Articles Count</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories  as $category)
            <a href="" 
               class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition group">
                <div class="flex items-start justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-{{ $category['color'] }}-100 rounded-lg p-3 group-hover:scale-110 transition">
                            <i class="fa-solid fa-{{ $category['icon'] }} text-2xl text-{{ $category['color'] }}-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 group-hover:text-indigo-600">
                                {{ $category['name'] }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $category['count'] }} articles</p>
                        </div>
                    </div>
                    <i class="fa-solid fa-chevron-right text-gray-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition"></i>
                </div>
                
                <!-- Recent articles in this category -->
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-xs text-gray-400 mb-2">Recent articles:</p>
                    <div class="space-y-2">
                        <div class="flex items-center text-sm">
                            <span class="w-2 h-2 bg-{{ $category['color'] }}-400 rounded-full mr-2"></span>
                            <span class="text-gray-600 truncate">Latest post in {{ $category['name'] }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <span class="w-2 h-2 bg-{{ $category['color'] }}-300 rounded-full mr-2"></span>
                            <span class="text-gray-600 truncate">Another popular article</span>
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
    document.getElementById('categorySearch').addEventListener('keyup', function() {
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