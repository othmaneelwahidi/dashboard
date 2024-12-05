<?php
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/Linechart', [ProduitController::class, 'showChart']);


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


Route::get('/Ajoutproduit', function () {
    return view('Panel.Ajoutproduit'); 
})->name('Ajoutproduit');
Route::get('/Listeproduit', function () {
    return view('Panel.Listeproduit'); 
})->name('Listeproduit');



Route::get('/export-users', function () {
    return Excel::download(new UsersExport, 'users.xlsx');
})->name('export.users');


Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::get('/Listeproduit', [ProduitController::class, 'showProduits'])->name('produits.Listeproduit');
Route::delete('/produit/{id}', [ProduitController::class, 'destroy'])->name('produit.destroy');

// Profile routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
});
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
// Delete User Route
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');




require __DIR__.'/auth.php';
