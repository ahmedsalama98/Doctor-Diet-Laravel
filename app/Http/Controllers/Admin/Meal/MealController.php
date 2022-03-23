<?php

namespace App\Http\Controllers\Admin\Meal;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\FoodMedia;
use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\MealMedia;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MealController extends Controller
{ public function __construct()
    {
        $this->middleware(['auth', 'role:super-admin|admin|moderator']);
        $this->middleware('permission:meals-read')->only('index');
        $this->middleware('permission:meals-create')->only('create');
        $this->middleware('permission:meals-update')->only(['update','edit']);
        $this->middleware('permission:meals-delete')->only('destroy');

    }

    public function index(Request $request)
    {

        $status = isset($request->status) && $request->status == 0?0:1;

        $meal_categories = MealCategory::whereStatus(1)->get();

        $meals = Meal::
        where(function($query)use($request){
            return $query->when($request->search ,function($q,$search ){
                return $q->where('name_ar' ,'like' , '%'.$search.'%')
                        ->orWhere('name_en' ,'like' , '%'.$search.'%');
            });

        })

        ->where(function($query)use($request){
            return $query->when($request->category_id ,function($q,$category_id ){
                return $q->where('category_id' ,$category_id);

            });

        })




        ->whereStatus($status)
        ->with(['first_media','category','foods'])
        ->latest()->paginate(5)->withQueryString();




        return view('admin.pages.meal.index', compact('meals','meal_categories'));

    }


    public function create()
    {

        $meal_categories = MealCategory::whereStatus(1)->get();
        $food_categories = FoodCategory::with(['foods'])->whereStatus(1)->get();


        $food_categories = collect($food_categories)->filter(function($category){

            return count($category->foods) > 0;
        });

        return view('admin.pages.meal.create',compact('meal_categories','food_categories'));

    }

    public function store(Request $request)
    {





         Validator::make($request->all(),[
            'name_ar'=>['required', 'min:2','unique:meals'],
            'name_en'=>['required','min:2' ,'unique:meals'],
            'description_ar'=>['required','min:2'],
            'description_en'=>['required','min:2'],
            'category_id'=>['required','integer'],
            'images.*'=>['required','image', 'mimes:png,jpg,jpeg'],
            'images.0'=>['required','image', 'mimes:png,jpg,jpeg'],
            'foods'=>['required','array','min:1'],
            'status'=>['required'],

        ])->validate();

        // if(!isset($request->foods) ||count($request->foods) < 1){
        //     return redirect()->back()->withErrors(['foods'=>'error'])->withInput($request->all());
        // }




        $meal =new Meal;
        $meal->name_ar =$request->name_ar;
        $meal->name_en =$request->name_en;
        $meal->description_ar =$request->description_ar;
        $meal->description_en =$request->description_en;
        $meal->status =$request->status;
        $meal->category_id =$request->category_id;


        $meal->save();




        if($request->has('images')){


            foreach($request->images as $image){
                $oldImage = $image;
                $newImage =$image->hashName();

                Image::make($oldImage)->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploads/meal_media/' .$newImage ,100);

                $meal_media = new MealMedia;

                $meal_media->file_name =$newImage;
                $meal_media->meal_id =$meal->id;
                $meal_media->save();

            }

        }
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

        return redirect()->route('admin.meals.index')->with('success',__('site.meal_added_successfully'));


    }


    public function edit($id)
    {
        $meal = Meal::with('foods')->findOrFail($id);


        $meal_categories = MealCategory::whereStatus(1)->get();
        $food_categories = FoodCategory::with(['foods'])->whereStatus(1)->get();


        $food_categories = collect($food_categories)->filter(function($category){

            return count($category->foods) > 0;
        });



        return view('admin.pages.meal.edit', compact('meal','food_categories','meal_categories'));


    }

    public function update(Request $request, $id)
    {
        $meal = Meal::findOrFail($id);



        Validator::make($request->all(),[
            'name_ar'=>['required', 'min:2',Rule::unique('meals')->ignore($meal->id)],
            'name_en'=>['required','min:2' ,Rule::unique('meals')->ignore($meal->id)],
            'description_ar'=>['required','min:2'],
            'description_en'=>['required','min:2'],
            'category_id'=>['required','integer'],
            'images.*'=>['required','image', 'mimes:png,jpg,jpeg'],
            'foods'=>['required','array','min:1'],
            'status'=>['required'],

        ])->validate();


        $meal->name_ar =$request->name_ar;
        $meal->name_en =$request->name_en;
        $meal->description_ar =$request->description_ar;
        $meal->description_en =$request->description_en;
        $meal->status =$request->status;
        $meal->category_id =$request->category_id;


        $meal->save();




        if($request->has('images')){
            foreach($meal->media as $media){
                Storage::disk('public_uploads')->delete('meal_media/'.$media->file_name);
                $media->delete();

            }

            foreach($request->images as $image){
                $oldImage = $image;
                $newImage =$image->hashName();

                Image::make($oldImage)->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploads/meal_media/' .$newImage ,100);

                $meal_media = new MealMedia;

                $meal_media->file_name =$newImage;
                $meal_media->meal_id =$meal->id;
                $meal_media->save();

            }



        }
        $meal->foods()->sync($request->foods);


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
        return redirect()->route('admin.meals.index')->with('success',__('site.meal_updated_successfully'));

    }


    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);
        foreach($meal->media as $media){
            Storage::disk('public_uploads')->delete('meal_media/'.$media->file_name);
            $media->delete();
        }

        $meal->delete();
        return redirect()->route('admin.meals.index')->with('success',__('site.meal_deleted_successfully'));

    }
}
