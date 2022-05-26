<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'namaBahan',
        'kategori',
        'subKategori',
        'jenama',
        'namaPengilang',
        'alamatPengilang',
        'negaraPengilang',
        'model',
        'ratedVoltage',
        'size',
        'coreNo',
        'perakuan',
        'status'
    ];

    protected $table = "material";

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function categori(){
        return $this->belongsTo(Category::class,'kategori','id');
    }

    public function subCategori(){
        return $this->belongsTo(SubCategory::class,'subKategori','id');
    }

    public function materialCategori(){
        return $this->belongsTo(MaterialCatergory::class,'namaBahan','id');
    }
}
