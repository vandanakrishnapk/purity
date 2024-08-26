<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CorporateController;
use App\Http\Controllers\InstallationController; 
use App\Http\Controllers\ServiceController; 
use App\Http\Controllers\HistoryController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
//login routes
Route::get('/',[LoginController::class,'view_login'])->name('login');
Route::post('/doLogin',[LoginController::class,'doLogin'])->name('do.login');
Route::get('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/forgotPwd',[LoginController::class,'forgot_pwd'])->name('forgot.pwd');
Route::post('/submitForgetPasswordForm',[LoginController::class,'submitForgetPasswordForm'])->name('submitForgetPasswordForm');
Route::get('/sendMailReset',[LoginController::class,'send_mail_reset'])->name('send.mail_reset');
Route::get('/changePasswordForm/{token}',[LoginController::class,'change_password_form'])->name('change_password_form');
Route::post('/submitResetPasswordForm',[LoginController::class,'submitResetPasswordForm'])->name('submitResetPasswordForm');

//admin routes 
Route::middleware(['auth','role:0'])->prefix('admin')->group(function ()
 {
Route::get('/index',[AdminController::class,'index'])->name('admin.index');
Route::post('/individual/new',[AdminController::class,'doIndividual'])->name('doIndividual');
Route::get('/getCategories', [ProductController::class, 'getCategories']);
Route::get('/SubgetCategories', [SubcategoryController::class, 'SubgetCategories']);
Route::get('/productSelect',[AdminController::class,'productSelect'])->name('productSelect');
Route::get('/subcatSelect',[AdminController::class,'subcatSelect'])->name('subcatSelect');
Route::get('/products/{category_id}', [ProductController::class,'getProductsByCategory']);
Route::get('/purchase/individual/view',[AdminController::class,'viewIndividualPurchase'])->name('viewIndividualPurchase');
Route::get('/purchase/individual',[AdminController::class,'viewIndividualData'])->name('viewIndividualData'); 
Route::get('/subcategory',[SubcategoryController::class,'subcategory'])->name('admin.subcategory');
Route::get('/subcategory/change/{category_id}',[SubcategoryController::class,'subcategoryChange'])->name('admin.subcategoryChange');
Route::post('/doSubcategory',[SubcategoryController::class,'doSubcategory'])->name('admin.doSubcategory');
//category,subcategory,product single submission
Route::get('/AddProduct',[AdminController::class,'getAddProduct'])->name('admin.getAddProduct');
Route::post('/doAddProduct',[AdminController::class,'doAddProduct'])->name('admin.doAddProduct');
Route::post('/doAddCategory',[AdminController::class,'doAddCategory'])->name('admin.doAddCategory');
Route::get('/getProductData',[AdminController::class,'getProductData'])->name('admin.getProductData');
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
Route::post('/purchasesUpdate', [AdminController::class, 'update'])->name('admin.purchases.update');
Route::delete('/purchases/{id}', [AdminController::class, 'destroy'])->name('purchases.destroy'); 
Route::get('/admin/datatable',[AdminController::class,'datatable'])->name('admin.datatable');
//product edit delete 
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
Route::post('/products/update', [ProductController::class, 'update'])->name('admin.products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy'); 
//corporate routes 
Route::get('/purchase/corporate',[CorporateController::class,'getCorporatePurchase'])->name('admin.corporate.purchase');
Route::post('/purchase/corporate/new',[CorporateController::class,'doCorporatePurchase'])->name('admin.doCorporatePurchase');
Route::get('/purchase/corporate/view',[CorporateController::class,'viewCorporatePurchase'])->name('admin.viewCorporatePurchase');
//view more,edit,delete 
Route::get('/purchase/company/{id}', [CorporateController::class, 'show'])->name('company.show');
Route::get('/purchase/company/{id}/edit', [CorporateController::class, 'edit'])->name('company.edit');
Route::post('/purchase/company/{id}', [CorporateController::class, 'update'])->name('company.update');
Route::delete('/purchase/company/{id}', [CorporateController::class, 'destroy'])->name('company.destroy'); 
Route::get('/installations/view',[InstallationController::class,'getInstallationPage'])->name('admin.getInstallationPage');
Route::get('/installations/view/data',[InstallationController::class,'getInstallations'])->name('admin.getInstallations'); 
//service routes 
Route::get('/service/view',[ServiceController::class,'getServicePage'])->name('admin.getServicePage'); 
Route::get('/service/view/data',[ServiceController::class,'viewServices'])->name('admin.viewServices');  
Route::get('/service/parts/view',[ServiceController::class,'partsViewPage'])->name('admin.partsViewPage');
Route::post('/service/parts/new',[ServiceController::class,'doParts'])->name('admin.doParts');
Route::get('/service/getPartsData',[ServiceController::class,'getPartsData'])->name('admin.getPartsData');
//edit delete parts 
Route::get('/service/parts/edit/{id}', [ServiceController::class, 'edit'])->name('admin.parts.edit');
Route::post('/service/parts/update/{id}', [ServiceController::class, 'update'])->name('admin.parts.update');
Route::delete('/service/parts/delete/{id}', [ServiceController::class, 'destroy'])->name('admin.parts.destroy');
Route::get('service/view/details/{id}', [ServiceController::class, 'details']); 
//history routes 
Route::get('/purchase/history/view/{id}',[HistoryController::class,'getPurchaseHistoryView'])->name('admin.getPurchaseHistoryView');
});

//user routes
Route::middleware(['auth', 'role:1'])->prefix('user')->group(function ()
 {
Route::get('/userHome',[UserController::class,'userHome'])->name('user.home');

//installation routes
Route::get('/installation/view',[InstallationController::class,'viewInstallation'])->name('user.viewInstallation');
Route::get('/installation/view/data',[InstallationController::class,'getInstallationData'])->name('user.getInstallationData');
Route::get('/installation/view/bid/{id}',[InstallationController::class,'getInstallationbid'])->name('user.getInstallationbid');
Route::post('/installation/new',[InstallationController::class,'doInstallation'])->name('user.doInstallation');

//service routes 
Route::get('/service/view',[ServiceController::class,'getuserServicePage'])->name('user.getServicePage'); 
Route::get('/service/view/data',[ServiceController::class,'viewuserServices'])->name('user.viewServices'); 
Route::get('/service/view/fix/{id}',[ServiceController::class,'getuserFixService'])->name('user.getFixService');
Route::get('/service/parts/load',[ServiceController::class,'getParts'])->name('user.service.getParts');
Route::post('/service/new',[ServiceController::class,'douserService'])->name('user.doService');


});

