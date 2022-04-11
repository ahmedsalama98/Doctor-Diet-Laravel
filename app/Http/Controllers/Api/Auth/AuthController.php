<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;


class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except(['login','signUp']);
    }
// login
    public function login(Request $request){


        $validator =Validator::make($request->all(),[
            'email'=>['required','email'],
            'password'=>['required','string','min:6'],

        ]);

        if($validator->fails()){
            return $this->sendErrors($validator->errors()->toArray(), 'error');
        }


        if(Auth::attempt(['email'=>$request->email , 'password'=>$request->password])){


            $token = $request->user()->createToken($request->user()->email);
            $data =[

                'user'=> new UserResource($request->user()),
                'token'=>$token->plainTextToken

            ];

            return $this->sendResponse($data, 'done',201);
        }


        return $this->sendErrors(['email'=>[__('auth.failed')]], 'error');


    }

    // login
// signUp

    public function signUp(Request $request){



        // return $request->all();

        $validator =Validator::make($request->all(),[
            'email'=>['required','email','unique:users'],
            'name'=>['required','string','min:2'],
            'password'=>['required','string','min:6'],
            'password_confirmation'=>['required','string','min:6','same:password'],
            'birth_date'=>['required','date' ],
            'daily_use_target'=>['required','integer','min:100' ],
            'height'=>['required','integer','min:100'],
            'weight'=>['required','integer','min:20' ],
            'receive_email'=>['nullable',],
            'gender'=>['nullable', ],
            'image'=>['nullable','image', 'mimes:png,jpg,jpeg'],
        ]);


        if($validator->fails()){
            return $this->sendErrors($validator->errors()->toArray(), 'error' , 301);
        }
        $user =new User;
        $user->name =$request->name;
        $user->email =$request->email;
        $user->birth_date =$request->birth_date;
        $user->receive_email =$request->receive_email;
        $user->height =$request->height;
        $user->daily_use_target =$request->daily_use_target;

        if( $request->gender == 1 ||$request->gender ==0){
            $user->gender =$request->gender;

        }
        $user->password =Hash::make($request->password);
        $user->save();

        $user_Weight  = new UserWeight;
        $user_Weight->user_id = $user->id;
        $user_Weight->weight = $request->weight;
        $user_Weight->save();

        if($request->hasFile('image')){

            $oldImage = $request->file('image');
            $newImage =$request->file('image')->hashName();
            Image::make($oldImage)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/users_avatar/' .$newImage ,100);
            $user->avatar =$newImage;
        }

        $user->save();

            $token =  $user->createToken($user->email);
            $data =[
                'user'=>   new UserResource($user),
                'token'=>$token->plainTextToken

            ];

            return $this->sendResponse($data, 'signup done',201);



        return $this->sendErrors([], 'error');


    }

// signUp
// editInfo

    public  function editInfo(Request $request) {


        $validator =Validator::make($request->all(),[
            'email'=>['required','email',Rule::unique('users')->ignore($request->user()->id)],
            'name'=>['required','string','min:2'],
            'birth_date'=>['required','date' ],
            'daily_use_target'=>['required','integer','min:100' ],
            'height'=>['required','integer','min:100'],
            'receive_email'=>['nullable',],
            'gender'=>['nullable', ],

        ]);

        if($validator->fails()){
            return $this->sendErrors($validator->errors()->toArray(), 'error' , 301);
        }


        $user =$request->user();
        $user->name =$request->name;
        $user->email =$request->email;
        $user->birth_date =$request->birth_date;
        $user->receive_email =$request->receive_email;
        $user->height =$request->height;
        $user->daily_use_target =$request->daily_use_target;

        if( $request->gender == 1 ||$request->gender ==0){
            $user->gender =$request->gender;

        }
        $user->save();

        $data =[
            'user'=>new UserResource($request->user())
        ];

        return $this->sendResponse($data, 'done',200);

    }
    // editInfo
    // user
    public function user(Request $request){

        // return app()->getLocale();

        $data =[
            'user'=>new UserResource($request->user())
        ];

        return $this->sendResponse($data, 'done',200);
    }

    // user

    //  updatePassword
    public function updatePassword (Request $request ){

        $validator =Validator::make($request->all(),[
            'old_password'=>['required','min:8',],
            'new_password'=>['required','min:8',],
            'new_password_confirmation'=>['required','min:8','same:new_password'],
        ]);

        if($validator->fails()){
            return $this->sendErrors($validator->errors()->toArray(), 'error' , 301);
        }

        $user =$request->user();

        if(!Hash::check($request->old_password ,$user->password )){
            $errors =[
                'old_password'=> [__('validation.wrong_old_password')]
            ];
            return $this->sendErrors($errors, 'error' , 301);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();
        return $this->sendResponse([], __('site.updated_successfully'),200);

    }

    // updatePassword

    // updateImage
    public function updateImage(Request $request){

        $validator =Validator::make($request->all(),[
            'image'=>['nullable','image', 'mimes:png,jpg,jpeg'],
        ]);

        if($validator->fails()){
            return $this->sendErrors($validator->errors()->toArray(), 'error' , 301);
        }

        $user =$request->user();
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


        return $this->sendResponse(['user'=> new UserResource($user)], __('site.updated_successfully'),200);

    }
    // updateImage




    // logOut
    public function logOut(Request $request){


        $request->user()->currentAccessToken()->delete();
        $data =[];

        return $this->sendResponse($data, __('site.logout_successfully'),200);
    }

    // logOut
}
