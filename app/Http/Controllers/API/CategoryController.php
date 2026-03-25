<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        try {
            $categories = Category::all();
            return response()->json([
                'success' => true,
                'data' => $categories,
                'message' => 'Categories retrieved successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve categories.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string'
        ]);

        try {
            $category = Category::create($request->all());
            return response()->json([
                'success' => true,
                'data' => $category,
                'message' => 'Category created successfully.'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|string'
        ]);

        try {
            $category->update($request->all());
            return response()->json([
                'success' => true,
                'data' => $category,
                'message' => 'Category updated successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                'success' => true,
                'message' => 'Category deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete category.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Search for categories by name.
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json([
                'success' => false,
                'message' => 'Search query is required.'
            ], 400);
        }

        try {
            $categories = Category::where('name', 'LIKE', "%{$query}%")->get();
            return response()->json([
                'success' => true,
                'data' => $categories,
                'message' => 'Categories found successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Search failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
