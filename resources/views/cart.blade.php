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
        @if ($product->trashed())
        <div class="col-12 d-flex pb-3 pt-3 text-center align-items-center" style="border: 1px solid lightgray; background: white;">
            <a href="/product/{{$product->id}}"><img src="{{$product->getImage()}}" alt="" style="object-fit: cover; width:150px; height: 150px;"></a>
            <div class="col-6">
                This product ({{$product->name}}) has been removed and is not currently available.
            </div>
            
            <form action="cart/{{$product->id}}/delete" class="mx-4 justify-content-end">
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
            
            <div class="col-2  px-0">
                <form action="cart/{{$product->id}}/update" class="">
                    @csrf
                    <div class="form-group d-flex justify-content-center align-items-center">
                        <label for="quantity">Quantity: </label>
                        <input type="number" class="form-control col-5 ml-3" name="quantity" id="quantity" min="1" value="{{$product->pivot->quantity}}">
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
                        {{-- <input type="submit" value="Update quantity" class="btn btn-secondary btn-sm ml-4"> --}}
                        
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
                {{-- <a href="cart/delete" class="btn btn-danger col-1">Remove from cart</a> --}}
                {{-- <button class="btn btn-danger col-1">Remove from cart --}}
                    {{-- <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-x-square-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                    </svg> --}}
                    {{-- </button> --}}
                    {{-- <a href="#" class="nav-link pr-3 text-danger"></a> --}}
                </div>
            @endif
            
                @endforeach
            </div>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h4>Total: Rp {{$total}}</h4>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary float-right">Checkout</button>
                </div>
            </div>
            @else
            You don't have any items in your cart yet.
            @endif
            
        </div>    
    </div>
    @endsection
    