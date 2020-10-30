<?php

namespace App\Repositories\Product\Interfaces;

use App\Http\Requests\Product\StoreNewProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

interface IProductRepository {
    public function store(StoreNewProductRequest $request);
    public function update(UpdateProductRequest $request, $id);
    public function delete($id);
    public function get();
    public function getById($id);
}
