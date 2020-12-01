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
            <img src="{{$product->getImage()}}" alt="" style="width: 35em; height:35em; border:1px solid black">
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
                        <strong>{{ $message }}</strong>
                    </span></div>
                    @enderror
                    <div class="form-group d-flex justify-content-center pt-2">
                        <button class="btn btn-primary">Add to cart</button>
                    </div>
                    {{-- <small>Product type = {{}}</small> --}}
                </form>
                @endif
            </div>
        </div>
    </div>
    @endsection
    