<?php

namespace Corvus\Api\Controllers;


use Illuminate\Routing\Controller;
use Corvus\Core\Models\User;
use DB;
use Corvus\Api\Resources\Products;

class ApiController extends Controller
{
    public function getRandomCustomer()
    {
        $user = User::query()->whereHas('roles', function ($q) {
            $q->where('name', 'vendor');
        })
            ->select(['users.id'])->inRandomOrder()
            ->first();
        $token = $user->createToken('authToken')->accessToken;
        $results = ['id' => $user->id, 'token' => $token];
        return $results;
    }

    public function getProductsByCustomerId($id)
    {
        $user = User::find($id);
        $profile = $user->profile;
        if ($profile){
            $products = DB::table('products')
            ->leftJoin('pricings', 'products.id', '=', 'pricings.product_id')
            ->leftJoin('stocks', 'stocks.product_id', '=', 'pricings.product_id')
            ->leftJoin('warehouses', 'warehouses.id', '=', 'stocks.warehouse_id')
            ->where('pricings.pricing_group_id', $profile->pricing_group_id)
            ->where('stocks.warehouse_id', $profile->warehouse_id)
            ->where('stocks.stock_group_id', $profile->stock_group_id)
            ->whereRaw('(CURRENT_DATE BETWEEN pricings.from_date AND pricings.to_date)')
            ->select([
                'products.id as id',
                'products.sku as sku',
                'products.name as name',
                'pricings.price as price',
                'stocks.quantity as quantity',
                'warehouses.name as warehouse_name'
                ]
            )->get();

            return Products::collection($products);
        }
        return response()->json(null, 404);
    }
}
