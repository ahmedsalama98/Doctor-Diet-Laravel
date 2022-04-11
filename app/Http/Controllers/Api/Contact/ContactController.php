<?php

namespace App\Http\Controllers\Api\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'email'=> ['required' ,'email'],
            'mobile'=> ['required' ,'numeric', 'min:11'],
            'name'=> ['required' ,'string', 'min:3'],
            'subject'=> ['required' ,'string', 'min:3'],
            'message'=> ['required' ,'string', 'min:3'],
        ]);

        if($validator->fails()){
            return $this->sendErrors($validator->errors()->toArray(), 'error');
        }

        $contact =new Contact;
        $contact->email = $request->email;
        $contact->mobile = $request->mobile;
        $contact->name = $request->name;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->ip = $request->ip();
        $contact->save();

        $data =[];
      return   $this->sendResponse($data,'done',201);





    }
}
