<?php

namespace App\Http\Controllers;

use App\ProductType;
use App\Product;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    // protected function validator(array $data)
    // {
        //     return Validator::make($data, [
            //         'name' => ['required', 'string', 'max:255', 'min:5'],
            //         'image' => ['mimes:jpeg,gif,png'],
            //         'productType' => ['required', 'string', 'unique:users'],
            //         'stock' => ['required', 'integer', 'min:1'],
            //         'price' => ['required', 'integer', 'min:1'],
            //         'description' => ['required', 'string', 'min:15'],
            //     ]);
            // }
            
            public function store()
            {
                $data = request()->validate([
                    'name' => ['required', 'string', 'max:255', 'min:5'],
                    'image' => ['mimes:jpeg,gif,png'],
                    'product_type' => ['required', 'integer', 'exists:App\productType,id'],
                    'stock' => ['required', 'integer', 'min:1'],
                    'price' => ['required', 'integer', 'min:1'],
                    'description' => ['required', 'string', 'min:15'],
                    ]);
                    
                    // dd($data);
                    if (request('image')) {
                        $imagePath = (request('image')->store('products', 'public'));
                        // dd($imagePath);
                        $imageArray = ['image' => $imagePath];
                    }
                    // dd($imageArray); fine
                    // dd($data['image']);
                    
                    $productType = request('product_type');
                    $productType = ProductType::find($productType);
                    $result = array_merge(
                        $data,
                        $imageArray ?? []
                    );
                    
                    // dd($result);
                    $product = $productType->products()->create([
                        'name' => $result['name'],
                        'image' => $result['image'],
                        'product_type_id' => $result['product_type'],
                        'stock' => $result['stock'],
                        'price' => $result['price'],
                        'description' => $result['description'],
                        ]);
                        return redirect('/product/' . $product->id);
                    }
                    
                    public function index($productType, Request $request){
                        $productType = ProductType::findOrFail($productType);
                        $keyword = $request->keyword;
                        // dd($request, $keyword);
                        if($keyword){
                            // dd($keyword);
                            $products = Product::where('name', 'like', "%$request->keyword%", 'and', 'product_type_id', $productType->id)->
                            paginate(10);
                        }else{
                            $products = $productType->products()->paginate(10);
                            
                        }
                        return view('products.index', compact('productType', 'products'));
                    }
                    
                    // public function search(Request $request, $productType){
                        //     dd($request, $productType);
                        
                        //     return view('products.index', compact('productType', 'products'));
                        // }
                        
                        public function show(\App\Product $product){
                            return view('products.show', compact('product'));
                        }
                        
                        public function edit(){
                            return view('products.edit', compact('product'));
                        }
                        
                        public function create()
                        {
                            $productTypes = ProductType::all();
                            return view('products.create', compact('productTypes'));
                        }
                        
                        
                        // public function store()
                        // {
                            //     $data = request()->validate([
                                //         'name' => 'required',
                                //         'image' => ['required', 'image'],
                                //         'productType' => ['required'],
                                //         'stock' => ['required', ],
                                //         'productType' => ['required'],
                                //         'productType' => ['required'],
                                //     ]);
                                
                                //     $imagePath = request('image')->store('uploads', 'public');
                                
                                //     $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
                                //     $image->save();
                                
                                //     auth()->user()->posts()->create([
                                    //         'caption' => $data['caption'],
                                    //         'image' => $imagePath,
                                    //     ]);
                                    
                                    //     return redirect('/profile/' . auth()->user()->id);
                                    // }
                                }
                                