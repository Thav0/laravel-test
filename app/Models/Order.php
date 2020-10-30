<?php

namespace App\Models;

use Error;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id_buyer',
        'id_product',
        'quantity',
    ];

    public static function getAllOrders(){
        try {
            return DB::table('orders')
                ->select(
                    'users.name',
                    'products.id',
                    'products.name',
                    'orders.quantity',
                    'orders.created_at',
                )
                ->leftJoin('users', 'users.id', '=', 'orders.id_buyer')
                ->leftJoin('products', 'products.id', '=', 'orders.id_product')
                ->get();

        } catch (QueryException $th) {
            report($th);
            throw new Error('Falha na base de dados');
        }
    }
}
