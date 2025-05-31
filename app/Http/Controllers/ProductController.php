<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        SEOTools::setTitle('Product Catalog');
        SEOTools::setDescription('Browse all products in our catalog.');
        return view('products.index', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        SEOTools::setTitle($product->name);
        SEOTools::setDescription($product->description);
        SEOTools::opengraph()->setUrl(route('products.show', $product->slug));
        SEOTools::setCanonical(route('products.show', $product->slug));
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);
        $product = Product::create($request->only('name', 'slug', 'description', 'price'));
        return redirect()->route('products.show', $product->slug)->with('success', 'Product created successfully.');
    }

    public function edit($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);
        $product->update($request->only('name', 'slug', 'description', 'price'));
        return redirect()->route('products.show', $product->slug)->with('success', 'Product updated successfully.');
    }

    public function destroy($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}