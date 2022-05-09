<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Attachment;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'noSyarikat' => ['required', 'string', 'max:255'],
            'noPerniagaan' => ['required', 'string', 'max:255'],
            'namaSyarikat' => ['required', 'string', 'max:255'],
            'negara' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'bandar' => ['required', 'string', 'max:255'],
            'poskod' => ['required', 'string', 'max:255'],
            'negeri' => ['required', 'string', 'max:255'],
            'noTelephone' => ['required', 'string', 'max:255'],
            'noFax' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'statusPembekal' => ['required', 'string', 'max:255'],
            'ssm_doc' => ['required'],
            'pbt_doc' => ['required'],
        ]);

        // if (User::where('noSyarikat', '=', $request->noSyarikat)->exists()) {
        //     return redirect('/register')->with('error','Syarikat already exists');
        // }
        $ssmRD = ''; $pbtRD = '';


        if($ssm_file = $request->hasFile('ssm_doc')) {

            $ssm_file = $request->file('ssm_doc') ;

            $ssm_fileName = Carbon::now()->timestamp."_".$ssm_file->getClientOriginalName(); //get file original name

            $ssmRW = str_replace(" ","", $ssm_fileName); //replace white space
            $ssmRD = strtolower(str_replace("-","_", $ssmRW)); //replace "-" "_"

            $destinationPath = public_path().'/document/ssm'; //folder nak simpan file
            $ssm_file->move($destinationPath,$ssmRD); // simpankan file

        }

        if($pbt_file = $request->hasFile('pbt_doc')) {

            $pbt_file = $request->file('pbt_doc') ;
            $pbt_fileName = Carbon::now()->timestamp."_".$pbt_file->getClientOriginalName();  //get file original name

            $pbtRW = str_replace(" ","", $pbt_fileName); //replace white space
            $pbtRD = strtolower(str_replace("-","_", $pbtRW)); //replace "-" "_"

            $destinationPath = public_path().'/document/pbt';//folder nak simpan file
            $pbt_file->move($destinationPath,$pbtRD);// simpankan file

        }

        $user = User::create([
            'noSyarikat' => $request->noSyarikat,
            'noPerniagaan' => $request->noPerniagaan,
            'namaSyarikat' => $request->namaSyarikat,
            'negara' => $request->negara,
            'alamat' => $request->alamat,
            'bandar' => $request->bandar,
            'poskod' => $request->poskod,
            'negeri' => $request->negeri,
            'noTelephone' => $request->noTelephone,
            'noFax' => $request->noFax,
            'email' => $request->email,
            'website' => $request->website,
            'statusPembekal' => $request->statusPembekal,
            'statusSemakan' => 'new request',
            // 'statusAktif' => $request->statusAktif,
            // 'kategori' => $request->kategori,
            //'password' => ['required', 'string', 'max:255'],
            //'kataLaluanText' => ['required', 'string', 'max:255'],
        ]);

        Attachment::create([
            'user_id' => $user->id,
            'doc_type' => 'Sijil SSM',
            'attachment_status' => 'Applied',
            'upload_date' => Carbon::now()->toDateString(),
            'doc_path' => '/document/ssm/'.$ssmRD,
        ]);

        Attachment::create([
            'user_id' => $user->id,
            'doc_type' => 'Sijil PBT',
            'attachment_status' => 'Applied',
            'upload_date' => Carbon::now()->toDateString(),
            'doc_path' => '/document/pbt/'.$pbtRD,
        ]);

        $user->assignRole('user');

        //event(new Registered($user));
        //Auth::login($user);

        return redirect('/login')->with(['success' => 'Permohonan Syarikat telah diterima']);
    }
}
