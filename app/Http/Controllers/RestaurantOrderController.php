<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Order;
use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantOrderController extends Controller
{
    public function index($id)
    {
        $resto = Restaurant::find($id);

        if (!$resto) {
            abort(404, 'The restaurant you are looking for is not available!');
        }

        $orders = Order::where('resto_id', $id)->orderBy('isComplete')->orderByDesc('created_at')->paginate(10);

        return view('orders.order-index')->with('orders', $orders)->with('resto', $resto);
    }

    public function add($id)
    {
        $resto = Restaurant::findOrFail($id);
        return view('orders.order-add')->with('resto', $resto);
    }

    public function store(Request $request)
    {
        $postData = $this->validate($request, [
            'resto_id' => 'required|exists:restaurants,id',
            'order_data' => 'required|array'
        ]);

        $itemIds = $postData['order_data']['orderDetails'];

        try {
            DB::beginTransaction();

            $orderTotal = 0;
            foreach ($itemIds as $id) {
                $menu = Menu::query()
                    ->where('resto_id', $postData['resto_id'])
                    ->where('id', $id)->first();

                if ($menu) {
                    $orderTotal += $menu->price;
                }
            }

            $order = Order::create([
                'resto_id' => $postData['resto_id'],
                'user_id' => Auth::user()->id,
                'amount' => $orderTotal,
                'isComplete' => 0,
                'order_details' => [
                    'items' => $postData['order_data']['orderDetails'],
                    'customer_name' => $postData['order_data']['customerDetails']['name'],
                    'customer_phone' => $postData['order_data']['customerDetails']['phone'],
                    'customer_address' => $postData['order_data']['customerDetails']['address'],
                ]
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            logger($th->getMessage());
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 500);
        }

        return response()->json($order, 201);
    }
}
