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
        if ($this->image) {
            $imagePath = $this->image;
        } else {
            $imagePath = 'noImage.png';
        }
        return '/storage/' . $imagePath;
    }

    public static function boot() {
        parent::boot();

        static::deleting(function($productType) {
             $productType->products()->delete();
        });
    }
}
