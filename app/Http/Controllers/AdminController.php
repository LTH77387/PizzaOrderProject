<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }
    public function profile(){
        $id=auth()->user()->id;
        $userData=User::where('id',$id)->first();
        
        return view('admin.profile.index')->with(['profileShow'=>$userData]);
    }
    public function category(){
        $data=Category::paginate(5);
        return view('admin.category.list')->with(['showCategory'=>$data]);
    }
    public function pizza(){
        return view('admin.pizza.list');
    }
    public function addCategory(){
        return view('admin.category.addCategory');
    }
    public function createCategory(Request $request){
        $validator = Validator::make($request->all(), [
           'name'=>'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data=[
            'category_name'=>$request->name,
        ];
        Category::create($data);
        return redirect()->route('category')->with(['addCategory'=>"Category Added!!!"]);
    }
    public function editCategory($id){
        $data=Category::where('category_id',$id)->first();
        return view('admin.category.update')->with(['editCategory'=>$data]);
    }
    public function updateCategory($id, Request $request){
       $updateData=[
           'category_name'=>$request->name,
       ];
       Category::where('category_id',$id)->update($updateData);
       return redirect()->route('category')->with(['updateCategory'=>"Categories are updated successfully!!"]);
    }
    public function deleteCategory($id){
        Category::where('category_id',$id)->delete();
        return back()->with(['deleteCategory'=>"Category deleted successfully!!"]);
    }
}
