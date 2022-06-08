<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PizzaController;
use App\Http\Controllers\Admin\CategoryController;


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

Route::group(['prefix'=>'admin','namespcae'=>'Admin'],function(){
    Route::get('/',[CategoryController::class,'index'])->name('admin');
   Route::get('profile',[AdminController::class,'profile'])->name('profile');
    Route::get('category',[CategoryController::class,'category'])->name('category');
    Route::get('pizzaGet',[PizzaController::class,'pizzaGet'])->name('pizzaGet');
    Route::get('pizza',[PizzaController::class,'pizza'])->name('pizza');
    Route::get('addCategory',[CategoryController::class,'addCategory'])->name('addCategory');
    Route::post('creaetCategory',[CategoryController::class,'createCategory'])->name('createCategory');
    Route::get('editCategory/{id}',[CategoryController::class,'editCategory'])->name('editCategory');
    Route::post('updateCategory/{id}',[CategoryController::class,'updateCategory'])->name('updateCategory');
    Route::get('deleteCategory/{id}',[CategoryController::class,'deleteCategory'])->name('deleteCategory');
    Route::post('createPizza',[PizzaController::class,'createPizza'])->name('createPizza');
    Route::get('pizzaCreate',[PizzaController::class,'pizza'])->name('pizzaCreate');
    Route::post('category',[CategoryController::class,'searchCategory'])->name('category');
    Route::get('deletePizza/{id}',[PizzaController::class,'deletePizza'])->name('deletePizza');
    Route::get('pizzaInfo/{id}',[PizzaController::class,'pizzaInfo'])->name('pizzaInfo');
    Route::get('pizzaEdit{id}',[PizzaController::class,'pizzaEdit'])->name('pizzaEdit');
   Route::post('updatePizza{id}',[PizzaController::class,'updatePizza'])->name('updatePizza');
   Route::post('updateUserData{id}',[AdminController::class,'updateUserData'])->name('updateUserData');
   Route::get('userChangePasswordPage',[AdminController::class,'userChangePasswordPage'])->name('userChangePasswordPage');
   Route::post('changePassword/{id}',[AdminController::class,'changePassword'])->name('changePassword');
    //edit Pizza direct page
    // Route::get('editPizza',[PizzaController::class,'editPizza'])->name('editPizza');
route::post('pizzaSearch',[PizzaController::class,'pizzaSearch'])->name('pizzaSearch');
});
Route::group(['prefix'=>'user'],function(){
    Route::get('/',[UserController::class,'index'])->name('user');
});


 