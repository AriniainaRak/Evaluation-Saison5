<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

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

Route::get('/', function () {
    return view('pages/login'); });
Route::get('/login', [MyController::class, 'login'])->name('login');
Route::get('/loginadmin', [MyController::class, 'logAdmin'])->name('loginAdmin');
// Route::get('/loginutil', [MyController::class, 'loginUtil'])->name('loginUtil');
// Route::get('/logUtil', [MyController::class, 'logUtil'])->name('logUtil');
Route::get('/admis', [MyController::class, 'admin'])->name('admin');
Route::get('/logout', [MyController::class, 'logout'])->name('logout');
Route::post('/insert', [MyController::class, 'insert'])->name('insert');
Route::get('/delete', [MyController::class, 'delete'])->name('delete');
Route::get('/update', [MyController::class, 'update'])->name('update');
Route::get('/typedata', [Mycontroller::class,'typedata'])->name('typedata');
Route::get('/data', [MyController::class, 'data'])->name('data');
Route::get('/consommation', [MyController::class, 'consommation'])->name('consommation');
Route::post('/import', [MyController::class, 'import'])->name('import');
Route::get('/production', [MyController::class, 'getProduction'])->name('production');
Route::get('/conso', [MyController::class, 'getConsommation'])->name('conso');
