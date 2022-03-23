<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{







    public function index(Request $request){
        $status = isset($request->status) && $request->status == 1?1:0;


        $contacts = Contact::

        whereRead($status)
        ->latest()->paginate(5)->withQueryString();



        return view('admin.pages.contact.index', compact('contacts',));
    }


    public function read($id){

        $contact = Contact::findOrFail($id);

        $contact->read =1;
        $contact->save();

        return redirect()->back()->with('success',__('site.contact_updated_successfully'));
    }


    public function destroy($id){

        $contact = Contact::findOrFail($id);

        $contact->delete();

        return redirect()->back()->with('success',__('site.contact_deleted_successfully'));
    }
}
