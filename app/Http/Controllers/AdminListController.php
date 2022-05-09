<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminListController extends Controller
{
    public function index(Request $r){

        //dd(Auth::user()->roles->pluck('name'));
        //$user = User::whereNull('password')->role('user')->get();
        if(Auth::user()->roles->first()->name == "user"){
            //dd(Auth::user()->roles->pluck('name'));
            $user = null;
            return view('userDashboard');
        }
        if(Auth::user()->roles->first()->name == "admin" || Auth::user()->roles->first()->name == "staff" || Auth::user()->roles->first()->name == "superadmin"){
            //$userData = User::with('roles')->get();
            $user = User::role('admin')->get();
            $staff = User::role('staff')->get();
            //dd($adminUser);
            return view('adminList', compact('user', 'staff'));
        }
    }

    public function sendEmail(Request $r){
        //dd($r->user_id);
        $user = User::find($r->user_id);

        User::where('id', $r->user_id)->update([
            "password" => Hash::make('12345678'),
            "kataLaluanText" => '12345678',
        ]);

        // $user->password = Hash::make('12345678');
        // $user->kataLaluanText = '12345678';
        // $user->save();

        Mail::to($user->email)->send(new SendEmail($user->email,'12345678' ));
        return redirect('/approval');
    }

    public function delete_user(Request $r){
        //dd($r->all());
        User::where('id', $r->user_id)->delete();

        return ["success" => "User Deleted"];
    }

    public function addPegawai(Request $r){
        //dd($r->all());
        $validateUser = User::where('email', $r->email)->first();

        if($validateUser){
            return redirect('/adminList')->with(['error' => 'Email already registered']);
        }
        $user =  User::create([
            'name' => $r->name,
            "email" => $r->email,
            "password" =>  $r->password ? Hash::make($r->password) : null,
        ]);

        $user->assignRole('admin');

        return redirect('/adminList')->with(['success' => 'Admin successfully added']);
    }

    public function addStaff(Request $r){
        //dd($r->all());
        $validateUser = User::where('email', $r->email)->first();

        if($validateUser){
            return redirect('/adminList')->with(['error' => 'Email already registered']);
        }

        $user =  User::create([
            'name' => $r->name,
            "email" => $r->email,
            "password" =>  $r->password ? Hash::make($r->password) : null,
        ]);

        $staff = DB::table('roles')->where('name', 'staff')->first(); //
        if($staff){
            //dd('ader staff');
            $user->assignRole('staff');
        }else{
            //dd('x der staff');
            $staff = Role::create(['name' => 'staff']);
            $user->assignRole('staff');
        }
        return redirect('/adminList')->with(['success' => 'Staff successfully added']);
    }
}
