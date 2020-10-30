<?php

namespace App\Repositories\Product;

use App\Http\Requests\Product\StoreNewProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Product\Interfaces\IProductRepository;

class ProductRepository implements IProductRepository {
    public function store(StoreNewProductRequest $request) {
        $product = new Product;

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $product->save();

        return $product;
    }

    public function update(UpdateProductRequest $request, $id) {
        $product = Product::findOrFail($id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        $product->save();

        return $product;
    }

    public function delete($id) {
        $product = Product::findOrFail($id);;

        $product->delete();
    }

    public function get() {
        $products = Product::all();

        return $products;
    }

    public function getById($id) {
        $product = Product::where('id', $id)->firstOrFail();

        return $product;
    }

}
