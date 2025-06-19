<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;


class TransactionController extends Controller
{

    public function checkoutForm()
    {
        $cart = \App\Models\Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->first();

        $cartItems = $cart?->items ?? collect();
        $shipping = 9000;
        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $total = $subtotal + $shipping;

        return view('user.checkout', compact('cartItems', 'subtotal', 'shipping', 'total'));
    }

    public function uploadProofSubmit(Request $request, $id)
    {
        $request->validate([
            'proof' => 'required|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $transaction = \App\Models\Transaction::findOrFail($id);

        // Simpan file
        $filePath = $request->file('proof')->store('proofs', 'public');

        $transaction->update([
            'proof_of_payment' => $filePath,
            'status' => 'pending'
        ]);

        return redirect()->route('user.orders')->with('success', 'Proof uploaded successfully.');

    }

    public function confirm($id)
    {
        $transaction = Transaction::with('product')->findOrFail($id);

        if ($transaction->product->seller_id !== auth()->id()) {
            abort(403);
        }

        $transaction->status = 'confirmed';
        $transaction->save();

        return back()->with('success', 'Transaksi berhasil dikonfirmasi.');
    }

    public function denyOrder($id)
    {
        $transaction = \App\Models\Transaction::findOrFail($id);
        $transaction->status = 'cancelled';
        $transaction->save();

        return back()->with('success', 'Order has been denied.');
    }


    public function userTransactions()
    {
        $transactions = Transaction::where('user_id', auth()->id())->with('product')->get();
        return view('user.transactions', compact('transactions'));
    }

    public function sellerOrders()
    {
        $transactions = Transaction::whereHas('product', function ($q) {
            $q->where('seller_id', auth()->id());
        })->with('product')->get();

        return view('seller.orders', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'address_detail' => 'nullable|string',
            'city'           => 'required|string',
            'province'       => 'required|string',
            'country'        => 'required|string',
            'postal_code'    => 'required|string',
        ]);

        $user = auth()->user();
        $cart = \App\Models\Cart::with('items.product')->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Cart is empty.');
        }

        $subtotal = $cart->items->sum(fn($item) => $item->product->price * $item->quantity);
        $shipping = 9000;
        $total = $subtotal + $shipping;

        $transaction = \App\Models\Transaction::create([
            'user_id'        => $user->id,
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'phone'          => $request->phone,
            'address'        => $request->address,
            'address_detail' => $request->address_detail,
            'city'           => $request->city,
            'province'       => $request->province,
            'country'        => $request->country,
            'postal_code'    => $request->postal_code,
            'subtotal'       => $subtotal,
            'shipping'       => $shipping,
            'total'          => $total,
            'status'         => 'pending'
        ]);

    foreach ($cart->items as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id'     => $item->product_id,
                'shade'          => $item->shade,
                'quantity'       => $item->quantity,
                'price'          => $item->product->price
            ]);
        }

    // gabis checkout, hapus all item di cart
    $cart->items()->delete();

    // redirect ke halaman upload proof of payment
    return redirect()->route('transaction.proof', $transaction->id);
    }

    public function uploadProofForm($id)
    {
        $transaction = \App\Models\Transaction::with('user')->findOrFail($id);

        return view('user.upload-proof', compact('transaction'));
    }

    public function myOrders()
    {
        $transactions = \App\Models\Transaction::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.orders', compact('transactions'));
    }

    public function manageOrder()
    {
        $transactions = \App\Models\Transaction::with(['items.product'])
                        ->orderByDesc('created_at')
                        ->paginate(10);

        return view('seller.manage-order', compact('transactions'));
    }

    public function confirmOrder($id)
    {
        $trx = \App\Models\Transaction::findOrFail($id);
        $trx->status = 'paid';
        $trx->save();

        return back()->with('success', 'Order confirmed.');
    }

    public function shipOrder($id)
    {
        $trx = \App\Models\Transaction::findOrFail($id);
        $trx->status = 'shipped';
        $trx->save();

        return back()->with('success', 'Order marked as shipped.');
    }

    public function markAsSuccess(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->update(['status' => 'success']);

        return response()->json(['message' => 'Order marked as success.']);
    }

    public function submitReview(Request $request, Transaction $transaction)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        foreach ($transaction->items as $item) {
            Review::create([
                'user_id' => auth()->id(),
                'product_id' => $item->product_id,
                'transaction_id' => $transaction->id,
                'rating' => $request->rating,
                'review' => $request->review,
            ]);
        }

        return redirect()->route('user.orders')->with('success', 'Thank you for your review!');
    }




}
