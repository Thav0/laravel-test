<?php

namespace App\Repositories\Order;

use App\Http\Requests\Order\StoreNewOrderRequest;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\Order\Interfaces\IOrderRepository;
use Error;
use Illuminate\Http\Request;

class OrderRepository implements IOrderRepository{

    public function getOrders(){
        return Order::getAllOrders();
    }

    public function store(Request $request) {
        $userID = auth('api')->user()->id;

        $getProduct = Product::findOrFail($request->id_product)->first();

        if( $request->quantity > $getProduct->quantity ) {
            throw new Error('A quantidade disponível em estoque é: ' . $getProduct->quantity);
        }

        $order = array(
            'id_buyer' => $userID,
            'id_product' => $request->id_product,
            'quantity' => $request->quantity,
        );

        $orderCreated = Order::create($order);

        $getProduct->quantity = $getProduct->quantity - $request->quantity;
        $getProduct->save();

        return $orderCreated;
    }
}
