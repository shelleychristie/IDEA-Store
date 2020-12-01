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
        $total = 0;
        $cartItems = Auth::user()->products()->withTrashed()->orderBy('created_at')->get();
        foreach ($cartItems as $product) {
            if(!$product->trashed()){
                $price = $product->price;
                $qty = $product->pivot->quantity;
                $total += $price * $qty;
            }
        }
        // dd($total);
        $total = number_format($total);
        return view('cart', ['total' => $total, 'cartItems' => $cartItems]);
    }
    
    public function addToCart(\App\Product $product)
    {   
        // dd($product);
        // dd(request());
        $data = request()->validate([
            'quantity' => ['required', 'max:' . $product->stock]
            ]);
            $quantity = $data['quantity'];
            $user = Auth::user();
            $existing = $user->products()->where('product_id', $product->id)->exists();
            // dd($existing);
            // $existing = CartItem::where([
                //     ['user_id', '=', $user],
                //     ['product_id', '=', $product->id],
                // ]);
                if ($existing == true) {
                    $oldQuantity = $user->products()->findOrFail($product->id, ['product_id'])->pivot->quantity;
                    // dd($oldQuantity);
                    $quantity = $quantity + $oldQuantity;
                    $user->products()->sync([$product->id => ['quantity' => $quantity]], false);
                } else {
                    $user->products()->attach($product->id, ['quantity' => $quantity]);
                }
                return redirect()->back()->with('success', 'Product successfuly added to cart.');
            }
            
            public function updateQty(\App\Product $product){
                $data = request()->validate([
                    'quantity' => ['required', 'max:' . $product->stock]
                    ]);
                    $quantity = $data['quantity'];
                    $user = Auth::user();
                    $user->products()->sync([$product->id => ['quantity' => $quantity]], false);
                    return redirect()->back()->with('success', 'Successfully changed the quantity of product in cart.');
                    
                }
                
                // public function delete(){
                    //     $id = request('id');
                    //     // dd($id);
                    //     // dd($product);
                    //     $user = Auth::user();
                    //     $user->products()->detach($id);
                    //     return redirect('/cart')->with(['success_deletion' => 'Item successfully removed from cart.']);
                    // }
                    
                    public function delete(\App\Product $product){
                        // dd($product);
                        $user = Auth::user();
                        $user->products()->detach($product->id);
                        return redirect('/cart')->with(['success_deletion' => 'Item successfully removed from cart.']);
                    }
                }
                