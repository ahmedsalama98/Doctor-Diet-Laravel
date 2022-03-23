<?php

namespace Database\Seeders;

use App\Models\Food as FoodModel ;
use App\Models\FoodCategory;
use App\Models\FoodMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class food extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $food_categories =[
            [
                'name_ar'=>'خضراوات',
                'name_en'=>'vegetables',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'vegetables.jpg ',
            ],
            [
                'name_ar'=>'فاكهه',
                'name_en'=>'fruit',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'fruit.jpg ',
            ]
            ,
            [
                'name_ar'=>'عصائر',
                'name_en'=>'Juices',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'Juices.jpg ',

            ]
            ,
            [
                'name_ar'=>'مشروبات ساخنه',
                'name_en'=>'hot drinks',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'hot drinks.jpg ',
            ]
            ,
            [
                'name_ar'=>'مشروبات بارده',
                'name_en'=>'Cold drinks',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'Cold drinks.jpg ',
            ]
            ,
            [
                'name_ar'=>'لحوم',
                'name_en'=>'meat',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'meat.jpg ',
            ]

            ,
            [
                'name_ar'=>'اسماك',
                'name_en'=>'fish',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'fish.jpg ',
            ]


            ,
            [
                'name_ar'=>'بقوليات',
                'name_en'=>'legumes',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'legumes.jpg ',
            ]


            ,

            [
                'name_ar'=>'بيض',
                'name_en'=>'eggs',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'eggs.jpg ',
            ]
            ,
            [
                'name_ar'=>'البان وجبن',
                'name_en'=>'Cheese and dairy',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'Cheese and dairy.jpg ',
            ]
            ,
            [
                'name_ar'=>'حبوب',
                'name_en'=>'cereal',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'file_name'=>'cereal.jpg',
            ]

        ];

        FoodCategory::insert($food_categories);


        $foods =[

            [
            'data'=>[
                'name_ar'=>'ارز ابيض',
                'name_en'=>'White rice',
                'description_ar'=>'جيد',
                'description_en'=>'Good ',
                'category_id'=>11,
                'calories'=>130,
                'unit'=>'gm',
            ],
            'media'=>[
              'White rice-1.jpg',
              'White rice-2.jpg',
              'White rice-3.jpg',
            ]
            ],

            [
                'data'=>[
                    'name_ar'=>'سمك بلطي مشوي',
                    'name_en'=>'grilled tilapia',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>7,
                    'calories'=>144,
                    'unit'=>'one',
                ],
                'media'=>[
                  'grilled tilapia-1.jpg',
                  'grilled tilapia-2.jpg',
                ]
            ],
            [
                'data'=>[
                    'name_ar'=>'زبادي',
                    'name_en'=>'Yogurt',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>10,
                    'calories'=>59,
                    'unit'=>'gm',
                ],
                'media'=>[
                  'Yogurt-1.jpg',
                  'Yogurt-2.jpg',
                  'Yogurt-3.jpg',
                ]
            ],
            [
                'data'=>[
                    'name_ar'=>'لبن بقري',
                    'name_en'=>'cow milk',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>10,
                    'calories'=>104,
                    'unit'=>'cup',
                ],
                'media'=>[
                  'cow milk-1.jpg',
                  'cow milk-2.jpg',
                  'cow milk-3.jpg',
                ]
            ],
            [
                'data'=>[
                    'name_ar'=>'فراخ مشويه ',
                    'name_en'=>'Grilled chicken',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>6,
                    'calories'=>205,
                    'unit'=>'gm',
                ],
                'media'=>[
                  'Grilled chicken-1.jpg',
                  'Grilled chicken-2.jpg',
                  'Grilled chicken-3.jpg',
                ]
            ],

            [
                'data'=>[
                    'name_ar'=>'لحم بقري مشوي',
                    'name_en'=>'roast beef',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>6,
                    'calories'=>170,
                    'unit'=>'gm',
                ],
                'media'=>[
                  'roast beef-1.jpg',
                  'roast beef-2.jpg',
                  'roast beef-3.jpg',
                ]
            ],
            [
                'data'=>[
                    'name_ar'=>'بيض مسلوق ',
                    'name_en'=>'boiled eggs',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>9,
                    'calories'=>79,
                    'unit'=>'one',
                ],
                'media'=>[
                  'boiled eggs-1.jpg',
                  'boiled eggs-2.jpg',
                  'boiled eggs-3.jpg',
                ]
            ],
            [
                'data'=>[
                    'name_ar'=>'عجة البيض',
                    'name_en'=>'omelette',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>9,
                    'calories'=>155,
                    'unit'=>'gm',
                ],
                'media'=>[
                  'omelette-1.jpg',
                  'omelette-2.jpg',
                  'omelette-3.jpg',
                ]
            ],
            [
                'data'=>[
                    'name_ar'=>'عصير برتقال',
                    'name_en'=>'orange juice',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>3,
                    'calories'=>220,
                    'unit'=>'cup',
                ],
                'media'=>[
                  'orange juice-1.jpg',
                  'orange juice-2.jpg',
                  'orange juice-3.jpg',
                ]
            ],
            [
                'data'=>[
                    'name_ar'=>'موز ',
                    'name_en'=>'Banana',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>2,
                    'calories'=>190,
                    'unit'=>'one',
                ],
                'media'=>[
                  'Banana-1.jpg',
                  'Banana-2.jpg',
                  'Banana-3.jpg',
                ]
            ],
            [
                'data'=>[
                    'name_ar'=>'تفاح ',
                    'name_en'=>'Apple',
                    'description_ar'=>'جيد',
                    'description_en'=>'Good ',
                    'category_id'=>2,
                    'calories'=>70,
                    'unit'=>'one',
                ],
                'media'=>[
                  'Apple-1.jpg',
                  'Apple-2.jpg',
                  'Apple-3.jpg',
                ]
            ],



        ];



        foreach ( $foods as $food){


            $item =FoodModel::create($food['data']);
            foreach($food['media'] as $media){

                FoodMedia::create([
                  'file_name'=>$media,
                  'food_id'=>$item->id
                ]);
            }
        }












    }
}
