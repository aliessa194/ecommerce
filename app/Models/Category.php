<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;


    protected $with=['translations'];

    protected $translatedAttributes=['name'];

    protected $fillable=['slug','is_active','parent_id'];

    protected $hidden=['translations'];

    protected $casts=['is_active'=>'boolean'];



    public function scopeParent($query){

       return $query->whereNull('parent_id');
    }

    public function scopeChild($query){

       return $query->whereNotNull('parent_id');
    }


    public function getActive(){
        return $this -> is_active == 0 ? 'غير مفعل' : 'مغفل';
    }

    public function _parent(){

        return $this->belongsTo(self::class,'parent_id','id');
    }

    public function scopeActive($q){
        return $q->where('is_active',1);
    }


    //get all childrens=
    public function childrens(){
        return $this -> hasMany(Self::class,'parent_id');
    }

    public function products()
    {
        return $this -> belongsToMany(Product::class,'product_categories');
    }


}
