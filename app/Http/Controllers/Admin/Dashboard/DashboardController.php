<?php

namespace App\Http\Controllers\Admin\Dashboard;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Meal;
use App\Models\MealCategory;
use App\Models\User;
use Stevebauman\Location\Facades\Location;

class DashboardController extends Controller

{

    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('role:super-admin|admin|moderator');
    }
    public function index( Request $request){


        $users_count = User::whereDoesntHaveRole()->count();
        $admins_count =User::whereRoleIs(['admin', 'moderator','super-admin'])->count();
        $food_categories_count =FoodCategory::count();
        $foods_count =Food::count();
        $meal_categories_count =MealCategory::count();
        $meals_count =Meal::count();
        $contacts_count =Contact::count();


        $users_chart =User::selectRaw('COUNT(*) as count')
        ->selectRaw('MONTHNAME(created_at) as month')
        ->selectRaw('YEAR(created_at) as year')
        ->orderBy('created_at', 'desc')
        ->groupBy('month')
        ->limit(10)
        ->get();


        $users_chart_labels =[];
        $users_chart_data =[];

        foreach($users_chart as $chart){

            $users_chart_data[]= $chart->count;
            $users_chart_labels[] = $chart->month.' '.$chart->year;
        }
        return view('admin.pages.dashboard.index' , compact('users_chart_data','users_chart_labels','users_count','admins_count','foods_count','food_categories_count','meal_categories_count','meals_count','contacts_count'));
    }





}
