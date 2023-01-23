<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashborardController;


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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard',[DashborardController::class,'index'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group( function(){
       Route::get('invoice/create',[InvoiceController::class,'create'])->name('invoice.create');
       Route::post('invoice/store',[InvoiceController::class,'store'])->name('invoice.store');
       Route::get('invoice/show/{invoice_id}',[InvoiceController::class,'show'])->name('invoice.show');
       Route::get('invoice/{invoice_id}/download',[InvoiceController::class,'download'])->name('invoice.download');


    // Route::resource('invoices','InvoiceController');

});
