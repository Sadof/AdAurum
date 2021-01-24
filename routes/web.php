<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;


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

Route::get('', [CompanyController::class, 'index'])->name('index');
Route::post('', [CompanyController::class, 'store'])->name('add_company');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/{id}/', [CompanyController::class, 'show']);
Route::post('/{id}/ajax', [CompanyController::class, 'ajax'])->name("ajax");

