@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="row d-flex my-4 py-4 justify-content-around" style="background: darkgray">
        <div class="col-5 p-3" style="">
            <img src="{{$product->getImage()}}" alt="" style="width: 35em; height:35em;">
        </div>
        <div class="col-4 p-3" style="background: white">
            <div class="d-flex m-3 pt-3"><h2>{{$product->name}}</h2></div>
            <div class="d-flex m-3"><h6>{{$product->description}}</h6></div>
            @php
            $product->price = number_format($product->price);
            @endphp
            <div class="d-flex m-3"><h4>Rp {{$product->price}}</h4></div>
            <div class="d-flex m-3"><h5>Stock: {{$product->stock}}</h5></div>
            @if(Auth::check() && Auth()->user()->role == 'Member')
            <hr style="width: 70%">
            @if ($product->stock < 1)
                <div class="text-center">This product is out of stock.</div>
            @else
            <form action="../product/{{$product->id}}/add" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group d-flex justify-content-center align-items-baseline pt-3">
                    <label for="quantity">Quantity: </label>
                    <input type="hidden" name="id" value="{{$product->id}}">
                <input type="number" class="form-control col-4 ml-3" name="quantity" id="quantity" min="1" max="{{$product->stock}}">
                </div>
                @error('quantity')
                <div class="d-flex justify-content-center text-center">
                    <span class="invalid-feedback d-inline-block" role="alert">
                    <strong>{{$message}}</strong>
                    </span></div>
                    @enderror
                    <div class="form-group d-flex justify-content-center pt-2">
                        <button class="btn btn-primary">Add to cart</button>
                    </div>
                    {{-- <small>Product type = {{}}</small> --}}
                </form>
            @endif
            @elseif(Auth::check() && Auth()->user()->role == 'Admin')
            <div class="row d-flex pt-1 pb-3" style="justify-content: space-evenly">
                <a href= "../product/{{$product->id}}/edit" class="btn btn-primary pl-4 pr-4" style="z-index: 1;">Update</a>
                    <a href= "../product/{{$product->id}}/delete" class="btn btn-secondary pl-4 pr-4" style="z-index: 1;" onclick="return confirm('Are you sure you want to delete this item? This will also remove the item from all customer carts. This action cannot be undone.')">Delete</a>
                </div>
            @endif
            </div>
        </div>
    </div>
    @endsection
    