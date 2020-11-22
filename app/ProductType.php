<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
