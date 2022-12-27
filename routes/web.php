<?php

use App\Http\Controllers\SalesController;
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
    Route::get('/userview',[UserController::class, 'index'])->name('userview');
    Route::get('/salesview',[SalesController::class, 'index'])->name('salesview');
});
Route::group(['middleware' =>['role:merchant']],function(){
    Route::get('/salescreate',[SalesController::class, 'create'])->name('salescreate');
    Route::post('/salescreate',[SalesController::class, 'insert'])->name('salesinsert');
    
});



