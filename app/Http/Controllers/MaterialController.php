<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Material;
use App\Models\MaterialCatergory;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $r){
        $category = Category::all();
        $subCategory = SubCategory::all();
        $materialCategory = MaterialCatergory::all();

        return view('addCategory', compact('category', 'subCategory', 'materialCategory'));
    }

    public function add_category(Request $r){
        if($r->addkategori != null){
            Category::create([
                'name' => $r->addkategori
            ]);
        }

        if($r->addsubkategori != null){
            //dd($r->kategori);
            SubCategory::create([

                'category_id' => $r->kategori,
                'name' => $r->addsubkategori
            ]);

        }

        if($r->addnamaBahan != null){
            //dd($r->subkategori);

            MaterialCatergory::create([
                'sub_category_id' => $r->subkategori,
                'name' => $r->addnamaBahan
            ]);

        }
        //return ["success" => "Category Added"];
        return redirect('/view_category')->with(['success' => 'Category Added']);
    }

    public function remove_category(Request $r){

        $category =  Category::where('id', $r->category_id)->first();
        $sC = SubCategory::where('category_id', $category->id)->get();
        foreach($sC as $subCategory){
            MaterialCatergory::where('sub_category_id', $subCategory->id)->delete();
            $subCategory->delete();
        }
        $category->delete();

        return ["success" => "Category Deleted"];
    }

    public function remove_subCategory(Request $r){

        $subCategory_id = SubCategory::where('id', $r->subCategory_id)->first();
        $material = MaterialCatergory::where('sub_category_id', $subCategory_id->id)->get();
        $material->each->delete(); // delete material under subcategory
        $subCategory_id->delete(); //delete sub category

        return ["success" => "Category Deleted"];
    }

    public function remove_materialCategory(Request $r){

        MaterialCatergory::where('id', $r->materialCategory_id)->delete();

        return ["success" => "Category Deleted"];
    }

    public function changeStatus(Request $r){

       $material=  Material::where('id', $r->id)->first();

       if($material){

            switch ($r->status) {
                case 'Terima':
                    $material->status = 'Terima';
                    break;
                case 'Tidak Terima':
                    $material->status = 'Tidak Terima';
                    break;
            }
            $material->save();
            return $material;
       }

       return "error";
    }



}
