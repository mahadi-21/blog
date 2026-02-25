<x-admin-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header with navigation -->
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-bold text-gray-900">Article View</h1>
                        <div class="space-x-2">
                            
                            <a href="{{ route('admin.articles.approve') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <!-- Article metadata -->
                    <div class="mb-6 pb-6 border-b border-gray-200">
                        <div class="flex items-center text-sm text-gray-500 space-x-4">
                            <span>Published: {{ $article->created_at->format('F j, Y') }}</span>
                            <span>|</span>
                            <span>Author: {{ $article->author->name ?? 'Admin' }}</span>
                            @if($article->category)
                            <span>|</span>
                            <span>Category: {{ $article->category->name }}</span>
                            @endif
                            @if($article->views)
                            <span>|</span>
                            <span>{{ $article->views }} views</span>
                            @endif
                        </div>
                    </div>

                    <!-- Featured Image -->
                    @if($article->featured_image)
                    <div class="mb-8">
                        <img src="{{ asset( $article->featured_image) }}" 
                             alt="{{ $article->title }}" 
                             height="200px" width="200px"
                             class=" rounded-lg shadow-lg">
                        <p class="text-sm text-gray-500 mt-2 items-center text-center">Featured Image</p>
                    </div>
                    @else
                    <div class="mb-8 bg-gray-100 h-64 flex items-center justify-center rounded-lg">
                        <span class="text-gray-400">No featured image</span>
                    </div>
                    @endif

                    <!-- Article Title -->
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $article->title }}</h2>

                    <!-- Excerpt -->
                    @if($article->excerpt)
                    <div class="mb-6 p-4 bg-gray-50 border-l-4 border-indigo-500 rounded">
                        <p class="text-gray-600 italic">{{ $article->excerpt }}</p>
                        <p class="text-xs text-gray-400 mt-2">Excerpt</p>
                    </div>
                    @endif

                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! $article->content !!}
                    </div>

                    <!-- Tags -->
                    @if($article->tags)
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-500 mb-2">Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $article->tags) as $tag)
                            <span class="px-3 py-1 bg-gray-100 text-gray-600 text-sm rounded-full">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                  

                    <!-- Delete Button (separate for safety) -->
                    <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                        <form action="{{ route('admin.article.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article? This action cannot be undone.');">
                            @csrf
                           
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700">
                                Delete Article
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>