<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Ingredient;

class RecommendationController extends Controller
{
    public function getRecommendations()
    {
        $user = Auth::user(); // ambil user yg lagi login
        
    
        // ambil jenis kulit user dari session/db
        $fitzType = $user->fitzpatrick_type ?? session('fitzType');
        $baumannType = $user->baumann_type ?? session('baumannType');

        if (!$fitzType || !$baumannType) {
            return redirect()->route('user.test')->with('error', 'Please complete the skin test first.');
        }

        try {

            // cari n ambil ingredient2 yg cocok buat jenis kulit user
            $recommendedIngredients = Ingredient::where(function($query) use ($fitzType, $baumannType) {
                $query->whereJsonContains('suitable_for', $fitzType)
                      ->orWhereJsonContains('suitable_for', $baumannType);
            })->get();

            // ambil produk2 yg cocok dari ingredients yg udh diambil
            $products = Product::whereHas('ingredients', function($query) use ($recommendedIngredients) {
                $query->whereIn('name', $recommendedIngredients->pluck('name'));
            })
            ->orWhere(function($query) use ($fitzType, $baumannType) {
                // masukkin juga kalo ada produk yg ditandain cocok (coba2 pas awal dulu)
                $query->where('recommended_for', 'like', "%$fitzType%")
                      ->orWhere('recommended_for', 'like', "%$baumannType%");
            })
            ->with(['ingredients' => function($query) use ($recommendedIngredients) {
                $query->whereIn('name', $recommendedIngredients->pluck('name'));
            }])
            ->paginate(12);

            // kaalau gaada produk yg cocok persis, cari produk yg cocok sebagian (atau salah satunya cocok)
            if ($products->isEmpty()) {
                $products = Product::where(function($query) use ($fitzType, $baumannType) {
                    $query->where('recommended_for', 'like', "%$fitzType%")
                          ->orWhere('recommended_for', 'like', "%$baumannType%")
                          ->orWhereHas('ingredients', function($q) use ($fitzType, $baumannType) {
                              $q->whereJsonContains('suitable_for', $fitzType)
                                ->orWhereJsonContains('suitable_for', $baumannType);
                          });
                })
                ->inRandomOrder()
                ->paginate(12);
            }

            return view('user.product-recommendations', [
                'products' => $products,
                'fitzType' => $fitzType,
                'baumannType' => $baumannType,
                'recommendedIngredients' => $recommendedIngredients
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while getting recommendations. Please try again.');
        }
    }

    public function getIngredientRecommendations()
    {
        $user = Auth::user();
        
        $fitzType = $user->fitzpatrick_type ?? session('fitzType');
        $baumannType = $user->baumann_type ?? session('baumannType');

        if (!$fitzType || !$baumannType) {
            return response()->json([
                'success' => false,
                'message' => 'Please complete the skin test first.'
            ]);
        }

        try {
            $recommendedIngredients = Ingredient::where(function($query) use ($fitzType, $baumannType) {
                $query->whereJsonContains('suitable_for', $fitzType)
                      ->orWhereJsonContains('suitable_for', $baumannType);
            })->get();

            return response()->json([
                'success' => true,
                'ingredients' => $recommendedIngredients,
                'fitzType' => $fitzType,
                'baumannType' => $baumannType
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while getting ingredient recommendations.'
            ]);
        }
    }

    public function show($type)
    {

        $user = Auth::user();

        // anggap jensi kulit user udh ada di db user / session
        $fitzType = $user->fitz_type ?? session('fitzType');
        $baumannType = $user->baumann_type ?? session('baumannType');


        $products = Product::where(function ($query) use ($fitzType, $baumannType) {
            $query->where('recommended_for', 'like', "%$fitzType%")
                  ->orWhere('recommended_for', 'like', "%$baumannType%");
        })->paginate(12);

        if ($products->isEmpty()) {
            $products = Product::where('recommended_for', 'like', "%$fitzType%")
                ->orWhere('recommended_for', 'like', "%$baumannType%")
                ->inRandomOrder()
                ->limit(4)
                ->get();
        }

        return view('user.recommendations', compact('type', 'products'));
    }
}
