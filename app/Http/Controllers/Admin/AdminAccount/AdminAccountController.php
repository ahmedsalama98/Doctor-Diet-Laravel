<?php

namespace App\Http\Controllers\Admin\AdminAccount;

use App\Helpers\Countries;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminAccountController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('role:super-admin|admin|moderator');
    }


    public function account(){
        return view('admin.pages.dashboard.account');
    }

    public function editAccount(){
        $countries = Countries::get();

        return view('admin.pages.dashboard.edit-account', compact('countries'));
    }

    public function updateAccount(Request $request){

        $admin = Auth::user();
        Validator::make($request->all(),[

            'name'=>['required', 'min:2'],
            'email'=>['required', 'email',Rule::unique('users')->ignore($admin->id)],
            'image'=>['nullable','image', 'mimes:png,jpg,jpeg'],
            'birth_date'=>['nullable', 'date',],
            'gender'=>['nullable', 'integer',],
            'country'=>['nullable', 'string'],

        ])->validate();


        $admin->name =$request->name;
        $admin->email =$request->email;

        if(!is_null($request->birth_date)){
            $admin->birth_date =$request->birth_date;
        }
        if(!is_null($request->country)){
            $admin->country =$request->country;
        }
        if(!is_null($request->gender)){
            $admin->gender =$request->gender;

        }

        if($request->hasFile('image')){

            $oldImage = $request->file('image');
            $newImage =$request->file('image')->hashName();
            Image::make($oldImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/users_avatar/' .$newImage ,100);
            if(!is_null($admin->avatar)){
                Storage::disk('public_uploads')->delete('users_avatar/'.$admin->avatar);
            }
            $admin->avatar =$newImage;
        }
        $admin->save();
        return redirect()->route('dashboard.account')->with('success',__('site.profile_updated_successfully'));
    }


    public function editPassword(){


        return view('admin.pages.dashboard.edit-password');

    }

    public function updatePassword(Request $request){

        $admin = Auth::user();

        Validator::make($request->all(),[
            'old_password'=>['required', 'min:6'],
            'new_password'=>['required', 'min:6'],
            'new_password_confirmation'=>['required', 'min:6','same:new_password'],
        ])->validate();



        if( !Hash::check($request->old_password,$admin->password )){
            return redirect()->back()->withErrors(['old_password'=>__('site.old_password_not_true')]);
        }
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        return redirect()->route('dashboard.account')->with('success',__('site.password_updated_successfully'));

    }

}
