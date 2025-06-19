<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function viewCart()
    {
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);
        $cartItems = $cart->items()->with('product')->get();

        return view('user.cart', compact('cartItems'));
    }

   public function addToCart(Request $request, $productId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $user = Auth::user();

    // Cari cart user, kalau belum ada buat
    $cart = Cart::firstOrCreate(['user_id' => $user->id]);

    // Cek apakah produk sudah ada di cart
    $existingItem = CartItem::where('cart_id', $cart->id)
        ->where('product_id', $productId)
        ->first();

    if ($existingItem) {
        $existingItem->quantity += $request->quantity;
        $existingItem->save();
    } else {
        CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $productId,
            'quantity' => $request->quantity,
            // 'shade' => null // default null, sesuaiin kalau ada input shade (rencana fitur tambahan)
        ]);
    }

    return redirect()->back()->with('success', 'Product added to cart!');
}

    public function updateQty(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item = CartItem::findOrFail($itemId);
        $item->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'Quantity updated.');
    }

    public function increaseQty($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->quantity += 1;
        $item->save();

        return redirect()->back();
    }

    public function decreaseQty($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        if ($item->quantity > 1) {
            $item->quantity -= 1;
            $item->save();
        } else {
            $item->delete(); // or keep it at 1
        }

        return redirect()->back();
    }


    public function removeItem($itemId)
    {
        CartItem::findOrFail($itemId)->delete();
        return redirect()->back()->with('success', 'Item removed.');
    }
}
