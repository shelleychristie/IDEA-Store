<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CartItem extends Pivot
{
    protected $guarded = [];
    protected $appends = [
        'quantity',
    ];


    // this is a custom model pivot table that connects user to things in their cart
    // with additional attribute of 'quantity'



}
