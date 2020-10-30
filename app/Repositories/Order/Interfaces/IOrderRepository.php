<?php

namespace App\Repositories\Order\Interfaces;

use App\Http\Requests\Order\StoreNewOrderRequest;
use Illuminate\Http\Request;

interface IOrderRepository {
    public function getOrders();
    public function store(Request $request);
}
