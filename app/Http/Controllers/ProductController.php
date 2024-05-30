<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        // Create the product
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // Return the newly created product
        return response()->json(['product' => $product], 201);
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        // Find the product
        $product = Product::findOrFail($id);

        // Update the product
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        // Return the updated product
        return response()->json(['product' => $product], 200);
    }

    public function destroy($id)
    {
        // Find the product
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Return success message
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
