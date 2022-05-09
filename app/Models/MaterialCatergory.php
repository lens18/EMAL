<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCatergory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sub_category_id'
    ];

    protected $table = "material_category";

    public function sub_category(){
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }
}
