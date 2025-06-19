<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Ingredient;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('reviews')->get();
        $newArrivals = Product::orderByDesc('created_at')->take(8)->get(); // ambil 8 produk terbaru

        return view('user.product', compact('products', 'newArrivals'));
    }

    public function all(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('brand', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category')) {
           $query->where('category', 'like', $request->category);

        }
        $products = Product::orderByDesc('created_at')->paginate(12)->withQueryString(); // tampilin 12 per halaman
        return view('user.product-all', compact('products'));
    }

    public function show(Request $request)
{
    
    $query = Product::query();

    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('brand', 'like', '%' . $request->search . '%');
        });
    }

    if ($request->filled('category')) {
        $query->where('category', 'like', $request->category);
    }

    $products = $query->orderByDesc('created_at')->paginate(12)->withQueryString();

    return view('user.product-show', compact('products'));
}

    public function suggestions(Request $request)
{
    $search = $request->get('query');

    $results = Product::where(function ($queryBuilder) use ($search) {
            $queryBuilder->where('name', 'like', '%' . $search . '%')
                         ->orWhere('brand', 'like', '%' . $search . '%');
        })
        ->select('name', 'brand')
        ->distinct()
        ->orderByRaw("
            CASE 
                WHEN name LIKE ? THEN 0
                WHEN brand LIKE ? THEN 1
                WHEN name LIKE ? THEN 2
                WHEN brand LIKE ? THEN 3
                ELSE 4
            END,
            name ASC
        ", [
            $search . '%', // nama produk mulai dengan ?
            $search . '%', // brand produk mulai dengan ?
            '%' . $search . '%', // nama produk mengandung ?
            '%' . $search . '%', // produk mengandung ?
        ])
        ->limit(10)
        ->get();

    return response()->json($results);
}


    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('user.product-detail', compact('product'));
    }

    public function recommendations(Request $request)
    {
        $user = Auth::user();


        // ambil jenis kulit user dari session/db
        $fitzType = $user->fitzpatrick_type ?? session('fitzType');
        $baumannType = $user->baumann_type ?? session('baumannType');

        if (!$fitzType || !$baumannType) {
            return redirect()->route('user.test')->with('error', 'Please complete the skin test first.');
        }

        try {
            // ambil ingredients yg direkomendasiin buat jenis kulit user
            $recommendedIngredients = Ingredient::where(function($query) use ($fitzType, $baumannType) {
                $query->whereJsonContains('suitable_for', $fitzType)
                    ->orWhereJsonContains('suitable_for', $baumannType);
            })->get();

            // ambil produk2 yg matching sama ingredients yg udh diambil tadi
            $products = Product::where(function($query) use ($recommendedIngredients) {
                foreach ($recommendedIngredients as $ingredient) {
                    $query->orWhere('ingredients', 'like', "%$ingredient->name%");
                }
            })
            ->paginate(12);

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






}
