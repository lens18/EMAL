<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Attachment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index(Request $r){

        //dd(Auth::user()->roles->pluck('name'));
        //$user = User::whereNull('password')->role('user')->get();
        if(Auth::user()->roles->first()->name == "user"){
            //$user = null;
            //dd($user);
            return view('userDashboard');
        }

        if(Auth::user()->roles->first()->name == "admin" || "superadmin"){
            //dd($user);
            //$user = User::where('statusSemakan', 'approve')->role('user')->with('attachment')->get();
            $employeeCount = User::with('roles')->whereHas('roles', function (Builder $q){
                $q->where('name', 'staff');
            })->count();

            $newRequest = User::where('statusSemakan', 'new request')->count();

            $pendingRequest = User::where('statusSemakan', 'pending')->count();
            //dd($pendingRequest);
            return view('dashboard', compact(['employeeCount', 'newRequest', 'pendingRequest']));
        }

        if(Auth::user()->roles->first()->name == "staff"){
            //dd($user);
            $employeeCount = User::with('roles')->whereHas('roles', function (Builder $q){
                $q->where('name', 'staff');
            })->count();

            $newRequest = User::where('statusSemakan', 'new request')->count();

            $pendingRequest = User::where('statusSemakan', 'pending')->count();
            //dd($pendingRequest);
            return view('dashboard', compact(['employeeCount', 'newRequest', 'pendingRequest']));
        }
    }

    public function approved_user(Request $r){

        $user = User::where('statusSemakan', 'approve')->role('user')->with('attachment')->get();

        return view('approvedUser', compact('user'));
    }

    public function view_details(Request $r){
        $user = User::find($r->user_id);

        return view('viewDetails', compact('user'));
    }

    public function update_details(Request $r) {
        $userData = $r->all();

        // remove unused data
        unset($userData['_token']);

        User::where('id', $r->user_id)->update([
            'noSyarikat' => $r->noSyarikat,
            'noPerniagaan' => $r->noPerniagaan,
            'namaSyarikat' => $r->namaSyarikat,
            'negara' => $r->negara,
            'alamat' => $r->alamat,
            'bandar' => $r->bandar,
            'poskod' => $r->poskod,
            'negeri' => $r->negeri,
            'noTelephone' => $r->noTelephone,
            'noFax' => $r->noFax,
            'email' => $r->email,
            'website' => $r->website,
            'statusPembekal' => $r->statusPembekal,
        ]);

        if ($r->status == "user_update_detail") {
            return redirect('/dashboard')->with(['success' => 'Company details updated']);
        }else{
            return redirect('/viewDetails/'. $r->user_id)->with(['success' => 'Company details updated']);
        }


    }

    public function delete_user(Request $r){
        //dd($r->all());
        User::where('id', $r->user_id)->delete();

        return ["success" => "User Deleted"];
    }

    public function view_application(Request $r){
        $user = User::find($r->user_id)->get();
            //dd($user);
        return view('viewApplication');
    }

    public function upload_doc(Request $r){

        //dd($r->all());

        $attachment = Attachment::find($r->attachment_id);
        // /dd($attachment);
        $file_path = public_path().$attachment->doc_path;
        unlink($file_path);//delete file in public folder

        //save document in folder public
        if($doc_file = $r->hasFile('doc')) {

            $doc_file = $r->file('doc') ;
            $doc_fileName = Carbon::now()->timestamp."_".$doc_file->getClientOriginalName();  //get file original name

            $docRW = str_replace(" ","", $doc_fileName); //replace white space
            $docRD = strtolower(str_replace("-","_", $docRW)); //replace "-" "_"

            if($r->attachment_type == "Sijil SSM"){
                $destinationPath = public_path().'/document/ssm';//folder nak simpan file ssm
            }elseif($r->attachment_type == "Sijil PBT"){
                $destinationPath = public_path().'/document/pbt';//folder nak simpan file pbt
            }elseif($r->attachment_type == "Letter Head"){
                $destinationPath = public_path().'/document/letter head';//folder nak simpan file pbt
            }elseif($r->attachment_type == "Borang Akuan"){
                $destinationPath = public_path().'/document/borang akuan';//folder nak simpan file pbt
            }elseif($r->attachment_type == "Sijil SIRIM"){
                $destinationPath = public_path().'/document/sijil sirim';//folder nak simpan file pbt
            }elseif($r->attachment_type == "Laporan Audit SIRIM"){
                $destinationPath = public_path().'/document/audit sirim';//folder nak simpan file pbt
            }


            $doc_file->move($destinationPath,$docRD);// simpankan file
        }

        //save document path in db
        if($r->attachment_type == "Sijil SSM"){
            $attachment->doc_path = '/document/ssm/'.$docRD;
        }elseif($r->attachment_type == "Sijil PBT"){
            $attachment->doc_path = '/document/pbt/'.$docRD;
        }elseif($r->attachment_type == "Letter Head"){
            $attachment->doc_path = '/document/letter head/'.$docRD;
        }elseif($r->attachment_type == "Borang Akuan"){
            $attachment->doc_path = '/document/borang akuan/'.$docRD;
        }elseif($r->attachment_type == "Sijil SIRIM"){
            $attachment->doc_path = '/document/sijil sirim/'.$docRD;
        }elseif($r->attachment_type == "Laporan Audit SIRIM"){
            $attachment->doc_path = '/document/audit sirim/'.$docRD;
        }

        $attachment->attachment_status = 'new_upload';
        $attachment->upload_date =  Carbon::now()->toDateString();
        $attachment->save();
        // Attachment::where('id', $r->attachment_id)->update([
        //     'doc_path' => 'Success',
        //     'upload_date' => Carbon::now()->toDateTimeString()
        // ]);
            //dd($user);
        //return view('viewApplication');
        return redirect('/dashboard/'. $r->user_id)->with(['success' => 'Document uploaded']);
    }

    public function update_password(Request $request)
    {
        $userPassword = Auth::user()->password;

        //dd(Auth::User()->id);
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);
        if (!Hash::check($request->current_password, $userPassword)) {
            return redirect('/dashboard/')->with('error','password does not match');
        }

        User::where('id', Auth::user()->id)->update([
            "password" => Hash::make($request->new_password),
            "kataLaluanText" => $request->new_password,
        ]);
        // $user->password = Hash::make($request->password);
        // $user->save();

        return redirect('/dashboard/')->with('success','password successfully updated');
    }

}
