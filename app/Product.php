<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $guarded = [];

    public function productType(){
        return $this->belongsTo(ProductType::class);
    }

    public function users(){
        // connects product to user as a cartItem record
        return $this->belongsToMany(User::class,'cart_items')->using(CartItem::class)->withPivot('quantity')->withTimestamps();
    }

    public function getImage()
    {
        // this function is used to get the image path of the product. If image is null, then it will show the 'no product image available' default image.
        if ($this->image) {
            $imagePath = $this->image;
        } else {
            $imagePath = 'noImage.png';            
        }
        return '/storage/' . $imagePath;
    }
}
