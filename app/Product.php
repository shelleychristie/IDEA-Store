<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function productType(){
        return $this->belongsTo(ProductType::class);
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
