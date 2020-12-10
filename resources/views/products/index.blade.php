@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center">
        <div class="col-12 p-4">
            <h2 style="text-align: center">{{$productType->name}}</h2>
        <form class="form-inline float-right" action="" method="GET">
                <!-- SEARCH BAR -->
                <input class="form-control mr-sm-2" placeholder="Search" name="keyword" value="">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
          <strong>{{ $message }}</strong>
      </div>
    @endif
    <div class="row d-flex justify-content-center">
        @if ($products->isNotEmpty())
            @foreach ($products as $product)
            <div class="col-3 pb-2 pt-3 m-3" style="border: 1px solid lightgray; background: white; text-align:center">
            <a href="../product/{{$product->id}}" class="stretched-link"></a>
            <img src="{{$product->getImage()}}" style="object-fit: cover; width:250px; height: 250px; margin-bottom: 1em;">
                <h4 style="text-align: center;">{{$product->name}}</h4>
                <h6>{{$product->description}}</h6>
                @php
                $product->price = number_format($product->price);
                @endphp
                <h4 style="text-align: center;">Rp {{$product->price}}</h4> 
                @auth
                @if (Auth()->user()->role == 'Admin')
                    <div class="row d-flex pt-1 pb-3" style="justify-content: space-evenly">
                    <a href= "../product/{{$product->id}}/edit" class="btn btn-primary pl-4 pr-4" style="z-index: 1;">Update</a>
                        <a href= "../product/{{$product->id}}/delete" class="btn btn-secondary pl-4 pr-4" style="z-index: 1;" onclick="return confirm('Are you sure you want to delete this item? This will also remove the item from all customer carts. This action cannot be undone.')">Delete</a>
                    </div>
                @endif 
                @endauth     
            </div>
            @endforeach
        @else
            This product type does not have any products yet.
        @endif
        <div>{{ $products->withQueryString()->links() }}</div>
    </div>
</div>
@endsection
