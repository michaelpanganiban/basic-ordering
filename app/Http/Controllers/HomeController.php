<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Order::leftjoin("delivery_configurations", "orders.delivery_id", "=", "delivery_configurations.config_id")
                        ->select("orders.*", "delivery_configurations.location_name")
                        ->get();
        return view('home', compact('data'));
    }

    public function manageOrders(){
        if(\request()->type == "view"){
            $data = Order::leftjoin("order_line", 'orders.order_id', "=", "order_line.order_id")
                            ->leftjoin("products", "order_line.product_id", "=", "products.product_id")
                            ->where("orders.order_id", base64_decode(\request()->order_id))
                            ->select("orders.*", "order_line.*", "products.product_name")
                            ->get();
            return json_encode($data);
        }
        else{
            $data = \request()->data;
            $orders = \request()->orders;
            DB::beginTransaction();
            try {
                $orders += array('created_by'=> Auth::id());
                $result = Order::create($orders);
                for($i = 0; $i < sizeof($data); $i++){
                    $data[$i] += array("order_id" => $result->order_id);
                }
                OrderLine::insert($data);
                DB::commit();
                return response()->json(["success"=> true, "message" =>"Order has been added"]);
            } catch (\Exception $e){
                DB::rollBack();
                return response()->json(["success"=> false, "message" =>$e->getMessage()], 400);
            }
        }
    }
}























