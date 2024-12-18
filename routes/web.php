<?php

use App\Http\Controllers\CashierController;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\Cashier\LiveCart;
use App\Livewire\CategoriesPage;
use App\Livewire\CheckoutPage;
use App\Livewire\HomePage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrderPage;
use App\Livewire\PaymentSuccessPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\ProductsPage;
use App\Livewire\SuccessPage;
use App\Providers\Filament\AdminPanelProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
 
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
 
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/', HomePage::class);
Route::get('/categories', CategoriesPage::class);
Route::get('/products', ProductsPage::class);
Route::get('/products/{id_product}', action: ProductDetailPage::class);

Route::middleware('guest')->group(function () {
	Route::get('/register', RegisterPage::class);
	Route::get('/login', LoginPage::class)->name('login');
	Route::get('/forgot', ForgotPasswordPage::class)->name('password.request'); ;
	Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});
Route::get('/cart', action: CartPage::class);

Route::middleware(['auth', 'verified', 'hasRole:user'])->group(function () {
	Route::get('/poskesdes', HomePage::class);
	Route::get('/checkout', action: CheckoutPage::class);
	Route::get('/orders', action: MyOrderPage::class);
	Route::get('/my-orders/{id_selling_invoice}', action: MyOrderDetailPage::class);	
	Route::get('/success', SuccessPage::class);
	Route::get('/payment-success', PaymentSuccessPage::class);
	Route::get('/cancel', CancelPage::class);
});

Route::get('/customer/logout', function () {
    auth()->logout();
    return redirect()->to('/');
})->name('customer.logout');

Route::middleware(['auth', 'hasRole:cashier'])->group(function () {
	Route::get('/cashier', function()
    {
        return view('cashier.index');
    })->name('cashier.dashboard');

	Route::get('/cashier/checkout', [LiveCart::class, 'checkout'])->name('cashier.checkout');
	Route::post('/cashier/clear-cart', [LiveCart::class, 'clearCart'])->name('cashier.clearCart');
	Route::get('/cashier/pending-orders', [CashierController::class, 'pendingOrders'])->name('cashier.pendingOrders');
	Route::get('/cashier/order-failed/{id_selling_invoice}', [CashierController::class, 'failOrder'])->name('failOrder');
	Route::get('/cashier/order-completed/{id_selling_invoice}', [CashierController::class, 'successOrder'])->name('successOrder');
	Route::get('/cashier/history-transaction', [CashierController::class, 'historyTransaction'])->name('cashier.historyTransaction');
	
	Route::post('/cashier/logout', function () {
		auth()->logout();
		return redirect()->to('/');
	})->name('cashier.logout');
});

// Route::middleware(['auth', 'owner'])->group(function () {
//     Route::prefix('admin')->group(function () {
//         Route::get('/', function () {
// 			return redirect()->to('/admin');
// 		})->name('admin.dashboard');
        
// 		Route::get('/', function () {
// 			return redirect()->to('/admin');
// 		})->name('admin.dashboard');
//         // Tambahkan route lain yang diperlukan untuk halaman admin
//     });
// });
