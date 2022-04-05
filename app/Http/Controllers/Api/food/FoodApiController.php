<?php

namespace App\Http\Controllers\Api\Food;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class FoodApiController extends Controller
{



        // public function __construct()
        // {
        //     $this->middleware(['auth:sanctum']);
        // }



        public function index(Request $request ){
            $search = $request->search;
            $category_id = !is_null($request->category_id) && $request->category_id > 0 ? $request->category_id :null;
            $calories = !is_null($request->calories) && $request->calories > 0 ? $request->calories :null;

            // return is_int($request->category_id);
            $foods = Food::

            whereHas('category',function (Builder $query )use($search) {
                return $query->Where('name_ar', 'like', '%'.$search . '%')
                             ->orWhere('name_en', 'like', '%'.$search . '%');
            })
            ->where(function(Builder $q) use($category_id){
                return  $q ->when( $category_id  ,function (Builder $query ,$category_id  ) {
                 return $query->where('category_id',$category_id);
             });
            })

            ->where(function(Builder $q) use($calories){
                return  $q ->when( $calories  ,function (Builder $query ,$calories  ) {
                 return $query->where('calories','>=' ,$calories);
             });
            })

            ->when( $search  ,function (Builder $query ,$search  ) {
                return $query->orWhere('name_ar' ,'like', '%'.$search . '%')
                             ->orWhere('name_en' ,'like', '%'.$search . '%');
            })

            ->with(['first_media'])
            ->paginate(6);

            $data =[

                'foods'=>FoodResource::collection($foods->items()),
                'paginate'=>[
                    'total'=> $foods->total(),
                    'perPage'=> $foods->perPage(),
                    'currentPage'=> $foods->currentPage(),
                    'count'=> $foods->count(),
                    'hasPages'=> $foods->hasPages(),
                    'hasMorePages'=> $foods->hasMorePages(),
                    'lastPage'=> $foods->lastPage(),

                ]
            ];
            return $this->sendResponse($data, __('done'),200);

        }
        public function searchForAddNewMeal(Request $request ){
            $search = $request->search;
            $foods = Food::

            whereHas('category',function (Builder $query )use($search) {
                return $query->Where('name_ar', 'like', '%'.$search . '%')
                             ->orWhere('name_en', 'like', '%'.$search . '%');
            })
            ->orWhere(function (Builder $query )use($search) {
                return $query->orWhere('name_ar' ,'like', '%'.$search . '%')
                             ->orWhere('name_en' ,'like', '%'.$search . '%');
            })
            ->with(['first_media'])
            ->limit(10)
            ->get();

            $data =[

                'foods'=>FoodResource::collection($foods)
            ];
            return $this->sendResponse($data, __('done'),200);

        }


        public function getFoodById($id){

            $food = Food::find($id);

            if(!$food){
                return $this->sendErrors([],'NOT FOUND' ,404);
            }

            $data =[

                'food'=>new FoodResource($food)
            ];
            return $this->sendResponse($data, __('done'),200);
        }

        public function getFoodsCategories(){

            $categories = FoodCategory::whereStatus(1)->get();

            $data =[

                'categories'=>collect($categories)->map(function($category){
                    return [
                        'name'=>$category->name,
                        'description'=>$category->description,
                        'id'=>$category->id,
                    ];
                })
            ];
            return $this->sendResponse($data, __('done'),200);
        }

}
