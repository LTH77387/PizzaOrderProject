<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class UserController extends Controller
{
    public function index(){
        return view('user.home');
    }
    public function getUserListPage(){
        $userData=User::where('role','=','user')->paginate(5);
 
        return view('admin.user.userList')->with(['userList'=>$userData]);
    }
    public function getAdminListPage(){
     $adminData=User::where('role','=','admin')->paginate(5);
 
        
     return view('admin.user.adminList')->with(['adminList'=>$adminData]);
    }
    public function userListDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['userListDelete'=>"User Data Deleted Successfully!"]);
    }
    public function adminListDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['adminListDelete'=>"Admin Data Deleted Successfully!"]);
    }

    //user data search 
    public function userListSearch(Request $request){
        $response=$this->search('user',$request);
      return view('admin.user.userList')->with(['userList'=>$response]);
    }
    //admin data search
    public function adminListSearch(Request $request){
        $response=$this->search('admin',$request);
      return view('admin.user.adminList')->with(['adminList'=>$response]);
    }
public function categoryItem($id){
    $data=Pizza::select('pizzas.*','categories.category_name as categoryName')
    ->leftJoin('categories','pizzas.pizza_id','categories.category_id')
    ->where('pizzas.category_id',$id)
    ->paginate(5);

    return view('admin.category.item')->with(['categoryItem'=>$data]);
 
    
}


    private function search($role,$request){
        $searchData=User::where('role',$role)->where(function ($query) use($request){
            $query->orWhere('name','like','%' . $request->ListSearch . '%')
            ->orWhere('email','like','%' . $request->ListSearch . '%')
            ->orWhere('phone','like','%' . $request->ListSearch . '%')
            ->orWhere('address','like','%' . $request->ListSearch . '%');
        })->paginate(3);
        $searchData->appends($request->all());
       
        return $searchData;
    }
}
