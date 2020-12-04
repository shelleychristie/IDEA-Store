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
        return $this->belongsToMany(User::class,'cart_items')->using(CartItem::class)->withPivot('quantity')->withTimestamps();
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
