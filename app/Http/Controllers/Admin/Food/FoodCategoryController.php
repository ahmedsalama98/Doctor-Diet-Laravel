<?php

namespace App\Http\Controllers\Admin\Food;

use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FoodCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:super-admin|admin|moderator']);
        $this->middleware('permission:food_categories-read')->only('index');
        $this->middleware('permission:food_categories-create')->only('create');
        $this->middleware('permission:food_categories-update')->only(['update','edit']);
        $this->middleware('permission:food_categories-delete')->only('destroy');

    }

    public function index(Request $request)
    {

        $status = isset($request->status) && $request->status == 0?0:1;

        $food_categories = FoodCategory::
        where(function($query)use($request){
            return $query->when($request->search ,function($q ) use($request){
                return $q->where('name_ar' ,'like' , '%'.$request->search.'%')
                        ->orWhere('name_en' ,'like' , '%'.$request->search.'%');
            });

        })

        ->whereStatus($status)
        ->latest()->paginate(5)->withQueryString();



        return view('admin.pages.food_category.index', compact('food_categories'));

    }


    public function create()
    {
        return view('admin.pages.food_category.create');

    }

    public function store(Request $request)
    {


        Validator::make($request->all(),[
            'name_ar'=>['required', 'min:2','unique:food_categories'],
            'name_en'=>['required','min:2' ,'unique:food_categories'],
            'description_ar'=>['required','min:2'],
            'description_en'=>['required','min:2'],
            'image'=>['required','image', 'mimes:png,jpg,jpeg'],
            'status'=>['required'],

        ])->validate();


        $category =new FoodCategory;
        $category->name_ar =$request->name_ar;
        $category->name_en =$request->name_en;
        $category->description_ar =$request->description_ar;
        $category->description_en =$request->description_en;
        $category->status =$request->status;

        $category->save();


        if($request->hasFile('image')){

            $oldImage = $request->file('image');
            $newImage =$request->file('image')->hashName();
            Image::make($oldImage)->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/food_categories/' .$newImage ,100);
            $category->file_name =$newImage;
        }
        $category->save();
        return redirect()->route('admin.food_categories.index')->with('success',__('site.food_category_added_successfully'));


    }


    public function edit($id)
    {
        $category = FoodCategory::findOrFail($id);

        return view('admin.pages.food_category.edit', compact('category'));


    }

    public function update(Request $request, $id)
    {
        $category = FoodCategory::findOrFail($id);



        Validator::make($request->all(),[
            'name_ar'=>['required', 'min:2',Rule::unique('food_categories')->ignore($category->id)],
            'name_en'=>['required','min:2' ,Rule::unique('food_categories')->ignore($category->id)],
            'description_ar'=>['required','min:2'],
            'description_en'=>['required','min:2'],
            'image'=>['nullable','image', 'mimes:png,jpg,jpeg'],
            'status'=>['required'],
        ])->validate();


        $category->name_ar =$request->name_ar;
        $category->name_en =$request->name_en;
        $category->description_ar =$request->description_ar;
        $category->description_en =$request->description_en;
        $category->status =$request->status;

        $category->save();


        if($request->hasFile('image')){

            $oldImage = $request->file('image');
            $newImage =$request->file('image')->hashName();
            Image::make($oldImage)->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save('uploads/food_categories/' .$newImage ,100);
            Storage::disk('public_uploads')->delete('meal_categories/'.$category->file_name);
            $category->file_name =$newImage;
        }
        $category->save();
        return redirect()->route('admin.food_categories.index')->with('success',__('site.food_category_updated_successfully'));

    }


    public function destroy($id)
    {
        $category = FoodCategory::findOrFail($id);

        if(!is_null($category->file_name)){
            Storage::disk('public_uploads')->delete('food_categories/'.$category->file_name);
        }
        $category->delete();
        return redirect()->route('admin.food_categories.index')->with('success',__('site.food_category_deleted_successfully'));

    }
}
