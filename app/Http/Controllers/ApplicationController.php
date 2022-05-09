<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    public function view_application(Request $r){
        $user = User::find($r->user_id);
        //dd($user->comment);
        return view('viewApplication', compact('user'));
    }

    public function index(Request $r){

        //dd(Auth::user()->roles->pluck('name'));
        //$user = User::whereNull('password')->role('user')->get();
        if(Auth::user()->roles->first()->name == "user"){
            //dd(Auth::user()->roles->pluck('name'));
            $user = null;
            return view('userDashboard');
        }
        if(Auth::user()->roles->first()->name == "admin"){
            $user = User::whereNull('password')->role('user')->get();
            //dd($user);
            return view('approval', compact('user'));
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

    // public function approve_user(Request $r){
    //     User::where('id', $r->user_id)->delete();

    //     return ["success" => "User Deleted"];
    // }
}
