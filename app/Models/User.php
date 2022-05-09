<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'noSyarikat',
        'noPerniagaan',
        'namaSyarikat',
        'negara',
        'alamat',
        'bandar',
        'poskod',
        'negeri',
        'noTelephone',
        'noFax',
        'email',
        'website',
        'statusPembekal',
        'statusAktif',
        'kategori',
        'password',
        'katalaluanText',
        'name',
        'statusSemakan',
        'ssm_doc',
        'pbt_doc',
        'pickUp_by',
        'checked_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [

    ];

    // public static $rules = [
    //     'noSyarikat' => 'required'
    // ];

    public function attachment(){
        return $this->hasMany(Attachment::class, 'user_id', 'id');
    }


    public function comment(){
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

}
