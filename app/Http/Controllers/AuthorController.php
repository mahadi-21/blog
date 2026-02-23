<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->with('category')->latest()->paginate(5);
        $total_posts = Post::where('user_id', Auth::user()->id)->count();
        $rejected_posts = Post::where('user_id', Auth::user()->id)->where('status', 'rejected')->count();
        return view('author.dashboard', compact('posts', 'total_posts', 'rejected_posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('author.create-post', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:2048',
            'status' => 'required|string',
        ]);

        // Handle file upload if a featured image is provided
        if ($request->hasFile('featured_image')) {

            $file = $request->file('featured_image');
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $filename);

            $validatedData['featured_image'] = 'uploads/' . $filename;
        }
        try {
            DB::transaction(function () use ($validatedData) {
                $post = Post::create([
                    'title' => $validatedData['title'],
                    'category_id' => $validatedData['category_id'],
                    'content' => $validatedData['content'],
                    'excerpt' => $validatedData['excerpt'] ?? null,
                    'featured_image' => $validatedData['featured_image'] ?? null,
                    'user_id' => Auth::user()->id,
                    'status' => $validatedData['status'], // Set initial status to pending
                ]);
            });
            return back()->with('success', 'Post created successfully and is pending review.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while saving the post: ' . $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
}
