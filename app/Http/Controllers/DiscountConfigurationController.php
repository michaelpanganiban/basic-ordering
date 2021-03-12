<?php

namespace App\Http\Controllers;

use App\Models\DiscountConfiguration;
use Illuminate\Support\Facades\Auth;
use DB;
class DiscountConfigurationController extends Controller
{
    public function index(){
        $configuration = DiscountConfiguration::leftjoin('users', 'users.id', "=", "discount_configuration.created_by")
            ->select("discount_configuration.*", "users.name")
            ->get();
        return view("discount-configuration", compact('configuration'));
    }

    public function manageDiscount(){
        if(\request()->type == 'add'){
            DB::beginTransaction();
            try {
                \request()->validate([
                    "discount_name" => 'required',
                    "percent" => 'required | numeric',
                ]);
                $discount = new DiscountConfiguration();
                $discount->discount_name = \request()->discount_name;
                $discount->percentage = \request()->percent;
                $discount->created_by = Auth::id();
                $discount->save();
                DB::commit();
                return response()->json(["success"=> true, "message" =>"Discount Configuration has been added"]);
            } catch (\Exception $e){
                DB::rollBack();
                return response()->json(["success"=> false, "message" =>$e->getMessage()], 400);
            }
        } //add
        else{
            DB::beginTransaction();
            try {
                $delivery = DiscountConfiguration::find(base64_decode(request()->id));
                $delivery->delete();
                DB::commit();
                return response()->json(["success"=> true, "message" =>"Discount     Configuration has been deleted"]);
            } catch (\Exception $e){
                DB::rollBack();
                return response()->json(["success"=> false, "message" =>$e->getMessage()], 400);
            }
        }//delete
    }
}
