@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-content-center">
        <div class="col-12 p-4">
            <h2 style="text-align: center">{Product Type Here}</h2>
            <form class="form-inline" style="float:right;">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        @for ($i = 0; $i < 7; $i++)
        <div class="col-3 pb-2 pt-3 m-3" style="border: 1px solid lightgray; background: white; text-align:center">
            <a href="#" class="stretched-link"></a>
            <img src="" style="object-fit: cover; width:250px; height: 250px; border: 1px solid black; margin-bottom: 1em;">
            <h4 style="text-align: center;">ProductName</h4>
            <h6>Lorem ipsum dolor sit amet this is a 2 seater sofa</h6>
            <h4 style="text-align: center;">Rp 2.500.000</h4>
            @auth
                <div class="row d-flex pt-1 pb-3" style="justify-content: space-evenly">
                    <a href= "update" class="btn btn-primary pl-4 pr-4" style="z-index: 1;">Update</a>
                    <a href= "delete" class="btn btn-secondary pl-4 pr-4" style="z-index: 1;">Delete</a>
                </div>
            @endauth    
        </div>
        @endfor
        
    </div>
</div>
@endsection
