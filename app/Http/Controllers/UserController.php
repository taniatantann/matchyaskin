<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Ingredient;
use App\Models\SkinTest;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard');
    }

    public function myMakeup()
    {
        $fitzType = session('fitzType');
        $baumannType = session('baumannType');

        if ($fitzType && $baumannType) return redirect()->route('user.baumann.result');

        return view('user.my-makeup');
    }

    public function myCart()
    {
        return view('user.cart');
    }

    // personal test
    public function showTest()
    {
        $skinTest = SkinTest::where('user_id', Auth::id())->first();
        return view('user.personal-test', compact('skinTest'));
    }

    public function submitTest(Request $request)
    {
        $validated = $request->validate([
            'result_skin_type' => 'required|string|max:10',
        ]);

        SkinTest::updateOrCreate(
            ['user_id' => Auth::id()],
            ['result_skin_type' => $validated['result_skin_type']]
        );

        return redirect()->route('user.recommendations')->with('success', 'Skin type saved successfully!');
    }

    // rekomendasi
    public function showRecommendations()
    {
        $skinTest = SkinTest::where('user_id', Auth::id())->first();

        if (!$skinTest) {
            return redirect()->route('user.test')->with('error', 'Please complete the personal test first.');
        }

        // ambil all ingredient_id yg cocok sm jenis kulit
        $ingredientIds = Ingredient::whereJsonContains('suitable_for', $skinTest->result_skin_type)->pluck('id');

        // ambil product_id dari ingredient_product
        $productIds = \DB::table('ingredient_product')
            ->whereIn('ingredient_id', $ingredientIds)
            ->pluck('product_id')
            ->unique();

        // ambil produk yang cocok
        $products = Product::whereIn('id', $productIds)->get();

        return view('user.recommendations', compact('products', 'skinTest'));
    }
}
