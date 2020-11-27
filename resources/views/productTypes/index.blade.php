@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center">
        <div class="col-12 p-4">
            <h2 style="text-align: center">Product Types</h2>
            <form class="form-inline" style="float:right;">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        @foreach ($productTypes as $productType)
        <div class="col-3 pb-2 pt-3 m-3" style="border: 1px solid lightgray; background: white">
        <a href="productType/{{$productType->id}}" class="stretched-link"></a>
        <img src="{{$productType->getImage()}}" style="object-fit: cover; width:250px; height: 250px; border: 1px solid black; margin-bottom: 1em;">
            <h4 style="text-align: center;">{{$productType->name}}</h4>
            @if (Auth::check())
                @if (Auth()->user()->role == 'Admin')
                    <div class="row d-flex pt-1 pb-3" style="justify-content: space-evenly">
                    <a href= "../productType/{{$productType->id}}/edit" class="btn btn-primary pl-4 pr-4" style="z-index: 1;">Update</a>
                    <a href= "delete" class="btn btn-secondary pl-4 pr-4" style="z-index: 1;">Delete</a>
                    </div>  
                @endif
            @endif
            
            
        </div>
        @endforeach
    </div>
</div>
@endsection
