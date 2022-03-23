<?php

namespace App\Http\Controllers\Admin\Meal;
use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use App\Models\MealCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MealCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'role:super-admin|admin|moderator']);
        $this->middleware('permission:meal_categories-read')->only('index');
        $this->middleware('permission:meal_categories-create')->only('create');
        $this->middleware('permission:meal_categories-update')->only(['update','edit']);
        $this->middleware('permission:meal_categories-delete')->only('destroy');

    }

    public function index(Request $request)
    {

        $status = isset($request->status) && $request->status == 0?0:1;

        $meal_categories = MealCategory::
        where(function($query)use($request){
            return $query->when($request->search ,function($q ) use($request){
                return $q->where('name_ar' ,'like' , '%'.$request->search.'%')
                        ->orWhere('name_en' ,'like' , '%'.$request->search.'%');
            });

        })

        ->whereStatus($status)
        ->latest()->paginate(5)->withQueryString();



        return view('admin.pages.meal_category.index', compact('meal_categories'));

    }


    public function create()
    {
        return view('admin.pages.meal_category.create');

    }

    public function store(Request $request)
    {


        Validator::make($request->all(),[
            'name_ar'=>['required', 'min:2','unique:meal_categories'],
            'name_en'=>['required','min:2' ,'unique:meal_categories'],
            'description_ar'=>['required','min:2'],
            'description_en'=>['required','min:2'],
            'image'=>['required','image', 'mimes:png,jpg,jpeg'],
            'status'=>['required'],

        ])->validate();


        $category =new MealCategory;
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
            })->save('uploads/meal_categories/' .$newImage ,100);
            $category->file_name =$newImage;
        }
        $category->save();
        return redirect()->route('admin.meal_categories.index')->with('success',__('site.meal_category_added_successfully'));


    }


    public function edit($id)
    {
        $category = MealCategory::findOrFail($id);

        return view('admin.pages.meal_category.edit', compact('category'));


    }

    public function update(Request $request, $id)
    {
        $category = MealCategory::findOrFail($id);



        Validator::make($request->all(),[
            'name_ar'=>['required', 'min:2',Rule::unique('meal_categories')->ignore($category->id)],
            'name_en'=>['required','min:2' ,Rule::unique('meal_categories')->ignore($category->id)],
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
            })->save('uploads/meal_categories/' .$newImage ,100);
            Storage::disk('public_uploads')->delete('meal_categories/'.$category->file_name);
            $category->file_name =$newImage;
        }
        $category->save();
        return redirect()->route('admin.meal_categories.index')->with('success',__('site.meal_category_updated_successfully'));

    }


    public function destroy($id)
    {
        $category = MealCategory::findOrFail($id);

        if(!is_null($category->file_name)){
            Storage::disk('public_uploads')->delete('meal_categories/'.$category->file_name);
        }
        $category->delete();
        return redirect()->route('admin.meal_categories.index')->with('success',__('site.meal_category_deleted_successfully'));

    }
}
