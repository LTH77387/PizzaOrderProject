<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
   public function userSend(Request $request){
    $validator = Validator::make($request->all(), [
           
        'name'=>'required',
        'email'=>'required',
        'message'=>'required',
    ]);

    if ($validator->fails()) {
        return    back()
                    ->withErrors($validator)
                    ->withInput();
                  
    }
      $data=$this->getUserdata($request);
      Contact::create($data);
      return back()->with(['contactSend'=>"User data sent successfully!"]);
   }
   public function contactShow(Request $request){
    $data=Contact::orderBy('contact_id','desc')
    ->paginate(5);
$data->appends($request->all());
    return view('admin.contact')->with(['contact' => $data]);
   }
   public function searchContact(Request $request){
     $data= Contact::orWhere('name','like','%' . $request->searchContact . '%' )
      ->orWhere('email','like','%' . $request->searchContact . '%')
      ->orWhere('message','like','%' . $request->searchContact . '%')
      ->paginate(5);
      $data->appends($request->all());
    return view('admin.contact')->with(['contact'=>$data]);
   }
   private function getUserdata($request){
    return [
        'user_id'=>auth()->user()->id,
        'name'=>$request->name,
        'email'=>$request->email,
        'message'=>$request->message,
    ];
   }
}
