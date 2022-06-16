<?php

namespace App\Http\Controllers\Admin;

use Laracsv\Export;

use App\Models\User;



use League\Csv\Reader;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;



class CategoryController extends Controller
{
    public function index(){
        return view('admin.home');
    }
    
    public function category(){
    $data=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
    ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
    ->groupBy('categories.category_id')
    ->paginate(5);
   
    if(Session::has('CATEGORY_SEARCH')){
        Session::forget('CATEGORY_SEARCH');
    }
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

       $data=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
       ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
       ->groupBy('categories.category_id')
       ->where('category_name','like','%'.$request->searchCategory.'%')
       ->paginate(5);
      Session::put('CATEGORY_SEARCH',$request->searchCategory);
        if(count($data)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
       
       $data->appends($request->all());
        return view('admin.category.list')->with(['showCategory'=>$data,'status'=>$emptyStatus]);
    }
    public function categoryDownload(){
        if(Session::has('CATEGORY_SEARCH')){
            
       $category=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
         ->where('category_name','like','%'.Session::get('CATEGORY_SEARCH').'%')
       ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
       ->groupBy('categories.category_id')
     
       ->get();
        }else{
            $category=Category::select('categories.*',DB::raw('COUNT(pizzas.category_id) as count'))
       ->leftJoin('pizzas','pizzas.category_id','categories.category_id')
       ->groupBy('categories.category_id')
       ->get();
        }
       
        $csvExporter = new \Laracsv\Export();

        // $csvExporter->beforeEach(function ($user) {
        //     $user->created_at = $user->created_at->format('Y-m-d');
        // });

        $csvExporter->build($category, [
            'category_id' => 'Category ID',
            'category_name'=>'Category Name',
            'count'=>'Product Count',
            'created_at'=>'Created Date',
            'updated_at'=>'Updated Date',
        ]);

        $csvReader = $csvExporter->getReader();

        $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

        $filename = 'testing.csv';

        return response((string) $csvReader)
            ->header('Content-Type', 'text/csv; charset=UTF-8')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}
