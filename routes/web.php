<?php
use App\Http\Livewire\ProductPagination;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\printPDFController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\OwnerController;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\BuyingInvoice;
use App\Models\Cart;
use App\Models\Cashier;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Group;
use App\Models\Information;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\SellingInvoice;
use App\Models\Supplier;

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

// require __DIR__.'/auth.php';