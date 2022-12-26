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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['role:super-admin']], function () {
    //
});

Route::group(['middleware' =>['role:admin']],function(){
    Route::get('/usercreate',[UserController::class, 'create'])->name('usercreate');
    Route::post('/usercreate',[UserController::class, 'insert'])->name('userinsert');
    Route::post('/userview',[UserController::class, 'view'])->name('userview');
});
