<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id'
    ];

    protected $table = "sub_category";

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function material(){
        return $this->hasMany(MaterialCatergory::class,'sub_category_id','id');
    }
}
