<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StaffListController extends Controller
{
    public function index(Request $r){
        if(Auth::user()->roles->first()->name == "admin"){
            $staff = User::role('staff')->get();
            //dd($user);
            return view('staffList', compact('staff'));
        }
    }
}
