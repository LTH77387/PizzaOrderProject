<?php


use Carbon\Carbon;


use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('category/list',function(Request $request){
  $data=[
      'category_name'=>$request->categoryName,
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now(),
  ];
  Category::create($data);
  $response=[
      'status'=>200,
      'message'=>'success',
  ];
  // $header=$request->header('categoryName');
  // dd($header);
  return Response::json($response);
});
// Route::get('category/details',function(){
//   $data=Category::get();
//   $response=[
//     'status'=>200,
//     'message'=>'done',
// ];
// return Response::json($response);
// });
Route::group(['middleware'=>'auth:sanctum'],function(){
  Route::get('category/delete/{id}',[ApiController::class,'categoryDelete']);
  Route::post('category/update',[ApiController::class,'categoryUpdate']);
  Route::get('categoryData',[ApiController::class,'categoryData']);

});
Route::group(['namespace'=>'Api'],function(){
  Route::post('login',[AuthController::class,'login']);
  Route::get('logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
  Route::post('register',[AuthController::class,'register']);
});
