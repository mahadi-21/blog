<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name|max:255',
            'description' => 'nullable|string|max:1000',

        ]);

        try {
            DB::transaction(function () use ($request) {
                Category::create([
                    'name' => $request->name,
                    'description' => $request->description,

                ]);
            });

            return redirect()->back()->with('success', 'Category created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to create category: ' . $e->getMessage());
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
    public function edit($id)
    {
       
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        DB::beginTransaction();

        try {
            $category = Category::findOrFail($request->id);

            $category->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            return redirect()->back()->with( 'success','Category updated successfully');

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()->back()->with('error','Failed to update category'.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $category = Category::findOrFail($id);
        try {
            DB::transaction(function () use ($category) {
                $category->delete();
            });

            return redirect()->back()->with('success', 'Category deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete category: ' . $e->getMessage());
        }

    }

    public function bulkDelete(Request $request)
    {

        $ids = json_decode($request->ids);

        try {
            DB::transaction(function () use ($ids) {
                Category::whereIn('id', $ids)->delete();
            });

            return redirect()->back()->with('success', 'Categories deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete categories: ' . $e->getMessage());
        }
    }
}
