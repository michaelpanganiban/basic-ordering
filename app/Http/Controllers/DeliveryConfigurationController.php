<?php

namespace App\Http\Controllers;

use App\Models\DeliveryConfiguration;
use Illuminate\Support\Facades\Auth;
use DB;
class DeliveryConfigurationController extends Controller
{
    public function index(){
        $configuration = DeliveryConfiguration::leftjoin('users', 'users.id', "=", "delivery_configurations.created_by")
                        ->select("delivery_configurations.*", "users.name")
                        ->get();
        return view('delivery-configuration', compact('configuration'));
    }

    public function manageDelivery(){
        if(\request()->type == 'add'){
            DB::beginTransaction();
            try {
                \request()->validate([
                    "location" => 'required',
                    "amount" => 'required | numeric',
                ]);
                $delivery = new DeliveryConfiguration;
                $delivery->location_name = \request()->location;
                $delivery->delivery_amount = \request()->amount;
                $delivery->created_by = Auth::id();
                $delivery->save();
                DB::commit();
                return response()->json(["success"=> true, "message" =>"Delivery Configuration has been added"]);
            } catch (\Exception $e){
                DB::rollBack();
                return response()->json(["success"=> false, "message" =>$e->getMessage()], 400);
            }
        } //add
        else{
            DB::beginTransaction();
            try {
                $delivery = DeliveryConfiguration::find(base64_decode(request()->id));
                $delivery->delete();
                DB::commit();
                return response()->json(["success"=> true, "message" =>"Delivery Configuration has been deleted"]);
            } catch (\Exception $e){
                DB::rollBack();
                return response()->json(["success"=> false, "message" =>$e->getMessage()], 400);
            }
        }//delete
    }
}
