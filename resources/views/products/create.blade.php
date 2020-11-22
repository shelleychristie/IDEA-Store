@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Product</div>
                
                <div class="card-body">
                    <form action="/product" enctype="multipart/form-data" method="POST">
                        @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Choose image</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control-file" name="image" id="image"
                                @error('image') is-invalid @enderror value="{{ old('image') }}" autofocus>
                                @error('image')
                                <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="product_type" class="col-md-4 col-form-label text-md-right">Product Type</label>
                            <div class="col-md-6">
                                <select class="custom-select" name="product_type">
                                    <option selected>Choose product type</option>
                                    @foreach ($productTypes as $productType)
                                    <option value="{{$productType->id}}" {{ old('product_type') == $productType->id ? 'selected' : '' }} @error('product_type') is-invalid @enderror>{{$productType->name}}</option>
                                    @endforeach
                                </select>
                                @error('product_type')
                                <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="stock" class="col-md-4 col-form-label text-md-right">Stock</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="stock" @error('stock') is-invalid @enderror value="{{ old('stock') }}" autofocus id="stock" min="1">
                                @error('stock')
                                <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="price" id="price" min="1" @error('price') is-invalid @enderror value="{{ old('price') }}" autofocus>
                                @error('price')
                                <span class="invalid-feedback d-inline-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description" autofocus rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add New Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
