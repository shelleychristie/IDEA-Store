<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function show()
    {
        $outOfStock = false;
        $total = 0;
        $cartItems = Auth::user()->products()->orderBy('created_at')->get();
        foreach ($cartItems as $product) {
            if($product->stock > 0){
                $price = $product->price;
                if($product->stock < $product->pivot->quantity && $product->stock > 0){
                    /* if the item's stock is not enough to satisfy the user's cart quantity, then the quantity will be reduced to the current stock and users will be notified.
                    */
                    $product->pivot->quantity = $product->stock;
                    $outOfStock = true;
                }
                $qty = $product->pivot->quantity;
                $total += $price * $qty;
            }
            
        }
        $total = number_format($total);
        if($outOfStock == true){
            $message = 'Some items no longer have enough stock and the quantity in your cart has been adjusted to the current available stock. Get them before they sell out!';
            return view('cart', ['total' => $total, 'cartItems' => $cartItems, 'warning' => $message]);
        }else{
            return view('cart', ['total' => $total, 'cartItems' => $cartItems]);
        }
        
    }

    public function addToCart(\App\Product $product)
    {
        $data = request()->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock]
        ]);
        $quantity = $data['quantity'];
        $user = Auth::user();
        $existing = $user->products()->where('product_id', $product->id)->exists();

        // checking to see if this product is already in cart or not
        if ($existing == true) {
            // if already in cart, then just add quantity
            $oldQuantity = $user->products()->findOrFail($product->id, ['product_id'])->pivot->quantity;
            $quantity = $quantity + $oldQuantity;
            $user->products()->sync([$product->id => ['quantity' => $quantity]], false);
        } else {
            //if not in cart, then create new record
            $user->products()->attach($product->id, ['quantity' => $quantity]);
        }
        return redirect()->back()->with('success', 'Product successfuly added to cart.');
    }

    public function updateQty(\App\Product $product)
    {
        $data = request()->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$product->stock],
        ]);
        $quantity = $data['quantity'];
        $user = Auth::user();
        $user->products()->sync([$product->id => ['quantity' => $quantity]], false);
        return redirect()->back()->with('success', 'Successfully changed the quantity of product in cart.');
    }

    public function delete(\App\Product $product)
    {
        $user = Auth::user();
        $user->products()->detach($product->id);
        return redirect('/cart')->with('success', 'Item successfully removed from cart.');
    }
}
