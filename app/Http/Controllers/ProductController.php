<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('pages.management.product.index', compact('products'));
    }

    public function create()
    {
        return view('pages.management.product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . time(),
            'owner_name' => $request->owner_name,
            'whatsapp_number' => $request->whatsapp_number,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $imagePath,
            'is_active' => true,
        ]);

        return redirect()->route('management.products.index')->with('success', 'Produk UMKM berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('pages.management.product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'owner_name' => $request->owner_name,
            'whatsapp_number' => $request->whatsapp_number,
            'price' => $request->price,
            'description' => $request->description,
            'is_active' => $request->has('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('management.products.index')->with('success', 'Produk UMKM berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('management.products.index')->with('success', 'Produk UMKM berhasil dihapus.');
    }
}