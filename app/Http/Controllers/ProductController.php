<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Marketplace;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Marketplace $marketplace)
    {
        $products = $marketplace->products()->paginate(12);
        return view('products.index', compact('products', 'marketplace'));
    }

    public function create(Marketplace $marketplace)
    {
        return view('products.create', compact('marketplace'));
    }

    public function store(StoreProductRequest $request, Marketplace $marketplace)
    {
        if ($request->hasFile('image')) {
            $request->file('image')->store('products', 'public');
        }

        $marketplace->products()->create($request->validated());

        return redirect()
            ->route('marketplace.products.index', $marketplace)
            ->with('success', 'Product created successfully.');
    }

    public function show(Marketplace $marketplace, Product $product)
    {
        return view('products.show', compact('marketplace', 'product'));
    }

    public function edit(Marketplace $marketplace, Product $product)
    {
        return view('products.edit', compact('marketplace', 'product'));
    }

    public function update(StoreProductRequest $request, Marketplace $marketplace, Product $product)
    {
  
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $request->file('image')->store('products', 'public');
        }

        $product->update($request->validated());

        return redirect()
            ->route('marketplace.products.show', [$marketplace, $product])
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Marketplace $marketplace, Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()
            ->route('marketplace.products.index', $marketplace)
            ->with('success', 'Product deleted successfully.');
    }
} 