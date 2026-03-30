<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get products by category.
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCategory($categoryId)
    {
        $category = Category::find($categoryId, ['*']);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.'
            ], 404);
        }

        $products = $category->products()->get(['id', 'name', 'image', 'price', 'description']);

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|max:2048';
        } else {
            $rules['image'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        // Filter out status if the column doesn't exist in the database yet
        if (isset($validated['status']) && !\Illuminate\Support\Facades\Schema::hasColumn('products', 'status')) {
            unset($validated['status']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully.',
            'data' => $product
        ], 201);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'price' => 'sometimes|required|numeric',
            'description' => 'nullable|string',
            'status' => 'nullable|string',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|max:2048';
        } else {
            $rules['image'] = 'nullable|string';
        }

        $validated = $request->validate($rules);

        // Filter out status if the column doesn't exist in the database yet
        if (isset($validated['status']) && !\Illuminate\Support\Facades\Schema::hasColumn('products', 'status')) {
            unset($validated['status']);
        }

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->getRawOriginal('image')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->getRawOriginal('image'));
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully.',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully.'
        ]);
    }
}
