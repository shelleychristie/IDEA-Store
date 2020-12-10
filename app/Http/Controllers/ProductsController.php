<?php

namespace App\Http\Controllers;

use App\ProductType;
use App\Product;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index($productType, Request $request)
    {
        // shows all products in that product type, according to search
        $productType = ProductType::find($productType);
        $keyword = $request->keyword;
        if ($keyword) {
            $products = Product::where([
                ['name', 'like', "%$request->keyword%",],
                ['product_type_id', '=', $productType->id],
            ])->paginate(10);
        } else {
            $products = $productType->products()->paginate(10);
        }
        return view('products.index', compact('productType', 'products'));
    }

    public function create()
    {
        $productTypes = ProductType::all();
        // this is to get a list of all product types so we can put it in the dropdown list in the view
        return view('products.create', compact('productTypes'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'min:5'],
            'image' => ['mimes:jpeg,gif,png'],
            'product_type_id' => ['required', 'integer', 'exists:App\productType,id'],
            'stock' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string', 'min:15'],
        ]);

        if (request('image')) {
            $imagePath = (request('image')->store('products', 'public'));
            $imageArray = ['image' => $imagePath];
        }else{
            $imageArray = ['image' => null];
        }

        $productType = request('product_type_id');
        $productType = ProductType::find($productType);
        $result = array_merge(
            $data,
            $imageArray ?? []
        );

        $product = $productType->products()->create([
            'name' => $result['name'],
            'image' => $result['image'],
            'product_type_id' => $result['product_type_id'],
            'stock' => $result['stock'],
            'price' => $result['price'],
            'description' => $result['description'],
        ]);
        return redirect('/product/' . $product->id);
    }

    public function show(\App\Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(\App\Product $product)
    {
        $productTypes = ProductType::all();
        return view('products.edit', compact('product', 'productTypes'));
    }

    public function update(\App\Product $product)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255', 'min:5'],
            'image' => ['mimes:jpeg,gif,png'],
            'product_type_id' => ['required', 'integer', 'exists:App\productType,id'],
            'stock' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'integer', 'min:1'],
            'description' => ['required', 'string', 'min:15'],
        ]);
        if (request('image')) {
            $imagePath = (request('image')->store('products', 'public'));
            $imageArray = ['image' => $imagePath];
        }else{
            $imageArray = ['image' => $product->image];
        }

        $productType = request('product_type_id');
        $productType = ProductType::find($productType);
        $result = array_merge(
            $data,
            $imageArray ?? []
        );
        $product->name = $result['name'];
        $product->image = $result['image'];
        $product->product_type_id = $result['product_type_id'];
        $product->stock = $result['stock'];
        $product->price = $result['price'];
        $product->description = $result['description'];
        $product->save();

        return redirect("/product/{$product->id}")->with(['success' => 'Update successful.']);
    }

    public function delete(Product $product){
        
        $product->delete();
        return redirect()->back()->with(['success' => 'Deletion successful.']);
    }
}
