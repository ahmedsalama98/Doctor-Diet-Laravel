<?php

namespace Database\Seeders;

use App\Models\MealCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class meal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meal_categories =[
            [
                'name_ar'=>'فطار',
                'name_en'=>'breakfast',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'breakfast.jpg ',
            ],
            [
                'name_ar'=>'غداء',
                'name_en'=>'lunch',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'lunch.jpg ',
            ]
            ,
            [
                'name_ar'=>'عشاء',
                'name_en'=>'dinner',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'dinner.jpg ',

            ]
            ,
            [
                'name_ar'=>'مشروبات',
                'name_en'=>'drinks',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'drinks.jpg ',
            ]
            ,
            [
                'name_ar'=>'وجبة خفيفة',
                'name_en'=>'snack',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'snack.jpg ',
            ]

        ];



        MealCategory::insert($meal_categories);
    }
}
