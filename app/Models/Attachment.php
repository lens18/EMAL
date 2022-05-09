<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doc_type',
        'attachment_status',
        'upload_date',
        'approved_date',
        'doc_path',
        'comment',
    ];

    protected $table = "attachment";

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
