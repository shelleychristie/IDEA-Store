@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row d-flex my-4 py-4 justify-content-around" style="background: darkgray">
        <div class="col-5 p-3" style="">
            <img src="" alt="" style="width: 35em; height:35em; border:1px solid black">
        </div>
        <div class="col-4 p-3" style="background: white">
            <div class="d-flex m-3 pt-3"><h4>{ProductName}</h4></div>
            <div class="d-flex m-3"><h6>Lorem ipsum dolor sit amet this is a 2 seater sofa jasndjas jaslkjdas jklasjdkla jkasljdla jkljasd k jaksdjk asjdklaj sdjkasjd </h6></div>
            <div class="d-flex m-3"><h4>Rp 25.000.000</h4></div>
            <div class="d-flex m-3"><h5>Stock: 5</h5></div>
        </div>
    </div>
</div>
@endsection
