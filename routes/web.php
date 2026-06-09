<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BasicController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\UserPermissionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
route::get('index', function () {
    return view('home.index2');
});
Route::get('/terms', function () {
    $policy = \App\Models\Policy::where('type', 'terms')->first();
    return view('home.policy', compact('policy'));
})->name('terms');

Route::get('/privacy', function () {
    $policy = \App\Models\Policy::where('type', 'privacy')->first();
    return view('home.policy', compact('policy'));
})->name('privacy');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('userlogin');

Route::get('/dashboard', function () {
    return view('admin.dashboard');
    // return view('index');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('orders/{id}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::post('orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.order.updateStatus');

    Route::get('newform', [BasicController::class, 'newform']);
    Route::get('datatables', [BasicController::class, 'datatables']);

    Route::prefix('admin')->name('admin.')->group(function () {

        Route::get('/products', [ProductController::class, 'index'])->name('product.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/products/store', [ProductController::class, 'store'])->name('product.store');

        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/products/{id}/update', [ProductController::class, 'update'])->name('product.update');

        Route::delete('/products/{id}', [ProductController::class, 'delete'])
            ->name('product.delete');

        Route::get('/products/{id}/delete-image', [ProductController::class, 'deleteImage'])
            ->name('product.image.delete');
    });

    Route::get('/admin/hero/', [HeroController::class, 'edit'])->name('hero.edit');
    Route::post('/admin/hero/{id}/update', [HeroController::class, 'update'])->name('hero.update');

    Route::get('/admin/cards/', [CardController::class, 'edit'])->name('cards.edit');
    Route::post('/admin/cards/{id}/update', [CardController::class, 'update'])->name('cards.update');
    Route::get('/admin/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/admin/settings/update', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('reviews', ReviewController::class);

 Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    
    Route::get('/admin/policies/{type}/edit', [PolicyController::class, 'edit'])->name('admin.policies.edit');
    Route::put('/admin/policies/{type}', [PolicyController::class, 'update'])->name('admin.policies.update');



});
Route::get('/products-json', [ProductController::class, 'productsJson'])
    ->name('products.json');

require __DIR__ . '/auth.php';