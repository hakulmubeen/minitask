<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillingController;

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

Route::get('/',[BillingController::class,'index'])->name('billing.index');
Route::post('/generate-bill',[BillingController::class,'generate'])->name('billing.generate');
Route::get('/generated-bill/{id}',[BillingController::class,'generated'])->name('billing.generated');
Route::get('/list',[BillingController::class,'list'])->name('billing.list');
