<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Translatable,
        SoftDeletes;


    protected $with = ['translations'];


    protected $fillable = [
        'brand_id',
        'slug',
        'sku',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'manage_stock',
        'qty',
        'in_stock',
        'is_active'
    ];


    protected $casts = [
        'manage_stock' => 'boolean',
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected $dates = [
        'special_price_start',
        'special_price_end',
        'start_date',
        'end_date',
        'deleted_at',
    ];


    protected $translatedAttributes = ['name', 'description', 'short_description'];

    public function brand()
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

//m2m
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories');
    }

    public function getActive(){
        return $this -> is_active == 0 ? 'غير مفعل' : 'مغفل';
    }



    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }


    public function images()
    {
        return $this->hasMany(Image::class, 'product_id');
    }

//12m
    public function options()
    {
        return $this->hasMany(Option::class, 'product_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }



}
