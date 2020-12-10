<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getImage()
    {
        // this function is used to get the image path of the product type. If image is null, then it will show the 'no product image available' default image.
        if ($this->image) {
            $imagePath = $this->image;
        } else {
            $imagePath = 'noImage.png';
        }
        return '/storage/' . $imagePath;
    }

    public static function boot() {
        parent::boot();

        /* this function is for so that when the product type is deleted,
        all the products in that type are also deleted
        */
        static::deleting(function($productType) {
             $productType->products()->delete();
        });
    }
}
