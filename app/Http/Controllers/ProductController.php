<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('title')) {
            return ProductResource::collection(Product::where('title','LIKE', '%'.$request->input('title').'%')->orderBy('title', 'ASC')->paginate(3));
        }
        return ProductResource::collection(Product::orderBy('title', 'ASC')->paginate(3));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {        
        $product = $request->isMethod('put') ? Product::findOrFail($request->input('id')) : new Product();
    
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->image = $request->input('image');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');

        if($product->save()) {
            return new ProductResource($product);
        }
    }	

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductResource(Product::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  intt  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        if($product->delete()) {
            return new ProductResource($product);
        }
    }
}

