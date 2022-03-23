<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth', 'role:super-admin|admin|moderator']);
        $this->middleware('permission:admins-read')->only('index');
        $this->middleware('permission:admins-create')->only('create');
        $this->middleware('permission:admins-update')->only(['update','edit']);
        $this->middleware('permission:admins-delete')->only('destroy');

    }

    public function index(Request $request)
    {

        $status = isset($request->status) && $request->status == 0?0:1;

        $admins = User::whereRoleIs(['admin', 'moderator'])->with(['roles'])
        ->where(function($query)use($request){
            return $query->when($request->search ,function($q ) use($request){
                return $q->where('name' ,'like' , '%'.$request->search.'%')
                        ->orWhere('email' ,'like' , '%'.$request->search.'%');
            });

        })
        ->whereStatus($status)

        ->latest()->paginate(5)->withQueryString();

        // return $admins;


        return view('admin.pages.admin.index', compact('admins'));

    }


    public function create()
    {
        return view('admin.pages.admin.create');

    }

    public function store(Request $request)
    {



        Validator::make($request->all(),[

            'name'=>['required', 'min:2'],
            'email'=>['required', 'email','unique:users'],
            'status'=>['required'],
            'role'=>['required'],
            'image'=>['nullable','image', 'mimes:png,jpg,jpeg'],
            'password'=>['required', 'min:4'],
            'password_confirmation'=>['required', 'same:password'],

        ])->validate();


        $admin =new User;
        $admin->name =$request->name;
        $admin->email =$request->email;
        $admin->status =$request->status;
        $admin->password =Hash::make($request->password);
        $admin->save();

        $admin->attachRole($request->role);


        if($request->hasFile('image')){

            $oldImage = $request->file('image');
            $newImage =$request->file('image')->hashName();
            Image::make($oldImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/users_avatar/' .$newImage ,100);
            $admin->avatar =$newImage;
        }
        $admin->save();
        return redirect()->route('admin.admins.index')->with('success',__('site.admin_added_successfully'));


    }


    public function edit($id)
    {
        $admin = User::whereRoleIs(['admin', 'moderator'])->with(['roles'])->findOrFail($id);


        $roles = Role::whereIn('name',['admin','moderator'])->get();

        return view('admin.pages.admin.edit', compact('admin','roles'));


    }

    public function update(Request $request, $id)
    {
        $admin = User::whereRoleIs(['admin', 'moderator'])->with(['roles'])->findOrFail($id);



        Validator::make($request->all(),[

            'name'=>['required', 'min:2'],
            'email'=>['required', 'email',Rule::unique('users')->ignore($admin->id)],
            'status'=>['required'],
            'role'=>['required'],
            'image'=>['nullable','image', 'mimes:png,jpg,jpeg'],
            'password'=>['nullable', 'min:4','same:password_confirmation'],
            'password_confirmation'=>['nullable', 'same:password'],

        ])->validate();


        $admin->name =$request->name;
        $admin->email =$request->email;
        $admin->status =$request->status;

        if(!is_null($request->password)){
            $admin->password =Hash::make($request->password);
        }
        $admin->save();

        $admin->roles()->sync($request->role);


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
        return redirect()->route('admin.admins.index')->with('success',__('site.admin_updated_successfully'));

    }


    public function destroy($id)
    {
        $admin = User::whereRoleIs(['admin', 'moderator'])->with(['roles'])->findOrFail($id);
        if(!is_null($admin->avatar)){
            Storage::disk('public_uploads')->delete('users_avatar/'.$admin->avatar);
        }
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success',__('site.admin_deleted_successfully'));

    }
}
