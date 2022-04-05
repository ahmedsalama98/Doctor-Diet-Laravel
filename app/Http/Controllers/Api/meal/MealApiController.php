<?php

namespace App\Http\Controllers\Api\Meal;

use App\Http\Controllers\Controller;
use App\Http\Resources\MealResource;
use App\Http\Resources\UserResource;
use App\Models\Food;
use App\Models\MealCategory;
use App\Models\UserMeal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MealApiController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->except('getMealsCategory');
    }


    public function getMealsCategory(Request $request){
        $categories = MealCategory::whereStatus(1)->get();
        $data =[
            'categories'=>$categories
        ];
        return $this->sendResponse($data, __('done'),200);

    }

    public function getTodayMeals(Request $request){
        $meals = $request->user()->today_meals;
        $data =[
            'meals'=>MealResource::collection($meals)
        ];
        return $this->sendResponse($data, __('done'),200);


    }

    public function getMeals(Request $request){

        $meals =UserMeal::whereUserId($request->user()->id)->with(['category','foods'])
       -> where(
            'created_at', '>', Carbon::now()->subMonth()->toDateTimeString()
        )
        ->where('created_at','<',Carbon::now()->today()->toDateString())
        ->latest('created_at','DESC')->get();

        $meals = MealResource::collection($meals);

        $data =[
            'meals'=>$meals->groupBy(function($data ) {
                return $data->created_at->format('Y-m-d');
            }),
        ];

        return $this->sendResponse($data, __('done'),200);

    }

    public function storeUserMeal(Request $request){


        $meal = new UserMeal ;
        $meal->user_id =$request->user()->id;
        $meal->category_id =$request->category_id;
        $meal->save();
        $meal->foods()->attach($request->foods);
        $calories =0;
        foreach ($request->foods as $key =>$value){
            $food =Food::find($key);
            if($food->unit =='gm'){

                $calories += ($value['quantity']/100) *$food->calories;
            }else{
                $calories += $value['quantity'] *$food->calories;
            }
        }
        $meal->calories =$calories;
        $meal->save();

        $data =[

            'user'=> new UserResource($request->user())
        ];
        return $this->sendResponse($data, __('done'),201);

    }

    public function destroy(Request $request , $id){


        $meal = UserMeal::where('user_id',$request->user()->id )->find($id);

        if(is_null($meal) ){
            return $this->sendErrors([], 'unAuthorized' , 401);
        }
        $meal->delete();
        $data =[
            'user'=> new UserResource($request->user())
        ];
        return $this->sendResponse($data, __('deleted'),200);

    }





}
