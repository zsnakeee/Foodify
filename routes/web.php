<?php

use App\Http\Controllers\SocialAuthController;
use App\Livewire\Frontend\Forms\RegisterForm;
use App\Livewire\Frontend\Pages\Categories;
use App\Livewire\Frontend\Pages\Products;
use App\Livewire\Frontend\Pages\Cart;
use App\Livewire\Frontend\Pages\HomePage;
use App\Livewire\Frontend\Pages\LoginPage;
use App\Livewire\Frontend\Pages\RegisterPage;
use App\Livewire\Frontend\Pages\Wishlist;
use Illuminate\Support\Facades\Route;


Route::get('/', HomePage::class)->name('home');
Route::get('/categories', Categories\Index::class)->name('categories');
Route::get('/categories/{category}', Categories\View::class)->name('categories.view');
Route::get('/products', Products\Index::class)->name('products');
Route::get('/products/{product}', Products\View::class)->name('products.view');
Route::get('/cart', Cart\Index::class)->name('cart');
Route::get('/wishlist', Wishlist::class)->name('wishlist');


Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])->name('oauth.redirect');
    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('oauth.callback');
});

Route::get('/logout', function () {
    auth()->logout();
    return redirect()->route('home');
})->name('logout')->middleware('auth');

