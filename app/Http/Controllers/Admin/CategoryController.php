<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.home');
    }
    
    public function category(){
        $data=Category::paginate(5);
        return view('admin.category.list')->with(['showCategory'=>$data]);
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
    public function searchCategory(Request $request){

        $data=Category::where('category_name','like','%'.$request->searchCategory.'%')->paginate(5);
        return view('admin.category.list')->with(['showCategory'=>$data]);
    }
}
