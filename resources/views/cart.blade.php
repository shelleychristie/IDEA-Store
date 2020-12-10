@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center">
        <div class="col-12 p-4">
            <h2 style="text-align: center">Your Shopping Cart</h2>
        </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
    @endif
    @if ($warning ?? '')
    <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $warning ?? '' }}</strong>
    </div>
    @endif
    <div class="row d-flex justify-content-center">
        @if ($cartItems->isNotEmpty())
        @foreach ($cartItems as $product)
        @if ($product->stock > 0)
        <div class="col-12 pb-3 pt-3 d-flex align-items-center" style="border: 1px solid lightgray; background: white;">
            <a href="/product/{{$product->id}}"><img src="{{$product->getImage()}}" alt="" style="object-fit: cover; width:150px; height: 150px;"></a>
        
        <div class="col-2 d-flex" style="">
            Product: <br>
            {{$product->name}}
        </div>
        <div class="col-2  px-0">
            <form action="cart/{{$product->id}}/update" class="">
                @csrf
                <div class="form-group d-flex justify-content-center align-items-center">
                    <label for="quantity">Quantity: </label>
                <input type="number" class="form-control col-5 ml-3" name="quantity" id="quantity" min="1" value="{{$product->pivot->quantity}}" max="{{$product->stock}}">
                    <input type="hidden" name="id" value="{{$product->id}}">
                </div>
                @error('quantity')
                <div class="d-flex justify-content-center text-center">
                    <span class="invalid-feedback d-inline-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span></div>
                    @enderror
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-secondary">Update Quantity</button>
                    </div>
                    
                </form>
            </div>
            
            @php
            $subtotal = ($product->price)*($product->pivot->quantity);
            $subtotal = number_format($subtotal);
            $product->price = number_format($product->price);
            @endphp
            <div class="col-2 d-flex ml-3" style="">
                Price: <br>
                {{$product->price}}
            </div>
            <div class="col-2 d-flex" style="">
                Subtotal: <br>
                {{$subtotal}}
            </div>
            <form action="cart/{{$product->id}}/delete">
                @csrf
                <input type="submit" value="Remove from cart" class="btn btn-danger btn-sm">
            </form>
            </div>
        @else
            <div class="col-12 pb-3 pt-3 d-flex align-items-center" style="border: 1px solid lightgray; background: white;">
                <a href="/product/{{$product->id}}"><img src="{{$product->getImage()}}" alt="" style="object-fit: cover; width:150px; height: 150px;"></a>
            
            <div class="col-2 d-flex" style="">
                Product: <br>
                {{$product->name}}
            </div>
            <div class="col-6 d-flex" style="">
                This product is currently out of stock.
            </div>
            <form action="cart/{{$product->id}}/delete">
                @csrf
                <input type="submit" value="Remove from cart" class="btn btn-danger btn-sm">
            </form>
        @endif
    </div>
                @endforeach
            
            <hr>
            <div class="row">
                <div class="col-6">
                    <h4>Total: Rp {{$total}}</h4>
                </div>
                <div class="col-6">
                    <form action="/checkout">
                        @csrf
                        <input type="submit" value="Checkout" class="btn btn-primary float-right">
                    </form>
                    {{-- <button class="btn btn-primary float-right">Checkout</button> --}}
                </div>
            </div>
            @else
            Your shopping cart is empty right now.
            @endif
        </div>    
    </div>
    @endsection
    