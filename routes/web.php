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
    Route::get('/usercreate',[UserController::class, 'manage'])->name('usercreate');
    Route::post('/usercreate',[UserController::class, 'store'])->name('userinsert');
    Route::get('/useredit/{id}',[UserController::class, 'manage']);
    Route::post('/useredit/{id}',[UserController::class, 'store']);
    Route::get('/userdelete/{id}',[UserController::class, 'delete']);
    Route::get('/userview',[UserController::class, 'index'])->name('userview');
    Route::get('/user-datatable',[UserController::class, 'view'])->name('user-datatable');
    Route::get('/salesview',[SalesController::class, 'index'])->name('salesview');
    Route::get('/salesedit/{id}',[SalesController::class, 'manage']);
    Route::post('/salesupdate/{id}',[SalesController::class, 'store'])->name('salesupdate');
    Route::get('/salesdelete',[SalesController::class, 'delete']);
    Route::get('/create10user',[UserController::class, 'create10user']);    
});
Route::group(['middleware' =>['role:merchant']],function(){
    Route::get('/salescreate',[SalesController::class, 'manage'])->name('salescreate');
    Route::post('/salescreate',[SalesController::class, 'store'])->name('salesinsert');
  
    
});



