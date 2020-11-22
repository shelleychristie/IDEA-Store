<?php

namespace App\Http\Controllers;

use App\ProductType;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'min:5'],
            'image' => ['mimes:jpeg,gif,png'],
            ]);
            
            // dd($data);
            if (request('image')) {
                $imagePath = (request('image')->store('productTypes', 'public'));
                // dd($imagePath);
                $imageArray = ['image' => $imagePath];
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
}
