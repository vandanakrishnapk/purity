<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('admin.index');
// });

//login routes

Route::get('/',[LoginController::class,'view_login'])->name('view.login');
Route::post('/doLogin',[LoginController::class,'doLogin'])->name('do.login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/forgotPwd',[LoginController::class,'forgot_pwd'])->name('forgot.pwd');
Route::post('/submitForgetPasswordForm',[LoginController::class,'submitForgetPasswordForm'])->name('submitForgetPasswordForm');
Route::get('/sendMailReset',[LoginController::class,'send_mail_reset'])->name('send.mail_reset');
Route::get('/changePasswordForm/{token}',[LoginController::class,'change_password_form'])->name('change_password_form');
Route::post('/submitResetPasswordForm',[LoginController::class,'submitResetPasswordForm'])->name('submitResetPasswordForm');
//admin routes 
Route::middleware(['auth', 'role:0'])->prefix('admin')->group(function () 
{    
Route::get('/index',[AdminController::class,'index'])->name('admin.index');
Route::post('/individual/new',[AdminController::class,'doIndividual'])->name('doIndividual');
Route::get('/getCategories', [ProductController::class, 'getCategories']);
Route::get('/products/{category_id}', [ProductController::class,'getProductsByCategory']);
Route::post('/submitProduct', [ProductController::class, 'submitProduct']);
Route::get('/product',[ProductController::class,'product'])->name('product');
Route::get('/purchase/individual',[AdminController::class,'viewIndividualPurchase'])->name('viewIndividualPurchase');
Route::get('/purchase/viewIndividualData',[AdminController::class,'viewIndividualData'])->name('viewIndividualData'); 
//admin vs User Route on individuals form
Route::get('/getUsers',[UserController::class,'getUsers'])->name('admin.getusers');
//admin vs user route
Route::get('/viewUser',[UserController::class,'viewUser'])->name('admin.viewUser');
Route::post('/doAddUser',[UserController::class,'doAddUser'])->name('admin.doAddUser');
Route::get('/getUserData',[UserController::class,'getUserData'])->name('admin.getUserData');
//view edit update users by admin
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

//view edit update individual purchase details by admin 
Route::get('/purchases/{id}', [AdminController::class, 'show'])->name('purchases.show');
Route::get('/purchases/{id}/edit', [AdminController::class, 'edit'])->name('purchases.edit');
Route::post('/purchases/{id}', [AdminController::class, 'update'])->name('purchases.update');
Route::delete('/purchases/{id}', [AdminController::class, 'destroy'])->name('purchases.destroy');
});






//user routes 
Route::middleware(['auth', 'role:1'])->prefix('user')->group(function ()
 {
    Route::get('/userHome',[UserController::class,'userHome'])->name('user.home');
});

