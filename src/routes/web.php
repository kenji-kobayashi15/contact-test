<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
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
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacts/confirm', [ContactController::class, 'confirm']);
Route::post('/contacts/thanks', [ContactController::class,'store']);
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/search', [AdminController::class, 'index'])->name('admin.search');
Route::get('/reset', [AdminController::class, 'index'])->name('admin.reset');
Route::delete('/delete', [AdminController::class, 'destroy'])->name('admin.delete');
Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');