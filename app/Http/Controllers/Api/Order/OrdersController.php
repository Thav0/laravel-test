<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreNewOrderRequest;
use App\Repositories\Order\Interfaces\IOrderRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $repo;

    public function __construct(IOrderRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index(){
        return response()->json($this->repo->getOrders());
    }

    public function store(Request $request) {

        try {
            $storeOrder = $this->repo->store($request);

            return response()->json($storeOrder, 201);
        } catch (\Throwable $th) {
            if($th instanceof ModelNotFoundException )
            {
                return response()->json(['message' => 'Produto não encontrado'], 401);
            }

            report($th);
            return response()->json(['message' => $th->getMessage()], 401);
        }

        return response()->json();
    }

}
