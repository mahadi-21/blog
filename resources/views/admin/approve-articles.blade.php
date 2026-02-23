<x-admin-layout>

    <div class="bg-gradient-to-l from-blue-900 to-cyan-700 border-b border-gray-200">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8  rounded-lg">
            <h1 class="text-4xl font-bold text-white"> Articles Approval</h1>

        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- Total Articles -->
            <div class="bg-white shadow-sm rounded-xl p-6 border border-gray-200">
                <p class="text-sm font-medium text-gray-500">Total Articles</p>
                <p class="mt-2 text-3xl font-bold text-gray-900">4</p>
            </div>

            <!-- Total Pending -->
            <div class="bg-yellow-50 shadow-sm rounded-xl p-6 border border-yellow-200">
                <p class="text-sm font-medium text-yellow-700">Total Pending</p>
                <p class="mt-2 text-3xl font-bold text-yellow-900">4</p>
            </div>

            <!-- Total Rejected -->
            <div class="bg-red-50 shadow-sm rounded-xl p-6 border border-red-200">
                <p class="text-sm font-medium text-red-700">Total Rejected</p>
                <p class="mt-2 text-3xl font-bold text-red-900">3</p>
            </div>

        </div>
    </div>
    <!-- Tables Section -->
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 ">
        <!-- Pending Approval Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden ">
            {{-- <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Articles Pending Approval</h3>
                <a href="{{ route('admin.articles.approve') }}"
                    class="text-indigo-600 hover:text-indigo-800 text-sm">View All</a>
            </div> --}}
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 w-full">
                    <thead class="bg-gray-50">
                        <tr>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pendingArticles as $id => $article)
                            <tr>
                                <td>
                                    <div class="text-sm text-gray-600">{{ $id + 1 }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $article->title }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $article->author->name ?? 'Unknown' }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-600">{{ $article->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <button class="text-green-600 hover:text-green-800">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        <button class="text-red-600 hover:text-red-800">
                                            <i class="fa-solid fa-times"></i>
                                        </button>
                                        <a href="#" class="text-blue-600 hover:text-blue-800">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No articles pending approval
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <!-- Users Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
                <a href="{{ route('admin.users') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">View All</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentUsers ?? [] as $user)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                                        class="h-8 w-8 rounded-full mr-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }} px-2 py-1 rounded">
                                    {{ $user->is_admin ? 'Admin' : ($user->is_author ? 'Author' : 'User') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="text-xs {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} px-2 py-1 rounded">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No users found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Categories Table (Full Width) -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow overflow-hidden mt-8">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Categories</h3>
                <div class="flex space-x-2">
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
                        <i class="fa-solid fa-plus mr-1"></i> Add Category
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Posts Count</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Color</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($categories ?? [] as $category)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $category->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <i
                                        class="fa-solid fa-{{ $category->icon ?? 'tag' }} text-{{ $category->color ?? 'indigo' }}-600 mr-2"></i>
                                    <span class="text-sm font-medium text-gray-900">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $category->posts_count ?? 0 }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="h-5 w-5 rounded-full bg-{{ $category->color ?? 'indigo' }}-500 block"></span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button class="text-blue-600 hover:text-blue-800">
                                        <i class="fa-solid fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-800">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">No categories found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> --}}
    </div>
</x-admin-layout>