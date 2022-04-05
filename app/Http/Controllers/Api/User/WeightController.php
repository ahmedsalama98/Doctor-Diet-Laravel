<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\UserWeight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeightController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request){


        $data =[
            'weights'=> $request->user()->weights,
        ];
        return $this->sendResponse($data, __('site.logout_successfully'),200);

    }

    public function create(Request $request){


        $validator =Validator::make($request->all(),[
            'weight'=>['required','numeric','min:20' ],
        ]);


        if($validator->fails()){
            return $this->sendErrors($validator->errors()->toArray(), 'error' , 301);
        }

        $user = $request->user();
        $weight = new UserWeight ;
        $weight->user_id =$user->id;
        $weight->weight = $request->weight;
        $weight->save();

        $data =[
            'weight'=> $weight,
            'user'=> new UserResource($user)
        ];
        return $this->sendResponse($data, __('done'),200);

    }



    public function destroy(Request $request , $id){


        // return 'done';
        $weight = UserWeight::where('user_id',$request->user()->id )->find($id);

        if(is_null($weight) ){
            return $this->sendErrors([], 'unAuthorized' , 401);
        }
        $weight->delete();
        $data =[
            'user'=> new UserResource($request->user())

        ];
        return $this->sendResponse($data, __('deleted'),200);

    }

}
