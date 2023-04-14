<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $products = Product::all()->toArray();
        if (!empty($products)) return response()->json($products);
        return response()->json(['message' => 'Products Not found'], 404);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = new Product();

            $product->name = $request->name;
            $product->uuid = Str::uuid();
            $product->value = $request->value;
            $product->discount = $request->discount;
            $product->discount_type = $request->discountType;
            $product->description = $request->description;
            $product->small_description = $request->smallDescription;
            $product->valid_date = $request->validDate;
            $product->quantity = $request->quantity;
            $product->save();
            return response()->json(['data' => $product], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Unexpected error, please try later.'], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, $uuid)
    {
        //
        try {
            $product = Product::where('uuid', $uuid)->first();
            if (empty($product)) return response()->json(['message' => 'Product not found'], 404);
            return response()->json(['data' => $product], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Unexpected error, please try later.'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, $uuid)
    {
        //
        try {
            $product = Product::where('uuid', $uuid)->first();
            if (empty($product)) return response()->json(['message' => 'Product not found'], 404);
            return response()->json($product, 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Unexpected error, please try later.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product, $uuid)
    {

        try {
            // dd($request->all());
            $product = Product::where('uuid', $uuid)->first();

            if (empty($product)) return response()->json(['message' => 'Product not found'], 404);

            $product = $product->update([
                'name' => $request->name,
                'value' => $request->value,
                'discount' => $request->discount,
                'discount_type' => $request->discountType,
                'description' => $request->description,
                'small_description' => $request->smallDescription,
                'valid_date' => $request->validDate,
            ]);
            return response()->json(['message' => 'Product updated with success.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' =>  $e->getMessage()], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, $uuid)
    {
        try {
            $delete = Product::where('uuid', $uuid)->first();
          
            if (empty($delete)) return response()->json(['message' => 'Product not found'], 404);
            $delete->delete();
            return response()->json(['message' => 'Product deleted with success.'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unexpected error, please try later.'], 500);
        }
    }
}
