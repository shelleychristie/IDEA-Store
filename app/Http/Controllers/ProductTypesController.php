<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'min:4', 'unique:product_types,name'],
            'image' => ['mimes:jpeg,gif,png'],
            ]);
            
            // dd($data);
            if (request('image')) {
                $imagePath = (request('image')->store('productTypes', 'public'));
                // dd($imagePath);
                $imageArray = ['image' => $imagePath];
            }else{
                $imageArray = ['image' => null];
            }
            // dd($imageArray); fine
            // dd($data['image']);
            $result = array_merge(
                $data,
                $imageArray ?? []
            );
            
            // dd($result);
            $productType = ProductType::create([
                'name' => $result['name'],
                'image' => $result['image'],
                ]);
                
                return redirect('/productType/' . $productType->id);
                
            }

    public function index(){
        $productTypes = ProductType::all();
        return view('productTypes.index', compact('productTypes'));
    }

    public function create()
    {
        return view('productTypes.create');
    }

    
    public function edit(ProductType $productType){
        return view('productTypes.edit', compact('productType'));
    }

    public function update(\App\ProductType $productType)
    {
        // $this->authorize('update', $product);
        
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'min:4', 'unique:product_types,name'],
            'image' => ['mimes:jpeg,gif,png'],
        ]);
        if (request('image')) {
            $imagePath = (request('image')->store('products', 'public'));
            // dd($imagePath);
            $imageArray = ['image' => $imagePath];
        }else{
            $imageArray = ['image' => $productType->image];
        }

        $result = array_merge(
            $data,
            $imageArray ?? []
        );

        $productType->name = $result['name'];
        $productType->image = $result['image'];
        $productType->save();

        return redirect('/')->with(['success' => 'Update successful.']);
    }

    public function delete(ProductType $productType){
        $productType->delete();
        return redirect('/')->with(['success' => 'Deletion successful.']);
    }
}
