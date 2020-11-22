@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex my-4 py-4 justify-content-around" style="background: darkgray">
        <div class="col-5 p-3" style="">
        <img src="{{$product->getImage()}}" alt="" style="width: 35em; height:35em; border:1px solid black">
        </div>
        <div class="col-4 p-3" style="background: white">
            <div class="d-flex m-3 pt-3"><h2>{{$product->name}}</h2></div>
            <div class="d-flex m-3"><h6>{{$product->description}}</h6></div>
            <div class="d-flex m-3"><h4>Rp {{$product->price}}</h4></div>
            <div class="d-flex m-3"><h5>Stock: {{$product->stock}}</h5></div>
            @auth
                <hr style="width: 70%">
                    <form action="">
                        <div class="form-group d-flex justify-content-center align-items-baseline pt-3">
                            <label for="qty">Quantity: </label>
                            <input type="number" class="form-control col-4 ml-3" name="qty" id="qty" min="1">
                        </div>
                        <div class="form-group d-flex justify-content-center pt-2">
                            <button class="btn btn-primary">Add to cart</button>
                        </div>
                        
                    </form>
            @endauth
        </div>
    </div>
</div>
@endsection
