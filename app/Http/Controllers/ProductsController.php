<?php

namespace App\Http\Controllers;

use App\ProductType;
use App\Product;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
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

        // dd($data);
        if (request('image')) {
            $imagePath = (request('image')->store('products', 'public'));
            // dd($imagePath);
            $imageArray = ['image' => $imagePath];
        }else{
            $imageArray = ['image' => null];
        }
        // dd($imageArray); fine
        // dd($data['image']);

        $productType = request('product_type_id');
        $productType = ProductType::find($productType);
        $result = array_merge(
            $data,
            $imageArray ?? []
        );

        // dd($result);
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

    public function index($productType, Request $request)
    {
        $productType = ProductType::find($productType);
        $keyword = $request->keyword;
        // dd($request, $keyword);
        if ($keyword) {
            // dd($keyword);
            $products = Product::where([
                ['name', 'like', "%$request->keyword%",],
                ['product_type_id', '=', $productType->id],
            ])->paginate(10);
        } else {
            $products = $productType->products()->paginate(10);
        }
        // dd($products);
        return view('products.index', compact('productType', 'products'));
    }

    public function show(\App\Product $product)
    {
        // dd($product);
        // dd($product->productType());
        return view('products.show', compact('product'));
    }

    public function edit(\App\Product $product)
    {

        // $this->authorize('update', $user->profile);
        $productTypes = ProductType::all();
        return view('products.edit', compact('product', 'productTypes'));
    }

    public function create()
    {
        $productTypes = ProductType::all();
        return view('products.create', compact('productTypes'));
    }

    public function update(\App\Product $product)
    {
        // $this->authorize('update', $product);
        
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
            // dd($imagePath);
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
        // dd($result);
        // dd($product);
        // $product
        $product->name = $result['name'];
        $product->image = $result['image'];
        $product->product_type_id = $result['product_type_id'];
        $product->stock = $result['stock'];
        $product->price = $result['price'];
        $product->description = $result['description'];
        // dd($product);
        $product->save();

        return redirect("/product/{$product->id}")->with(['success' => 'Update successful.']);
    }

    public function delete(Product $product){
        
        $product->delete();
        return redirect()->back()->with(['success' => 'Deletion successful.']);
    }
}
