<x-admin-layout>
    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold sm:text-5xl md:text-6xl">Category</h1>
             <p class="mt-6 max-w-2xl mx-auto text-xl">
                Explore our diverse range of topics and find content that interests you
            </p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">All Categories</h3>
            <div class="flex space-x-2">
                <!-- Bulk Delete Button -->
                <button id="bulkDeleteBtn"
                    class="bg-red-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-red-700 hidden">
                    <i class="fa-solid fa-trash mr-1"></i> Delete Selected
                </button>
                <!-- Add Category Button -->
                <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                    <i class="fa-solid fa-plus mr-1"></i> Add Category
                </a>

            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 m-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 m-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <!-- Categories Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 w-full">
                <thead class="bg-gray-50">
                    <tr >
                        <th class="px-6 py-3 text-left">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-indigo-600">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                       
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posts</th> --}}
                  
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Featured</th>
                       
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                  
                    @forelse($categories as $id =>$category)
                        <tr>
                            <td class="px-6 py-4">
                                <input type="checkbox" class="category-checkbox rounded border-gray-300"
                                    value="{{ $id }}">
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $id+1 }}</td>
                            
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $category->name }}</div>
                            </td>
                            
                            <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                {{ $category->description ?? 'No description' }}
                            </td>
                            {{-- <td class="px-6 py-4">
                                <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded">
                                    {{ $category->posts_count ?? 0 }}
                                </span>
                            </td> --}}
                            {{-- <td class="px-6 py-4">
                                <span class="h-5 w-5 rounded-full bg-{{ $category->color }}-500 block">{{ $category->color }}</span>
                            </td> --}}
                            <td class="px-6 py-4">
                                @if($category->is_featured)
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
                                        <i class="fa-solid fa-star mr-1"></i> Featured
                                    </span>
                                @else
                                    <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $category->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    
                                        <a href="{{ route('admin.categories.edit',$category->id) }}" class="text-blue-600 hover:text-blue-800 p-1">
                                            <i class="fa-solid fa-edit"></i>
                                        </a>
                                    
                                    
                                    <form action="{{ route('admin.categories.delete') }}" method="POST" class="inline"
                                        onsubmit="return confirm('Are you sure? This cannot be undone.');">
                                        @csrf
                                        <input type="text" name="id" value="{{ $category->id }}" hidden>

                                        <button type="submit" class="text-red-600 hover:text-red-800 p-1">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-6 py-12 text-center">
                                <div class="text-gray-500">
                                    <i class="fa-solid fa-folder-open text-4xl mb-3"></i>
                                    <p class="text-lg">No categories found</p>
                                    <a href="{{ route('admin.categories.create') }}"
                                        class="text-indigo-600 hover:text-indigo-800 mt-2 inline-block">
                                        Create your first category
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $categories->links() }}
        </div>
    </div>

    <!-- Bulk Delete Form -->
    <form id="bulkDeleteForm" action="{{ route('admin.categories.bulk.delete') }}" method="POST" class="hidden">
        @csrf
       
        <input type="hidden" name="ids" id="bulkIds">
    </form>


    <script>
        // Select All functionality
        const selectAll = document.getElementById('selectAll');
        const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
        const bulkDeleteForm = document.getElementById('bulkDeleteForm');
        const bulkIds = document.getElementById('bulkIds');

        selectAll.addEventListener('change', function () {
            categoryCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleBulkDelete();
        });

        categoryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', toggleBulkDelete);
        });

        function toggleBulkDelete() {
            const checkedCount = document.querySelectorAll('.category-checkbox:checked').length;
            if (checkedCount > 0) {
                bulkDeleteBtn.classList.remove('hidden');
            } else {
                bulkDeleteBtn.classList.add('hidden');
            }
        }

        // Bulk Delete
        bulkDeleteBtn.addEventListener('click', function () {
            const checkedIds = Array.from(document.querySelectorAll('.category-checkbox:checked'))
                .map(cb => cb.value);

            if (checkedIds.length === 0) return;

            if (confirm(`Are you sure you want to delete ${checkedIds.length} categories?`)) {
                bulkIds.value = JSON.stringify(checkedIds);
                bulkDeleteForm.submit();
            }
        });
    </script>
</x-admin-layout>