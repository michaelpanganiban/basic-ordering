<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use DB;
class ProductConfigurationController extends Controller
{
    public function index(){
        $configuration = Product::leftjoin('users', 'users.id', "=", "products.created_by")
            ->select("products.*", "users.name")
            ->get();
        return view("product-configuration", compact('configuration'));
    }

    public function manageProduct(){
        if(\request()->type == 'add'){
            DB::beginTransaction();
            try {
                \request()->validate([
                    "product_name" => 'required',
                    "amount" => 'required | numeric',
                ]);
                $product = new Product();
                $product->product_name = \request()->product_name;
                $product->price = \request()->amount;
                $product->created_by = \Auth::id();
                $product->save();
                DB::commit();
                return response()->json(["success"=> true, "message" =>"Product Configuration has been added"]);
            } catch (\Exception $e){
                DB::rollBack();
                return response()->json(["success"=> false, "message" =>$e->getMessage()], 400);
            }
        } //add
        else{
            DB::beginTransaction();
            try {
                $product = Product::find(base64_decode(request()->id));
                $product->delete();
                DB::commit();
                return response()->json(["success"=> true, "message" =>"Product Configuration has been deleted"]);
            } catch (\Exception $e){
                DB::rollBack();
                return response()->json(["success"=> false, "message" =>$e->getMessage()], 400);
            }
        }//delete
    }
}
