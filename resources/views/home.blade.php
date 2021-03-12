@extends('layouts.base')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">ORDER TAKER</h1><hr>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-md-12 ">
                            <div class="form-group ">
                                <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#add-activity-modal"><i class="fa fa-plus"></i>&nbsp;&nbsp;CREATE ORDERS</button>
                            </div>
                        </div>
                        <table class="table table-bordered" id="dataTable" >
                            <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Location</th>
                                <th>Sub total</th>
                                <th>Delivery Amount</th>
                                <th>Total Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $row)
                                <tr>
                                    <td>{{$row->customer_name}}</td>
                                    <td>{{$row->location_name}}</td>
                                    <td>{{$row->sub_total}}</td>
                                    <td>{{$row->deliver_amount}}</td>
                                    <td>{{$row->total_amount}}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary view"  data-pk="{{ base64_encode($row->order_id) }}"><i class="fa fa-eye"></i>&nbsp;&nbsp;&nbsp;View</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Add order Modal -->
        <div class="modal fade" id="add-activity-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="min-width: 80%;">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #0f6d79">
                        <h3 class="text-center font-weight-light modal-title" style="color: white;">CREATE ORDERS</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="POST" id="add-activity-submit">{{csrf_field()}}
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" >CUSTOMER NAME</label>
                                                    <input required autofocus="autofocus" class="form-control" id="customer" type="text" placeholder="Input a customer name here.." />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1">LOCATION</label>
                                                    <select class="form-control" id="location" required>
                                                        <option data-pk="{{base64_encode(0)}}" value="">Select Location</option>
                                                        @foreach(\App\Models\DeliveryConfiguration::all() as $row)
                                                            <option value="{{$row->config_id}}" data-pk="{{base64_encode($row->delivery_amount)}}">{{$row->location_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-3">
                                                    <label class="small mb-1">ORDER NAME</label>
                                                    <select class="form-control" id="item-product" >
                                                        <option value="">Select Item</option>
                                                        @foreach(\App\Models\Product::all() as $row)
                                                            <option value="{{$row->product_id}}" data-price="{{base64_encode($row->price)}}">{{$row->product_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1" >QUANTITY</label>
                                                    <input  autofocus="autofocus" value="1" class="form-control" id="quantity" type="number"/>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1" >AMOUNT</label>
                                                    <input  autofocus="autofocus" class="form-control" id="amount" readonly type="text"/>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1">DISCOUNT</label>
                                                    <select class="form-control" id="discount" >
                                                        <option value="0" data-pk="{{base64_encode(0)}}">Select Discount</option>
                                                        @foreach(\App\Models\DiscountConfiguration::all() as $row)
                                                            <option value="{{$row->discount_id}}" data-pk="{{base64_encode($row->percentage)}}">{{$row->discount_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="small mb-1" >TOTAL AMT</label>
                                                    <input  autofocus="autofocus" class="form-control" id="total-per-item" readonly type="text"/>
                                                </div>
                                                <div class="col-md-1 pull-right">
                                                    <label class="small mb-1 " >&nbsp;</label><br>
                                                    <button class="btn btn-sm btn-primary" type="button" id="add-button"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="attach-body"></div> <!--- attach orders here -->
                                    <div class="form-row">
                                        <div class="col-md-12 pull-right">
                                            <label class="large mb-1"><b>SUB TOTAL: </b></label> <i id="sub-total" style="color: red; font-weight: bolder; font-size: 20px;">0</i> |
                                            <label class="large mb-1"><b>DELIVERY FEE: </b></label> <i id="delivery-total" style="color: red; font-weight: bolder; font-size: 20px;">0</i> |
                                            <label class="large mb-1"><b>TOTAL AMOUNT: </b></label> <i id="all-in" style="color: red; font-weight: bolder; font-size: 20px;">0</i>
                                        </div>
                                    </div>
                                    <div class="modal-footer text-right">
                                        <div class="col-md-6">
                                            <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Proceed Order</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--View order Modal -->
        <div class="modal fade" id="view-order-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="min-width: 80%;">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #0f6d79">
                        <h3 class="text-center font-weight-light modal-title" style="color: white;">VIEW ORDERS</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="POST">{{csrf_field()}}
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label class="small mb-1" >CUSTOMER NAME</label>
                                                    <input required readonly autofocus="autofocus" class="form-control" id="view-customer" type="text" placeholder="Input a customer name here.." />
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="small mb-1">LOCATION</label>
                                                    <select class="form-control" disabled id="view-location" required>
                                                        <option data-pk="{{base64_encode(0)}}">Select Location</option>
                                                        @foreach(\App\Models\DeliveryConfiguration::all() as $row)
                                                            <option value="{{$row->config_id}}" data-pk="{{base64_encode($row->delivery_amount)}}">{{$row->location_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div><hr>
                                    <div id="view-attach-body"></div> <!--- attach orders here -->
                                    <div class="form-row">
                                        <div class="col-md-12 pull-right">
                                            <label class="large mb-1"><b>SUB TOTAL: </b></label> <i id="view-sub-total" style="color: red; font-weight: bolder; font-size: 20px;">0</i> |
                                            <label class="large mb-1"><b>DELIVERY FEE: </b></label> <i id="view-delivery-total" style="color: red; font-weight: bolder; font-size: 20px;">0</i> |
                                            <label class="large mb-1"><b>TOTAL AMOUNT: </b></label> <i id="view-all-in" style="color: red; font-weight: bolder; font-size: 20px;">0</i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
