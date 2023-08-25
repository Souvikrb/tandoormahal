<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\UserController;

use App\Http\Controllers\admin\AdministratorController;
use App\Http\Controllers\Transaction\SaleController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\OrderController;

use App\Http\Middleware\AdminAuthentication;
use App\Http\Middleware\UserAuthentication;
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


Route::get('/',           [FrontendController::class,'index']);
//Route::get('/',[AdministratorController::class,'index']);
// User Routes
Route::get('/register',  [UserController::class,'createUser'])->name('/register');
Route::post('/register/user', [UserController::class,'registerUser'])->name('/register/user');
Route::get('/login',    [UserController::class,'login'])->name('/login');
Route::post('/user/login', [UserController::class,'loginUser'])->name('/user/login');
Route::get('/logout', [UserController::class,'logout'])->name('/logout');

// cart routes
Route::get('/cart',          [CartController::class,'index'])->name('/cart');
Route::post('/cart/add',     [CartController::class,'addtoCart'])->name('/cart/add');
Route::post('/cart/add/half',[CartController::class,'addHalf'])->name('/cart/add/half');
Route::get('/order/submit',  [CartController::class,'orderSubmit'])->name('/order/submit');

/* Administrator route list =======================================================*/
Route::middleware([UserAuthentication::class])->group(function () {
    Route::get('/user/order',[UserController::class,'order'])->name('/user/order');


    //All Profile route
    Route::get('/user/profile',[UserController::class,'profile'])->name('/user/profile');
    Route::post('/user/update',[UserController::class,'user_update'])->name('/user/update');
    /* -------------------------------------------------------------------------------*/
});

/* ================================================================================*/


/* Administrator route list ------------------------------------------------------*/
Route::get('admin/login',[AdministratorController::class,'login'])->name('/admin/login');
Route::post('admin/login/save',[AdministratorController::class,'login_save'])->name('/admin/login/save');

Route::get('/admin/logout', [AdministratorController::class,'logout'])->name('/admin/logout');

Route::middleware([AdminAuthentication::class])->group(function () {
    Route::get('administrator',[AdministratorController::class,'index'])->name('/administrator');

    //All Order route
    Route::get('admin/order',[OrderController::class,'index'])->name('/admin/order');
    Route::post('admin/order/updateOrderStatus',[OrderController::class,'updateOrderStatus'])->name('/admin/order/updateOrderStatus');
    /* -------------------------------------------------------------------------------*/

    



    //All product route
    Route::get('/admin/products',[ProductController::class,'index'])->name("/admin/products");
    Route::get('/admin/products/add',[ProductController::class,'create'])->name('/admin/products/add');
    Route::post('/admin/products/store',[ProductController::class,'store'])->name('/admin/products/store');
    Route::get('/admin/products/edit/{id}',[ProductController::class,'edit'])->name('/admin/products/edit/');
    Route::post('/admin/products/update',[ProductController::class,'update'])->name('/admin/products/update');
    Route::prefix('product')->group(function () {
        Route::get('delete/{id}',[ProductController::class,'destroy'])->name("/admin/deleteProduct");
    });
    /* -------------------------------------------------------------------------------*/
});


//All Sale route
Route::get('sale-upload-excel',[SaleController::class,'addByExcel']);
Route::post('sales-excel-data-review',[SaleController::class,'reviewExcelData']);
Route::get('sales-excel-fetch-editdata',[SaleController::class,'fetchEditExcelData']);
Route::post('sales-excel-update-editdata',[SaleController::class,'updateEditExcelData']);
Route::get('sales-excel-remove-editdata',[SaleController::class,'removeEditExcelData']);
Route::get('sales-excel-upload-alldata',[SaleController::class,'uploadAllExcelData']);
Route::get('add-sale',[SaleController::class,'create']);
Route::post('sales-save-data',[SaleController::class,'store']);
Route::get('sale-report',[SaleController::class,'index']);
Route::get('sales-fetch-editdata',[SaleController::class,'edit']);
Route::post('sales-update-editdata',[SaleController::class,'update']);
Route::get('sales-remove-editdata',[SaleController::class,'destroy']);

//All Stock route
Route::get('purchase',[StockController::class,'create']);


//All Quiz route
Route::get('quiz',[QuizController::class,'create']);
/* -------------------------------------------------------------------------------*/


