<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\{
    ProfileController,
    UserController,
    AdminController,
    SellerController,
    CartController,
    TransactionController,
    ProductController,
    QuizController,
    BaumannController,
    RecommendationController
};



// Route::resource('products', ProductController::class);




Route::get('/', function () {
    $products = Product::latest()->take(8)->get();
    return view('welcome', compact('products'));
});

Route::get('/about', function () {
    return view('about');
})->name('about');


// ==================== Redirect ke Dashboard Sesuai Role ====================
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin') return redirect()->route('admin.users');
    if ($role === 'seller') return redirect()->route('seller.dashboard');
    if ($role === 'customer') return redirect('/'); // atau route('user.welcome') jika pakai controller
})->name('dashboard');



// ==================== Profile (Semua Role) ====================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==================== USER ====================
Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/welcome', [UserController::class, 'welcome'])->name('user.welcome');
    Route::get('/products/all', [ProductController::class, 'all'])->name('products.all');
    Route::get('/products/show', [ProductController::class, 'show'])->name('products.show');
    Route::get('/product-suggestions', [ProductController::class, 'suggestions'])->name('products.suggestions');
    Route::get('/products/recommendations', [ProductController::class, 'recommendations'])->name('products.recommendations');
    Route::get('/products/{id}', [ProductController::class, 'detail'])->name('products.detail');
    Route::get('/my-makeup', [UserController::class, 'myMakeup'])->name('user.makeup');

    Route::get('/my-cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/update/{itemId}', [CartController::class, 'updateQty'])->name('cart.update');
    Route::delete('/cart/remove/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::get('/checkout', [TransactionController::class, 'checkoutForm'])->name('checkout.form');
    Route::post('/user/checkout', [TransactionController::class, 'store'])->name('transaction.store');
    Route::get('/user/checkout/upload-proof/{transaction}', [TransactionController::class, 'uploadProofForm'])->name('transaction.proof');
    Route::post('/user/checkout/upload-proof/{transaction}', [TransactionController::class, 'uploadProofSubmit'])->name('transaction.proof.submit');
    Route::get('/user/my-orders', [TransactionController::class, 'myOrders'])->name('user.orders');
    Route::post('/order/{transaction}/complete', [TransactionController::class, 'markAsSuccess'])->name('user.orders.success');
    Route::post('/order/{transaction}/review', [TransactionController::class, 'submitReview'])->name('user.orders.review');




    Route::get('/quiz/fitzpatrick', function () {
    return view('user.fitzpatrick');
    })->name('user.fitzpatrick');
    // Quiz Step-by-step
    Route::get('/quiz/step/{step}', [QuizController::class, 'showStep'])->name('user.quiz.step');
    Route::post('/quiz/step/{step}', [QuizController::class, 'storeStep'])->name('user.quiz.step.store');
    Route::get('/quiz/result', [QuizController::class, 'showResult'])->name('user.quiz.result');

    Route::get('/quiz/baumann', function () {
    return view('user.baumann.intro');
    })->name('user.baumann.intro');
    Route::get('/baumann/step/{step}', [BaumannController::class, 'showStep'])->name('user.baumann.step');
    Route::post('/baumann/step/{step}', [BaumannController::class, 'storeStep'])->name('user.baumann.step.store');
    Route::get('/baumann/result', [BaumannController::class, 'showResult'])->name('user.baumann.result');


});

// ==================== SELLER ====================
Route::middleware(['auth', 'role:seller'])->prefix('seller')->group(function () {
    Route::get('/', fn () => redirect('/seller/manage-product'))->name('seller.dashboard');

    // Products Management
    Route::get('/manage-product', [SellerController::class, 'manageProduct'])->name('seller.products');
    Route::get('/manage-product/create', [SellerController::class, 'createProduct'])->name('seller.products.create');
    Route::post('/manage-product', [SellerController::class, 'storeProduct'])->name('seller.products.store');
    Route::get('/manage-product/{product}/edit', [SellerController::class, 'editProduct'])->name('seller.products.edit');
    Route::put('/manage-product/{product}', [SellerController::class, 'updateProduct'])->name('seller.products.update');
    Route::delete('/manage-product/{product}', [SellerController::class, 'deleteProduct'])->name('seller.products.destroy');

    // Orders Management
    Route::get('/manage-order', [TransactionController::class, 'manageOrder'])->name('seller.orders');
    Route::post('/manage-order/confirm/{order}', [TransactionController::class, 'confirmOrder'])->name('seller.orders.confirm');
    Route::post('/manage-order/ship/{order}', [TransactionController::class, 'shipOrder'])->name('seller.orders.ship');

});

// ==================== ADMIN ====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'manageUser'])->name('admin.users');
    Route::post('/admin/add-user', [AdminController::class, 'storeUser'])->name('admin.addUser');
    Route::put('/user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::delete('/user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});

require __DIR__.'/auth.php';
