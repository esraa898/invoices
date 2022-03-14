<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\InvoicesAttachementController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesdetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Models\product;

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
// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

//  Auth::routes(['register' => false]);


Route::get('/home', [HomeController::class, 'index'])->name('home');

// invoices routes 
Route::resource('invoices', InvoicesController::class);
Route::get('/section/{id}',[InvoicesController::class,'getProducts']);
Route::get('/invoices_edit/{id}',[InvoicesController::class,'edit']);
Route::get('/status_show/{id}',[InvoicesController::class,'statusShow']);
Route::post('/status_update/{id}',[InvoicesController::class,'statusUpdate']);
Route::get('invoice_paid',[InvoicesController::class,'invoicePaid']);
Route::get('invoice_unpaid',[InvoicesController::class,'invoiceUnpaid']);
Route::get('invoice_partiallypaid',[InvoicesController::class,'invoicePartiallyPaid']);




//invoices detaisls
Route::post('/attachment',[InvoicesAttachementController::class,'store']);
Route::get('/invoicesdetails/{id}',[InvoicesdetailsController::class,'getdetails']);
Route::get('/viewfile/{id}/{filename}',[InvoicesdetailsController::class,'viewfile']);
Route::get('/download/{id}/{filename}',[InvoicesdetailsController::class,'downloadfile']);
Route::post('delete_file',[InvoicesdetailsController::class,'destroy']);


//Archive
Route::resource('Archive',ArchiveController::class);
Route::post('Archive/delete',[ArchiveController::class,'delete']);
// sections route 
Route::resource('sections',SectionController::class);


//products route
Route::resource('products',ProductController::class);





Route::get('/{page}',[AdminController::class,'index']);





