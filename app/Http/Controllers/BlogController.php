<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['category', 'author'])
            ->where('status', 'published');

        // 🔹 Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // 🔹 Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // 🔹 Sorting
        if ($request->sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $posts = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('blog.articles', compact('posts', 'categories'));
    }

    public function categories(Request $request)
    {
        $total_categories = Category::count();
        $total_articles = Post::where('status', 'published')->count();

        $active_authors = User::where('role', 'author')
            ->whereHas('posts', function ($query) {
                $query->where('status', 'published');
            })->count();

        $query = Category::withCount([
            'posts' => function ($q) {
                $q->where('status', 'published');
            }
        ]);

        // 🔍 Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 🔽 Sorting
        if ($request->sort === 'name') {
            $query->orderBy('name');
        } elseif ($request->sort === 'popular') {
            $query->orderBy('posts_count', 'desc');
        } elseif ($request->sort === 'articles') {
            $query->orderBy('posts_count', 'desc');
        } else {
            $query->latest(); // newest default
        }

        $categories = $query->paginate(6)->withQueryString();

        return view('blog.categories', compact(
            'total_categories',
            'total_articles',
            'active_authors',
            'categories'
        ));
    }


    public function about()
    {
        $total_articles = Post::where('status', 'published')->count();
        $active_authors = User::where('role', 'author')->whereHas('posts', function ($query) {
            $query->where('status', 'published');
        })->count();
        $teams = Team::all();
        return view('blog.about', compact('total_articles', 'active_authors','teams'));
    }


    public function contact()
    {
        return view('blog.contact');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);
        try {
            DB::transaction(function () use ($request) {
                Contact::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'message' => $request->message,
                ]);
            });
            return redirect()->back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to submit contact form. Please try again.');
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function categoryshow($id)
    {
        return view('blog.categoryshow');
    }
}
