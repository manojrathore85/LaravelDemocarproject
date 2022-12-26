<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('home');
})->middleware('auth');
Auth::routes();
Route::group(['middleware' =>['role:admin']],function(){
    Route::get('/usercreate',[UserController::class, 'create'])->name('usercreate');
    Route::post('/usercreate',[UserController::class, 'insert'])->name('userinsert');
    Route::get('/userview',[UserController::class, 'view'])->name('userview');
});
Route::group(['middleware' =>['role:merchant']],function(){
    Route::get('/salescreate',[UserController::class, 'create'])->name('salescreate');
    Route::post('/salescreate',[UserController::class, 'insert'])->name('salesinsert');
    Route::get('/salesview',[UserController::class, 'view'])->name('salesview');
});

