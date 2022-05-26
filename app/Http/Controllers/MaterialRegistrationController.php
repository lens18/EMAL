<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Category;
use App\Models\Material;
use App\Models\MaterialCatergory;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class MaterialRegistrationController extends Controller
{
    public function index(Request $r){
        if(Auth::user()->roles->first()->name == "user"){
            $material = Material::where('user_id', Auth::user()->id)
            ->with(['categori', 'subCategori'])->distinct()
            ->get(['kategori', 'subKategori']);

            return view('viewMaterial')->with('material', $material);
        }

        if(Auth::user()->roles->first()->name == "superadmin" || Auth::user()->roles->first()->name == "admin"){
            //$material = Material::with(['categori', 'subCategori'])->distinct()->get(['kategori', 'subKategori']);
            $material = Material::with(['categori', 'subCategori'])->distinct()
            ->get(['kategori', 'subKategori']);
            //dd($material);
            return view('viewMaterial')->with('material', $material);
        }

    }

    public function approved_material(Request $r){
        if(Auth::user()->roles->first()->name == "user"){
            //$material = Material::where('user_id', Auth::user()->id)->distinct()->get(['namaBahan']);

            $material = Material::where(['user_id' => Auth::user()->id, 'subKategori' => $r->item_sub])
            ->with(['materialCategori'])->distinct()
            ->get(['namaBahan']);

            //dd($material);
            return view('barang.LBarang')->with('material', $material);
        }

        if(Auth::user()->roles->first()->name == "superadmin" || Auth::user()->roles->first()->name == "admin"){
            //$material = Material::distinct()->get(['namaBahan']);

            $material = Material::where('subKategori' , $r->item_sub)
            ->with(['materialCategori'])->distinct()
            ->get(['namaBahan']);
            return view('barang.LBarang')->with('material', $material);
        }

    }

    public function details_material(Request $r){

        //dd($r->item_name);
        if(Auth::user()->roles->first()->name == "user"){

            $material = Material::where(['user_id'=> Auth::user()->id , 'namaBahan'=> $r->item_name])
            ->with(['materialCategori'])->distinct()
            ->get();

            //dd($material);
            return view('barang.Barang')->with('material', $material);
        }

        if(Auth::user()->roles->first()->name == "superadmin" || Auth::user()->roles->first()->name == "admin"){
            //$material = Material::distinct()->get(['id','namaBahan','namaPengilang','jenama','negaraPengilang']);

            $material = Material::where('namaBahan' , $r->item_name)
            ->with(['materialCategori'])->distinct()
            ->get();

            //dd($material);
            return view('barang.Barang')->with('material', $material);
        }

    }

    public function info_material(Request $r){
        if(Auth::user()->roles->first()->name == "user"){
            $material = Material::where('user_id', Auth::user()->id)->where('id', $r->item_id)
            ->with(['materialCategori'])->first();
            $user = User::where('id', $material->user_id)->first();

            return view('barang.detailBarang')
            ->with('material', $material)
            ->with('user', $user);
        }

        if(Auth::user()->roles->first()->name == "superadmin" || Auth::user()->roles->first()->name == "admin"){
            $material = Material::where('id', $r->item_id)
            ->with(['materialCategori'])->first();
            $user = User::where('id', $material->user_id)->first();

            return view('barang.detailBarang')
            ->with('material', $material)
            ->with('user', $user);
        }
    }

    public function sijil(Request $r){
        if(Auth::user()->roles->first()->name == "superadmin" || Auth::user()->roles->first()->name == "admin" || Auth::user()->roles->first()->name == "user"){
            $material = Material::where('id', $r->item_id)
            ->with(['materialCategori'])->first();
            $user = User::where('id', $material->user_id)->first();

            return view('barang.sijilKelulusan')
            ->with('material', $material)
            ->with('user', $user);
        }
    }

    public function materialRegistration(Request $request){

        $category = Category::all();
        $subCategory = SubCategory::all();
        $materialCategory = MaterialCatergory::all();

        return view('materialRegistration', compact('category', 'subCategory', 'materialCategory'));
    }

    public function register_material(Request $r) {
        //$userData = $r->all();

        //dd($r->all());
        //dd(Auth::user()->id);
        // if (Material::where('model', '=', $r->model)->exists()) {
        //     return redirect('/material_registration')->with('error','model already exists');
        // }

        $material = Material::create(['user_id'=> Auth::user()->id]);

        $kategory = explode(",",$r->kategori);


        //dd($kategory);
        $material->kategori = $kategory[0];
        $material->subkategori = $r->subkategori;
        $material->namaBahan = $r->namaBahan;
        $material->jenama = $r->jenama;
        $material->namaPengilang = $r->namaPengilang;
        $material->alamatPengilang = $r->alamatPengilang;
        $material->negaraPengilang = $r->negaraPengilang;
        $material->model = $r->model;
        $material->ratedVoltage = $r->ratedVoltage;
        $material->size = $r->size;
        $material->coreNo = $r->coreNo;
        $material->status = 'Pending';

        if($r->has('perakuan'))
        {
            $material->perakuan = 'yes';
        }else
        {
            $material->perakuan = 'no';
        }
        $material->save();


        //Upload Letter Head
        if($letterhead_file = $r->hasFile('leter_head')) {

            $letterhead_file = $r->file('leter_head') ;

            $letterhead_fileName = Carbon::now()->timestamp."_".$letterhead_file->getClientOriginalName(); //get file original name

            $letterheadRW = str_replace(" ","", $letterhead_fileName); //replace white space
            $letterheadRD = strtolower(str_replace("-","_", $letterheadRW)); //replace "-" "_"

            $destinationPath = public_path().'/document/letter head'; //folder nak simpan file
            $letterhead_file->move($destinationPath,$letterheadRD); // simpankan file

            Attachment::create([
                'user_id' => Auth::user()->id,
                'doc_type' => 'Letter Head',
                'attachment_status' => 'Applied',
                'upload_date' => Carbon::now()->toDateString(),
                'doc_path' => '/document/letter head/'.$letterheadRD,
            ]);
        }


        //Upload Borang Akuan
        if($borang_akuan_file = $r->hasFile('borang_akuan')) {

            $borang_akuan_file = $r->file('borang_akuan') ;

            $borang_akuan_fileName = Carbon::now()->timestamp."_".$borang_akuan_file->getClientOriginalName(); //get file original name

            $borang_akuanRW = str_replace(" ","", $borang_akuan_fileName); //replace white space
            $borang_akuanRD = strtolower(str_replace("-","_", $borang_akuanRW)); //replace "-" "_"

            $destinationPath = public_path().'/document/borang akuan'; //folder nak simpan file
            $borang_akuan_file->move($destinationPath,$borang_akuanRD); // simpankan file

            Attachment::create([
                'user_id' => Auth::user()->id,
                'doc_type' => 'Borang Akuan',
                'attachment_status' => 'Applied',
                'upload_date' => Carbon::now()->toDateString(),
                'doc_path' => '/document/borang akuan/'.$borang_akuanRD,
            ]);
        }


        //Upload Sijil SIRIM
        if($sijilSirim_file = $r->hasFile('sijil_sirim')) {

            $sijilSirim_file = $r->file('sijil_sirim') ;

            $sijilSirim_fileName = Carbon::now()->timestamp."_".$sijilSirim_file->getClientOriginalName(); //get file original name

            $sijilSirim_RW = str_replace(" ","", $sijilSirim_fileName); //replace white space
            $sijilSirim_RD = strtolower(str_replace("-","_", $sijilSirim_RW)); //replace "-" "_"

            $destinationPath = public_path().'/document/sijil sirim'; //folder nak simpan file
            $sijilSirim_file->move($destinationPath,$sijilSirim_RD); // simpankan file

            $attahment = Attachment::create([
                'user_id' => Auth::user()->id,
                'doc_type' => 'Sijil SIRIM',
                'attachment_status' => 'Applied',
                'upload_date' => Carbon::now()->toDateString(),
                'doc_path' => '/document/sijil sirim/'.$sijilSirim_RD,
            ]);
        }


        //Upload laporan Audit SIRIM
        if($auditSirim_file = $r->hasFile('audit_sirim')) {

            $auditSirim_file = $r->file('audit_sirim') ;

            $auditSirim_fileName = Carbon::now()->timestamp."_".$auditSirim_file->getClientOriginalName(); //get file original name

            $auditSirim_RW = str_replace(" ","", $auditSirim_fileName); //replace white space
            $auditSirim_RD = strtolower(str_replace("-","_", $auditSirim_RW)); //replace "-" "_"

            $destinationPath = public_path().'/document/audit sirim'; //folder nak simpan file
            $auditSirim_file->move($destinationPath,$auditSirim_RD); // simpankan file

            Attachment::create([
                'user_id' => Auth::user()->id,
                'doc_type' => 'Laporan Audit SIRIM',
                'attachment_status' => 'Applied',
                'upload_date' => Carbon::now()->toDateString(),
                'doc_path' => '/document/audit sirim/'.$auditSirim_RD,
            ]);
        }

        return redirect('/material_registration')->with(['success' => 'Material successfully registered']);
    }

    public function getSub(Request $r){
        //dd($r->all());
        if($r->category_id != 'Please Select Category'){
            $category = Category::find($r->category_id);
            if($category != null ){
               $subCategory= SubCategory::where('category_id', $category->id)->get();
               return [ "success" => $subCategory];
            }
        }

        return ['error' => "Category not exits"];

    }

    public function getMaterial(Request $r){
        //dd($r->all());
        if($r->sub_category_id != 'Please Select Category'){
            $sub_category = SubCategory::find($r->sub_category_id);
            if($sub_category != null ){
               $materialCategory= MaterialCatergory::where('sub_category_id', $sub_category->id)->get();
               return [ "success" => $materialCategory];
            }
        }

        return ['error' => "Category not exits"];

    }

}
