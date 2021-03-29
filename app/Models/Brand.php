<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    use Translatable;

    protected $with=['translations'];

    protected $translatedAttributes=['name'];

    protected $fillable=['is_active'];

    protected $casts=['is_active'=>'boolean'];



    public function getActive(){
        return $this -> is_active == 0 ? 'غير مفعل' : 'مغفل';
    }

    public function scopeActive($q){
         return $q->where('is_active',1);
    }

    public function getPhotoAttribute ($val)
    {

        return ($val!==null)?asset('assets/images/brands/'.$val):"";
    }
}
