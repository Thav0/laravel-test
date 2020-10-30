<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreNewProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\Product\Interfaces\IProductRepository;

class ProductsController extends Controller
{
    protected $repo;

    public function __construct(IProductRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return response()->json($this->repo->get());
    }

    public function store(StoreNewProductRequest $request)
    {
        try {
            $newProduct = $this->repo->store($request);
            return response()->json($newProduct, 201);
        } catch (\Throwable $th) {
            report($th);
            return response()->json(['message' => 'Falha ao cadastrar o produto'], 401);
        }
    }

    public function show($id)
    {
        try {
            $getProduct = $this->repo->getById($id);
            return response()->json($getProduct);
        } catch (\Throwable $th) {
            report($th);
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
    }

    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $updateProduct = $this->repo->update($request, $id);

            return response()->json($updateProduct);
        } catch (\Throwable $th) {
           report($th);
           return response()->json(['message' => 'Falha ao atualizar produto'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->repo->delete($id);

            return response()->json([], 200);
        } catch (\Throwable $th) {
           report($th);
           return response()->json(['message' => 'Falha ao remover produto'], 500);
        }
    }
}
