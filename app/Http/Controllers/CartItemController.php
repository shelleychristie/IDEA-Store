<?php

namespace App\Http\Controllers;

use App\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function addToCart(){
        $product = request('product')->id;
        $user = Auth()->user()->id;
        $quantity = request('quantity');
        $existing = CartItem::where([
            ['user_id', '=', $user, ],
            ['product_id', '=', $product],
        ]);

        if($existing->is_null){
            CartItem::create([
                'user_id' => $user,
                'product_id' => $product,
                'quantity' => $quantity,
            ]);
        }else{
            $existing->quantity += $quantity;
            $existing->save();
        }
        return redirect()->back()->with('Success', 'Product successfuly added.');

    }
}
