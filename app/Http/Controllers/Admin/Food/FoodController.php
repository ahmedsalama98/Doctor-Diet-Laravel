<?php

namespace App\Http\Controllers\Admin\Food;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\FoodMedia;
use App\Models\MealCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class FoodController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super-admin|admin|moderator']);
        $this->middleware('permission:foods-read')->only('index');
        $this->middleware('permission:foods-create')->only('create');
        $this->middleware('permission:foods-update')->only(['update','edit']);
        $this->middleware('permission:foods-delete')->only('destroy');

    }

    public function index(Request $request)
    {

        $status = isset($request->status) && $request->status == 0?0:1;

        $food_categories = FoodCategory::whereStatus(1)->get();

        $foods = Food::
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
        ->with(['media','category','meals'])
        ->latest()->paginate(5)->withQueryString();




        return view('admin.pages.food.index', compact('foods','food_categories'));

    }


    public function create()
    {

        $food_categories = FoodCategory::whereStatus(1)->get();
        return view('admin.pages.food.create',compact('food_categories'));

    }

    public function store(Request $request)
    {


         Validator::make($request->all(),[
            'name_ar'=>['required', 'min:2','unique:foods'],
            'name_en'=>['required','min:2' ,'unique:foods'],
            'description_ar'=>['required','min:2'],
            'description_en'=>['required','min:2'],
            'calories'=>['required','integer'],
            'unit'=>['required',Rule::in(['gm','cup','one'])],
            'category_id'=>['required','integer'],
            'images.*'=>['required','image', 'mimes:png,jpg,jpeg'],
            'images.0'=>['required','image', 'mimes:png,jpg,jpeg'],
            'status'=>['required'],

        ])->validate();





        $food =new Food;
        $food->name_ar =$request->name_ar;
        $food->name_en =$request->name_en;
        $food->description_ar =$request->description_ar;
        $food->description_en =$request->description_en;
        $food->status =$request->status;
        $food->calories =$request->calories;
        $food->unit =$request->unit;
        $food->category_id =$request->category_id;


        $food->save();

        if($request->has('images')){


            foreach($request->images as $image){

                $oldImage = $image;
                $newImage =$image->hashName();

                Image::make($oldImage)->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploads/food_media/' .$newImage ,100);

                $food_media = new FoodMedia;

                $food_media->file_name =$newImage;
                $food_media->food_id =$food->id;
                $food_media->save();

            }

        }

        return redirect()->route('admin.foods.index')->with('success',__('site.food_added_successfully'));


    }


    public function edit($id)
    {
        $food = Food::findOrFail($id);

        $food_categories = FoodCategory::whereStatus(1)->get();

        return view('admin.pages.food.edit', compact('food','food_categories'));


    }

    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id);



        Validator::make($request->all(),[
            'name_ar'=>['required', 'min:2',Rule::unique('foods')->ignore($food->id)],
            'name_en'=>['required','min:2' ,Rule::unique('foods')->ignore($food->id)],
            'description_ar'=>['required','min:2'],
            'description_en'=>['required','min:2'],
            'calories'=>['required','integer'],
            'unit'=>['required',Rule::in(['gm','cup','one'])],
            'category_id'=>['required','integer'],
            'images.*'=>['required','image', 'mimes:png,jpg,jpeg'],
            'status'=>['required'],

        ])->validate();


        $food->name_ar =$request->name_ar;
        $food->name_en =$request->name_en;
        $food->description_ar =$request->description_ar;
        $food->description_en =$request->description_en;
        $food->status =$request->status;
        $food->calories =$request->calories;
        $food->unit =$request->unit;
        $food->category_id =$request->category_id;


        $food->save();


        if($request->has('images')){

            foreach($food->media as $media){
                Storage::disk('public_uploads')->delete('food_media/'.$media->file_name);
                $media->delete();

            }

            foreach($request->images as $image){

                $oldImage = $image;
                $newImage =$image->hashName();

                Image::make($oldImage)->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('uploads/food_media/' .$newImage ,100);

                $food_media = new FoodMedia;

                $food_media->file_name =$newImage;
                $food_media->food_id =$food->id;
                $food_media->save();

            }



        }
        return redirect()->route('admin.foods.index')->with('success',__('site.food_updated_successfully'));

    }


    public function destroy($id)
    {
        $food = Food::findOrFail($id);
        foreach($food->media as $media){
            Storage::disk('public_uploads')->delete('food_media/'.$media->file_name);
            $media->delete();

        }

        $food->delete();
        return redirect()->route('admin.foods.index')->with('success',__('site.food_deleted_successfully'));

    }
}
