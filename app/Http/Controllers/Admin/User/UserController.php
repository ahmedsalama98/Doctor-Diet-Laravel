<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super-admin|admin|moderator']);
        $this->middleware('permission:users-read')->only('index');
        $this->middleware('permission:users-create')->only('create');
        $this->middleware('permission:users-update')->only(['update','edit']);
        $this->middleware('permission:users-delete')->only('destroy');

    }

    public function index(Request $request)
    {

        $status = isset($request->status) && $request->status == 0?0:1;

        $users = User::
        where(function($query)use($request){
            return $query->when($request->search ,function($q ) use($request){
                return $q->where('name' ,'like' , '%'.$request->search.'%')
                        ->orWhere('email' ,'like' , '%'.$request->search.'%');
            });

        })

        ->whereStatus($status)
        ->whereDoesntHaveRole()
        ->latest()->paginate(5)->withQueryString();

        // return [$users->groupBy(function($date) {
        //     return \Carbon\Carbon::parse($date->created_at)->format('d-M-y');
        // }) ,];



        return view('admin.pages.user.index', compact('users'));

    }


    public function create()
    {
        return view('admin.pages.user.create');

    }

    public function store(Request $request)
    {



        Validator::make($request->all(),[

            'name'=>['required', 'min:2'],
            'email'=>['required', 'email','unique:users'],
            'status'=>['required'],
            'image'=>['nullable','image', 'mimes:png,jpg,jpeg'],
            'password'=>['required', 'min:4'],
            'password_confirmation'=>['required', 'same:password'],

        ])->validate();


        $user =new User;
        $user->name =$request->name;
        $user->email =$request->email;
        $user->status =$request->status;
        $user->password =Hash::make($request->password);
        $user->save();


        if($request->hasFile('image')){

            $oldImage = $request->file('image');
            $newImage =$request->file('image')->hashName();
            Image::make($oldImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/users_avatar/' .$newImage ,100);
            $user->avatar =$newImage;
        }
        $user->save();
        return redirect()->route('admin.users.index')->with('success',__('site.user_added_successfully'));


    }


    public function edit($id)
    {
        $user = User::whereDoesntHaveRole()->findOrFail($id);

        return view('admin.pages.user.edit', compact('user'));


    }

    public function update(Request $request, $id)
    {
        $user = User::whereDoesntHaveRole()->findOrFail($id);



        Validator::make($request->all(),[
            'name'=>['required', 'min:2'],
            'email'=>['required', 'email',Rule::unique('users')->ignore($user->id)],
            'status'=>['required'],
            'gender'=>['required'],
            'image'=>['nullable','image', 'mimes:png,jpg,jpeg'],
            'password'=>['nullable', 'min:4','same:password_confirmation'],
            'password_confirmation'=>['nullable', 'same:password'],
        ])->validate();


        $user->name =$request->name;
        $user->email =$request->email;
        $user->status =$request->status;
        $user->gender =$request->gender;


        if(!is_null($request->password)){
            $user->password =Hash::make($request->password);
        }
        $user->save();




        if($request->hasFile('image')){

            $oldImage = $request->file('image');
            $newImage =$request->file('image')->hashName();
            Image::make($oldImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/users_avatar/' .$newImage ,100);
            if(!is_null($user->avatar)){
                Storage::disk('public_uploads')->delete('users_avatar/'.$user->avatar);
            }
            $user->avatar =$newImage;
        }
        $user->save();
        return redirect()->route('admin.users.index')->with('success',__('site.user_updated_successfully'));

    }


    public function destroy($id)
    {
        $user = User::whereDoesntHaveRole()->findOrFail($id);

        if(!is_null($user->avatar)){
            Storage::disk('public_uploads')->delete('users_avatar/'.$user->avatar);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success',__('site.user_deleted_successfully'));

    }
}
