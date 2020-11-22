@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center">
        <div class="col-12 p-4">
            <h2 style="text-align: center">{{$productType->name}}</h2>
        <form class="form-inline" action="" method="GET">
                <!-- SEARCH BAR -->
                <input class="form-control mr-sm-2" placeholder="Search" name="keyword" value="">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            {{-- <form class="form-inline" style="float:right;">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> --}}
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        @foreach ($products as $product)
        <div class="col-3 pb-2 pt-3 m-3" style="border: 1px solid lightgray; background: white; text-align:center">
        <a href="../product/{{$product->id}}" class="stretched-link"></a>
        <img src="{{$product->getImage()}}" style="object-fit: cover; width:250px; height: 250px; border: 1px solid black; margin-bottom: 1em;">
            <h4 style="text-align: center;">{{$product->name}}</h4>
            <h6>{{$product->description}}</h6>
            <h4 style="text-align: center;">Rp {{$product->price}}</h4> 
            @auth
                <div class="row d-flex pt-1 pb-3" style="justify-content: space-evenly">
                    <a href= "update" class="btn btn-primary pl-4 pr-4" style="z-index: 1;">Update</a>
                    <a href= "delete" class="btn btn-secondary pl-4 pr-4" style="z-index: 1;">Delete</a>
                </div>
            @endauth     
        </div>
        @endforeach
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
