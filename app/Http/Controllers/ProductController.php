<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->input('search');
        $products = Product::search($search)->paginate(3);
        return view('product.index', compact('products', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $input = $request->all();

        // upload image
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $input['image'] = $request->file('image')->store('public/img/product');
        } else {
            $input['image'] = null;
        }

        // create product
        $product = Product::create([
            'name' => $input['name'],
            'price' => $input['price'],
            'sku' => $input['sku'],
            'status' => $input['status'],
            'description' => $input['description'],
            'category_id' => $input['category'],
            'image' => $input['image'],
        ]);

        if ($product) {
            return redirect(route('product.index'))->with('success', 'Add data success!');
        } else {
            return redirect(route('product.index'))->with('failed', 'Add data fail!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->category_id = $request->input('category');
        $product->price = $request->input('price');
        $product->sku = $request->input('sku');
        $product->status = $request->input('status');
        $product->description = $request->input('description');

        // update image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            try {
                if (Storage::exists($product->image)) {
                    Storage::disk('local')->delete($product->image);
                }

                $path = $request->file('image')->store('public/img/product');

                $product->image = $path;
            } catch (\Exception $e) {
                return redirect(route('product.index'))->with('failed', 'Edit data fail!');
            }
        }
        
        $product = $product->save();

        if ($product) {
            return redirect(route('product.index'))->with('success', 'Edit data success!');
        } else {
            return redirect(route('product.index'))->with('failed', 'Edit data fail!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product = $product->delete();

        if ($product) {
            return redirect(route('product.index'))->with('success', 'Delete data success!');
        } else {
            return redirect(route('product.index'))->with('failed', 'Delete data fail!');
        }
    }

    /**
     * Delete permanently specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function forceDelete(Product $product)
    {
        // delete image
        try {
            if (Storage::exists($product->image)) {
                Storage::disk('local')->delete($product->image);
            }
        } catch (\Exception $e) {
            return redirect(route('product.index'))->with('failed', 'Delete data fail!');
        }

        // delete data
        $product->forceDelete();
        
        return redirect(route('product.index'))->with('success', 'Delete data success!');
    }
}
