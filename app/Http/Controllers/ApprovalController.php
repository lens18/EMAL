<?php

namespace App\Http\Controllers;

use App\Mail\CheckEmail;
use App\Mail\RealRejectMail;
use App\Mail\RejectMail;
use App\Mail\SendEmail;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ApprovalController extends Controller
{
    public function index(Request $r){

        //dd(Auth::user()->roles->pluck('name'));
        //$user = User::whereNull('password')->role('user')->get();
        if(Auth::user()->roles->first()->name == "user"){
            //dd('user');
            //dd(Auth::user()->roles->pluck('name'));
            $user = null;
            return view('userDashboard');
        }

        if(Auth::user()->roles->first()->name == "admin" || Auth::user()->roles->first()->name == "superadmin"){
            //dd('admin,superadmin');
            $user = User::whereIn('statusSemakan', ['new request', 'pending', 'disemak'])->role('user')->get();
            //dd($user);
            return view('approval', compact('user'));
        }

        if(Auth::user()->roles->first()->name == "staff"){
            //dd('staff');
            //$material = Material::where(['user_id' => Auth::user()->id, 'subKategori' => $r->item_sub])
            //$user = User::whereNotNull('password')->role('user')->get();
            $user = User::whereIn('statusSemakan', ['pending','new request'])->where('pickUp_by', Auth::user()->id)->role('user')->get();
            //dd($user);
            return view('approval', compact('user'));
        }
    }

    public function pending(Request $r){

        if(Auth::user()->roles->first()->name == "user"){
            $user = null;
            return view('userDashboard');
        }

        if(Auth::user()->roles->first()->name == "admin"){
            $user = User::where('statusSemakan','disemak')->role('user')->get();
            //dd($user);
            return view('approval', compact('user'));
        }

        if(Auth::user()->roles->first()->name == "staff"){
            $user = User::where('pickUp_by', null)->role('user')->get();
            //($user);
            return view('pending', compact('user'));
        }
    }

    public function pick_up(Request $r){
        //dd($r->all());
        $user = User::find($r->user_id);
        if($user->pickUp_by == null){
            User::where('id', $r->user_id)->update([
                "statusSemakan" => 'pending',
                "pickUp_by" => Auth::user()->id,
                "checked_by" => Auth::user()->name
            ]);
            return ['success' => 'Company telah diambil'];
        }else{
            $diambilOleh = User::where('id', $user->pickUp_by )->first();
            return ['error' => 'Company telah diambil oleh '.$diambilOleh->name];
        }
    }

    public function delete_user(Request $r){
        //dd($r->all());
        User::where('id', $r->user_id)->delete();

        return ["success" => "User Deleted"];
    }

    public function checked(Request $r){
        //dd(Auth::user());
        User::find($r->user_id);
        // $user->statusSemakan = "disemak";
        // $user->save();
        User::where('id', $r->user_id)->update([
            "statusSemakan" => "disemak",
        ]);

        return redirect('/approval')->with(['success' => 'Company telah disemak']);
    }

    public function approve_attachment(Request $r){
        Attachment::where('id', $r->attachment_id)->update([
            'attachment_status' => 'Success',
            'approved_date' => Carbon::now()->toDateTimeString(),
            'comment' => null
        ]);

        return ["success" => "Sijil di sahkan"];
    }

    public function reject_attachment(Request $r){
        Attachment::where('id', $r->attachment_id)->update([
            'attachment_status' => 'Reject',
            'approved_date' => null,
            'comment' => $r->comment
        ]);

        return ["success" => "Sijil tidak sah"];
    }

    public function sendEmail(Request $r){
        //dd($r->user_id);
        $user = User::find($r->user_id);

        if($r->status == "approve"){
            $user->password = Hash::make('12345678');
            $user->kataLaluanText = '12345678';
            $user->statusSemakan = 'approve';
            $user->save();
            Mail::to($user->email)->send(new SendEmail($user->email,'12345678'));
        }elseif($r->status == "realReject"){
            User::where('id', $r->user_id)->delete();
            Mail::to($user->email)->send(new RealRejectMail());
        }

        // User::where('id', $r->user_id)->update([
        //     "statusSemakan" => "approve",
        //     "password" => Hash::make('12345678'),
        //     "kataLaluanText" => '12345678',
        // ]);

        // $user->password = Hash::make('12345678');
        // $user->kataLaluanText = '12345678';
        // $user->save();

        return redirect('/approval');
    }

    public function add_comment(Request $r){

        //user_id //comment //status
        //dd($r->all());

        $validateComment = Comment::where('user_id', $r->user_id)->first();

        $user = User::find($r->user_id);

        if($validateComment == null){
            $validateComment  = Comment::create([
                'user_id' => $r->user_id,
                'comment' => $r->comment
            ]);
        }else{
            $validateComment->comment = $r->comment;
            $validateComment->save();
        }

        //dd($user);

        if($r->status == "disemak"){

            $user->checked_by = Auth::user()->name;
            $user->statusSemakan = 'disemak';
            $user->save();
            Mail::to($user->email)->send(new CheckEmail());

        }elseif($r->status == "reject"){

            User::where('id', $r->user_id)->update([
                "password" => Hash::make('12345678'),
                "kataLaluanText" => '12345678',
            ]);
            Mail::to($user->email)->send(new RejectMail($user->email, '12345678', $validateComment->comment ?? ''));
        }

        return ["success" => "Permohonan telah disemak"];
    }


}
