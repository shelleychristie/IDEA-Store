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
    <div class="row d-flex justify-content-center">
        @if ($cartItems->isNotEmpty())
        @foreach ($cartItems as $product)
        <div class="col-3 pb-2 pt-3 m-3" style="border: 1px solid lightgray; background: white; text-align:center">
            <a href="../product/{{$product->id}}" class="stretched-link"></a>
            <img src="{{$product->getImage()}}" style="object-fit: cover; width:250px; height: 250px; border: 1px solid black; margin-bottom: 1em;">
            <h4 style="text-align: center;">{{$product->name}}</h4>
            <h6>{{$product->description}}</h6>
            @php
            $subtotal = ($product->price)*($product->pivot->quantity);
            $subtotal = number_format($subtotal);
            $product->price = number_format($product->price);
            @endphp
            <h4 style="text-align: center;">Rp {{$product->price}}</h4> 
            <div class="row d-flex pt-1 pb-3" style="justify-content: space-evenly">Quantity: {{$product->pivot->quantity}} <br>
            Subtotal: {{$subtotal}}
            </div>
        </div>
        
        @endforeach
        <h4>Total: {{$total}}</h4>
        @else
        You don't have any items in your cart yet.
        @endif
    </div>
</div>
@endsection