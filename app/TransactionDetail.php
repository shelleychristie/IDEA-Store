<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $guarded = [];
    // TransactionDetail will NOT be a pivot table that links product to transaction
    // this is in case products are updated or deleted, the transaction items and details like price total won't change

    public function transaction(){
        return $this->belongsTo(Transaction::class);
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
