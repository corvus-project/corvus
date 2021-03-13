<?php

namespace App\Http\Controllers\Portal;

use Corvus\Core\Models\Order;
use App\Http\Controllers\Controller;
use Corvus\Core\Models\Product;
use Corvus\Core\Models\OrderStatus;
use Auth;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Jobs\ProcessOrder;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $cartItems = [];
        if ($request->session()->has('cart')) {
            $cartItems = $request->session()->get('cart');
        }

        $updated = false;
        foreach ($cartItems as $key => $item) {
            if ($cartItems[$key]['sku'] === $product->sku) {
                $cartItems[$key]['quantity'] = $cartItems[$key]['quantity'] + 1;
                $updated = true;
                var_dump($cartItems[$key]['quantity']);
            }
        }

        if (!$updated) {
            array_push($cartItems, ['sku' => $product->sku, 'quantity' => 1]);
        }

        $request->session()->put('cart', $cartItems);
        return redirect(route('portal.products.view', $product->id))->withFlashSuccess('Product added to cart');
    }

    public function view(Request $request)
    {
        $cart = [];
        if ($request->session()->has('cart')) {
            $cart = $request->session()->get('cart');
        }
        return view('portal.cart.view', compact('cart'));
    }

    public function update(Request $request)
    {
        $cartItems = [];
        $products = $request->sku;
        foreach ($products as $sku => $quantity) {
            if ($quantity > 0) {
                array_push($cartItems, ['sku' => $sku, 'quantity' => $quantity]);
            }
        }
        $request->session()->forget('cart');
        $request->session()->put('cart', $cartItems);
        return redirect(route('portal.cart.view'))->withFlashSuccess('Cart updated');
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        $profile = $user->profile;

        $orderlines = [];
        $lines = $request->session()->get('cart');

        $order = Order::create(['user_id' => $user->id, 'order_date' => Carbon::now(), 'status' => 1, 'ref_id' => $request->ref_id]);
        $order_id = $order->id;
        $_status = OrderStatus::where('slug', 'NEW_ORDER')->first();
        foreach ($lines as $line) {
            $orderlines[] = [
                'product_sku' => $line['sku'],
                'quantity' => $line['quantity'],
                'order_header_id' => $order_id,
                'status' => $_status->id,
                'created_at' => Carbon::now()
            ];
        }

        DB::table('order_lines')->insert($orderlines);
        ProcessOrder::dispatch($order);
        $request->session()->forget('cart');
        return redirect(route('portal.orders.index'))->withFlashSuccess('Order saved');
    }
}
