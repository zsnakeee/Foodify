<?php

use App\Http\Controllers\SocialAuthController;
use App\Livewire\Frontend\Pages\AddressesPage;
use App\Livewire\Frontend\Pages\Cart;
use App\Livewire\Frontend\Pages\Categories;
use App\Livewire\Frontend\Pages\HomePage;
use App\Livewire\Frontend\Pages\LoginPage;
use App\Livewire\Frontend\Pages\Orders;
use App\Livewire\Frontend\Pages\Payment\FailurePage;
use App\Livewire\Frontend\Pages\Payment\InvoicePage;
use App\Livewire\Frontend\Pages\Payment\SuccessPage;
use App\Livewire\Frontend\Pages\Products;
use App\Livewire\Frontend\Pages\ProfilePage;
use App\Livewire\Frontend\Pages\RegisterPage;
use App\Livewire\Frontend\Pages\WishlistPage;
use App\Services\Cart\ExtendedCart;
use Illuminate\Support\Facades\Route;

Route::get('/', HomePage::class)->name('home');
Route::get('/categories', Categories\Index::class)->name('categories');
Route::get('/categories/{category}', Categories\View::class)->name('categories.view');
Route::get('/products', Products\Index::class)->name('products');
Route::get('/products/{product}', Products\View::class)->name('products.view');
Route::get('/cart', Cart\Index::class)->name('cart');
Route::get('/wishlist', WishlistPage::class)->name('wishlist');
Route::get('/checkout/{single?}', Cart\Checkout::class)->name('checkout');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/orders', Orders\Index::class)->name('orders');
    Route::get('/order/{order}/view', Orders\View::class)->name('orders.view');
    Route::get('/order/completed/{order_id}', SuccessPage::class)->name('payment.success');
    Route::get('/order/cancel', FailurePage::class)->name('payment.failure');
    Route::get('/invoice/{order_id}', InvoicePage::class)->name('invoice');

    Route::get('/profile', ProfilePage::class)->name('profile');
    Route::get('/addresses', AddressesPage::class)->name('addresses');
});

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

Route::get('/get', function (){
    $cart = app(ExtendedCart::class)->shopping();
    //$cart->destroy();
    return app(ExtendedCart::class)->shopping()->all();
});
