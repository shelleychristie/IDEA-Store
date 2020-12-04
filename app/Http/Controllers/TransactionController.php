<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function checkout(){
        $transaction = auth()->user()->transactions()->create();
        // $list = array();
        $total = 0;
        $cartItems = auth()->user()->products()->get();
        foreach ($cartItems as $product) {
                $price = $product->price;
                $qty = $product->pivot->quantity;
                $total += $price * $qty;
                $item = $transaction->transactionDetails()->create([
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->price,
                    'quantity' => $product->pivot->quantity,
                ]);
                $product->stock = $product->stock - $product->pivot->quantity;
                $product->save();
                auth()->user()->products()->detach($product->id);
            // array_push($list, $item);
        }
        // dd($transaction, $total, $list);
        return $this->show();
    }

    public function show(){
        $transactions = auth()->user()->transactions()->orderBy('created_at', 'desc')->get();
        return view('transactions', compact('transactions'));
    }
}
