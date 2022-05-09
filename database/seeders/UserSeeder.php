<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::table('roles')->truncate();
        // DB::table('model_has_roles')->truncate();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'staff']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'superadmin']);

        $superadmin = [
            [
                'name' => 'superadmin',
                'noSyarikat'=> null ,
                'noPerniagaan'=> null ,
                'namaSyarikat'=> null ,
                'negara'=> null ,
                'alamat'=> null ,
                'bandar'=> null ,
                'poskod'=> null ,
                'negeri'=> null ,
                'noTelephone'=> null ,
                'noFax'=> null ,
                'website'=> null ,
                'statusPembekal'=> null ,
                'statusAktif'=> null ,
                'kategori'=> null ,
                "email" => 'superadmin@gmail.com',
                "password" => '12345678',
                "kataLaluanText" => '12345678',
                'statusSemakan' => null,
            ],
        ];

        $data = [
            [
                'name' => 'admin',
                'noSyarikat'=> null ,
                'noPerniagaan'=> null ,
                'namaSyarikat'=> null ,
                'negara'=> null ,
                'alamat'=> null ,
                'bandar'=> null ,
                'poskod'=> null ,
                'negeri'=> null ,
                'noTelephone'=> null ,
                'noFax'=> null ,
                'website'=> null ,
                'statusPembekal'=> null ,
                'statusAktif'=> null ,
                'kategori'=> null ,
                "email" => 'admin@gmail.com',
                "password" => '12345678',
                "kataLaluanText" => '12345678',
                'statusSemakan' => null,
            ],
        ];

        $staffData = [
            [
                'name' => 'syaafi',
                'noSyarikat'=> null ,
                'noPerniagaan'=> null ,
                'namaSyarikat'=> null ,
                'negara'=> null ,
                'alamat'=> null ,
                'bandar'=> null ,
                'poskod'=> null ,
                'negeri'=> null ,
                'noTelephone'=> null ,
                'noFax'=> null ,
                'website'=> null ,
                'statusPembekal'=> null ,
                'statusAktif'=> null ,
                'kategori'=> null ,
                "email" => 'syaafi@gmail.com',
                "password" => '12345678',
                "kataLaluanText" => '12345678',
                'statusSemakan' => null,
            ]
        ];

        foreach ($superadmin as $key => $value) {
            //dd($value);
            $user =  User::firstOrCreate([
                 'name' => $value['name'],
                 "email" => $value['email'],
                 "password" =>  $value['password'] ? Hash::make($value['password']) : null,
                 "kataLaluanText" =>$value['password'],
                 'noSyarikat'=> $value['noSyarikat'],
                 'noPerniagaan'=> $value['noPerniagaan'],
                 'namaSyarikat'=> $value['namaSyarikat'],
                 'negara'=> $value['negara'],
                 'alamat'=> $value['alamat'],
                 'bandar'=> $value['bandar'],
                 'poskod'=> $value['poskod'],
                 'negeri'=> $value['negeri'],
                 'noTelephone'=> $value['noTelephone'],
                 'noFax'=> $value['noFax'],
                 'website'=> $value['website'],
                 'statusPembekal'=> $value['statusPembekal'],
                 'statusAktif'=> $value['statusAktif'],
                 'kategori'=> $value['kategori'],
                 'statusSemakan' => $value['statusSemakan'],
             ]);

            //dd('key 0');
            $user->assignRole('superadmin');
        }

        foreach ($data as $key => $value) {
           // dd($key);
           $user =  User::firstOrCreate([
                'name' => $value['name'],
                "email" => $value['email'],
                "password" =>  $value['password'] ? Hash::make($value['password']) : null,
                "kataLaluanText" =>$value['password'],
                'noSyarikat'=> $value['noSyarikat'],
                'noPerniagaan'=> $value['noPerniagaan'],
                'namaSyarikat'=> $value['namaSyarikat'],
                'negara'=> $value['negara'],
                'alamat'=> $value['alamat'],
                'bandar'=> $value['bandar'],
                'poskod'=> $value['poskod'],
                'negeri'=> $value['negeri'],
                'noTelephone'=> $value['noTelephone'],
                'noFax'=> $value['noFax'],
                'website'=> $value['website'],
                'statusPembekal'=> $value['statusPembekal'],
                'statusAktif'=> $value['statusAktif'],
                'kategori'=> $value['kategori'],
                'statusSemakan' => $value['statusSemakan'],
            ]);


            $user->assignRole('admin');
            // if($key == 0){
            //     //dd('key 0');
            //     $user->assignRole('admin');
            // }

            // if($key >= 1){
            //     $user->assignRole('user');
            // }
        }

        foreach ($staffData as $key => $value) {
            //dd($value);
            $user =  User::firstOrCreate([
                 'name' => $value['name'],
                 "email" => $value['email'],
                 "password" =>  $value['password'] ? Hash::make($value['password']) : null,
                 "kataLaluanText" =>$value['password'],
                 'noSyarikat'=> $value['noSyarikat'],
                 'noPerniagaan'=> $value['noPerniagaan'],
                 'namaSyarikat'=> $value['namaSyarikat'],
                 'negara'=> $value['negara'],
                 'alamat'=> $value['alamat'],
                 'bandar'=> $value['bandar'],
                 'poskod'=> $value['poskod'],
                 'negeri'=> $value['negeri'],
                 'noTelephone'=> $value['noTelephone'],
                 'noFax'=> $value['noFax'],
                 'website'=> $value['website'],
                 'statusPembekal'=> $value['statusPembekal'],
                 'statusAktif'=> $value['statusAktif'],
                 'kategori'=> $value['kategori'],
                 'statusSemakan' => $value['statusSemakan'],
             ]);

            //dd('key 0');
            $user->assignRole('staff');
         }




    }
}
