<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{


    protected $fillable = ['product_id', 'photo', 'created_at', 'updated_at'];

    //

    public function getPhotoAttribute($val)
    {

        return $val ? asset('assets/images/products/'.$val) : '';
    }

}
