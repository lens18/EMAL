<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MaterialCatergory;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                "name" => "KABEL DAN AKSESORI PENDAWAIAN",
                "sub_category" => [

                    ["name" => "CABLES",
                        "material" => [
                             //material Name
                            [  "name" =>"PVC INSULATED CABLE (ARMOURED ) (ALUMINIUM)"],
                            [  "name" =>"MV CABLE"],
                            [  "name" =>"XLPE INSULATED, PVC SHEATHED POWER CABLES (ARMOURED)(ALUMINIUM)"],
                            [  "name" =>"PVC INSULATED CABLE (ARMOURED & NON ARMOURED"],
                            [  "name" =>"XLPE INSULATED, PVC SHEATHED POWER CABLES (ARMOURED AND NON ARMOURED)"],
                            [  "name" =>"FIRE RESISTANT CABLE"]
                        ]
                    ],

                    ["name" => "SWITCHES",
                        "material" => [
                             //material Name
                            [  "name" =>"SWITCHES (BIG ROCKER)"],
                            [  "name" =>"SWITCHES"],
                            [  "name" =>"FIREMAN SWITCH"]
                        ]
                    ],

                ]
            ]

        ];

        foreach ($category as $key => $value) {
            //dd($value['name']);
            $newCategory = Category::create(['name' =>$value['name'] ]);
            foreach ($value['sub_category'] as $subCategory){
                $newSubCategory = SubCategory::create(['category_id' =>  $newCategory->id, "name" => $subCategory['name'] ]);
                foreach ($subCategory['material'] as $material){
                    MaterialCatergory::create(['sub_category_id' => $newSubCategory->id, "name" => $material['name'] ]);
                }
            }
        }
    }
}
