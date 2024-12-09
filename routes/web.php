<?php
use App\Exports\UsersExport;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/stock-report', [DashboardController::class, 'generateReport'])->name('stock.report');
Route::get('/actions', [DashboardController::class, 'showActions'])->name('actions');

//user
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

//produit
Route::get('/produit', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produit/create', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::get('/produits/{id}/show', [ProduitController::class, 'show'])->name('produits.show');
Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produit/{id}', [ProduitController::class, 'destroy'])->name('produit.destroy');
//attribute
Route::get('/product/{id}/attribute', [ProduitController::class, 'indexAttribute'])->name('index.attribute');
Route::post('/product/{id}/attribute', [ProduitController::class, 'storeAttribute'])->name('store.attribute');

//category
Route::resource('categories', CategoryController::class);
Route::post('categories/{id}/attach-products', [CategoryController::class, 'attachProducts'])->name('categories.attach-products');
Route::post('categories/{id}/detach-products', [CategoryController::class, 'detachProducts'])->name('categories.detach-products');

//stock
Route::resource('stocks', StockController::class);

// Define the route for Barchart
Route::get('/Barchart', function () {
    return view('Panel.Barchart'); 
})->name('Barchart');
Route::get('/Linechart', function () {
    return view('Panel.Linechart'); 
})->name('Linechart');

Route::get('/Piechart', function () {
    return view('Panel.Piechart'); 
})->name('Piechart');


Route::get('/Userprofile', function () {
    return view('Panel.Userprofile'); 
})->name('Userprofile');
Route::get('/export-users', function () {
    return Excel::download(new UsersExport, 'users.xlsx');
})->name('export.users');

// Profile routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
