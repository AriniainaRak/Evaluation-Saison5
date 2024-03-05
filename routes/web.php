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
Route::get('/loginutil', [MyController::class, 'loginUtil'])->name('loginUtil');
Route::get('/logUtil', [MyController::class, 'logUtil'])->name('logUtil');
Route::get('/admis', [MyController::class, 'admin'])->name('admin');
Route::get('/logout', [MyController::class, 'logout'])->name('logout');
Route::post('/insert', [MyController::class, 'insert'])->name('insert');
Route::get('/delete', [MyController::class, 'delete'])->name('delete');
Route::get('/update', [MyController::class, 'update'])->name('update');
Route::get('/nationalite', [Mycontroller::class,'nationalite'])->name('nationalite');
Route::get('/club', [Mycontroller::class,'club'])->name('club');
Route::get('/caracteristique', [Mycontroller::class,'caracteristique'])->name('caracteristique');
Route::get('/formation', [Mycontroller::class,'formation'])->name('formation');
Route::get('/poste', [Mycontroller::class,'poste'])->name('poste');
Route::get('/coefficient', [Mycontroller::class,'coefficient'])->name('coefficient');
Route::get('/joueur', [Mycontroller::class,'joueur'])->name('joueur');
Route::get('/note_joueur', [Mycontroller::class,'note_joueur'])->name('note_joueur');
Route::get('/liste', [Mycontroller::class,'liste'])->name('liste');
Route::post('/recherche', [Mycontroller::class,'recherche'])->name('recherche');
Route::post('/insertJoueur', [Mycontroller::class,'insertJoueur'])->name('insertJoueur');
Route::post('/importClub', [Mycontroller::class,'importClub'])->name('importClub');
Route::post('/importNationalite', [Mycontroller::class,'importNationalite'])->name('importNationalite');
Route::post('/importCoefficients', [Mycontroller::class,'importCoefficients'])->name('importCoefficients');

