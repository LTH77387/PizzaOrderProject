<?php

namespace App\Http\Controllers\User;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
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
      Session::put('CONTACT_DATA',$request->searchContact);
      $data->appends($request->all());
    return view('admin.contact')->with(['contact'=>$data]);
   }
   public function contactDownload(){
     
       if(Session::has('CONTACT_DATA')){
        $data= Contact::orWhere('name','like','%' . Session::get('CONTACT_DATA') . '%' )
        ->orWhere('email','like','%' . Session::get('CONTACT_DATA') . '%')
        ->orWhere('message','like','%' . Session::get('CONTACT_DATA') . '%')
        ->get();
       }else{
       $data=Contact::get();
       }
       $csvExporter = new \Laracsv\Export();

      // $csvExporter->beforeEach(function ($user) {
      //     $user->created_at = $user->created_at->format('Y-m-d');
      // });

      $csvExporter->build($data, [
          'contact_id' => 'Contact ID',
          'name'=>'Contact Name',
          'user_id'=>'User ID',
          'email'=>'Email',
          'message'=>'Message',
         
      ]);

      $csvReader = $csvExporter->getReader();

      $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

      $filename = 'contactDownload.csv';

      return response((string) $csvReader)
          ->header('Content-Type', 'text/csv; charset=UTF-8')
          ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
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
