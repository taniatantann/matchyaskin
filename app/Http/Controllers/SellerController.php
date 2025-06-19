<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Order;

class SellerController extends Controller
{
    // tampilin semua produk yg seller punya
   public function manageProduct(Request $request)
    {
        $query = Product::where('seller_id', Auth::id());

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
           $query->where('category', 'like', $request->category);

        }

        if ($request->stock === 'low') {
            $query->where('stock', '<', 5);
        }

        $products = $query->latest()->paginate(10)->withQueryString(); // biar pagination ikut bawa query

        return view('seller.manage-product', compact('products'));
    }

    // tampilin form buat produk baru
    public function createProduct()
    {
        return view('seller.product-form');
    }

    // simpen produk baru
    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'ingredients' => 'nullable|string',
            'suitability' => 'nullable|string',
            'notes' => 'nullable|string',
            'shade_type' => 'nullable|string',
            'recommended_for' => 'nullable|string',
            'alcohol_free' => 'nullable|boolean',
            'perfume_free' => 'nullable|boolean',
            'essential_oil_free' => 'nullable|boolean',
            'paraben_free' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $data['seller_id'] = Auth::id();
        Product::create($data);

        return redirect()->route('seller.products')->with('success', 'Product added successfully.');
    }

    // tampilin form edit produk
    public function editProduct(Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }
        return view('seller.product-form', compact('product'));
    }

    // edit produk
    public function updateProduct(Request $request, Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string',
            'brand' => 'required|string',
            'category' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'ingredients' => 'nullable|string',
            'suitability' => 'nullable|string',
            'notes' => 'nullable|string',
            'shade_type' => 'nullable|string',
            'recommended_for' => 'nullable|string',
            'alcohol_free' => 'nullable|boolean',
            'perfume_free' => 'nullable|boolean',
            'essential_oil_free' => 'nullable|boolean',
            'paraben_free' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('seller.products')->with('success', 'Product updated successfully.');
    }

    // hapus produk
    public function deleteProduct(Product $product)
    {
        if ($product->seller_id !== Auth::id()) {
            abort(403);
        }

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('seller.products')->with('success', 'Product deleted.');
    }

    // tampilin semua order yg seller pny
    public function manageOrder(Request $request)
    {
        $transactions = \App\Models\Transaction::with(['items.product'])
            ->whereHas('items.product', function ($query) {
                $query->where('seller_id', Auth::id());
            })
            ->get();

        //filter berdasarkan nama cust (nama awal/akhir)
        if ($request->filled('search')) {
            $search = $request->search;
            $transactions->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        // filter berdasarkan status (case-insensitive) -> ada bug ><! hapus dulu
        // if ($request->filled('status')) {
        //     $transactions->where('status', strtolower($request->status));
        // }

        $transactions = $transactions->latest()->paginate(10);

        return view('seller.manage-order', compact('transactions'));
    }

    public function confirmOrder(Transaction $transactions)
    {
        if ($transactions->product->seller_id !== Auth::id()) {
            abort(403);
        }

        $transactions->update(['status' => 'paid']);

        return redirect()->route('seller.orders')->with('success', 'Order confirmed.');
    }
}
