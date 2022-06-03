<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
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
Route::middleware(['auth:sanctum','verified'])->get('/dashboard',function(){
    if(Auth::check()){
        if(Auth::user()->role=='admin'){
            return redirect()->route('profile');
        }else{
            return redirect()->route('user');
        }
       
    }
})->name('dashboard');

Route::group(['prefix'=>'admin'],function(){
    Route::get('/',[AdminController::class,'index'])->name('admin');
    Route::get('profile',[AdminController::class,'profile'])->name('profile');
    Route::get('category',[AdminController::class,'category'])->name('category');
    Route::get('pizza',[AdminController::class,'pizza'])->name('pizza');
    Route::get('addCategory',[AdminController::class,'addCategory'])->name('addCategory');
    Route::post('creaetCategory',[AdminController::class,'createCategory'])->name('createCategory');
    Route::get('editCategory/{id}',[AdminController::class,'editCategory'])->name('editCategory');
    Route::post('updateCategory/{id}',[AdminController::class,'updateCategory'])->name('updateCategory');
    Route::get('deleteCategory/{id}',[AdminController::class,'deleteCategory'])->name('deleteCategory');
});
Route::group(['prefix'=>'user'],function(){
    Route::get('/',[UserController::class,'index'])->name('user');
});


 