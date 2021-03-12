@extends('layouts.base')

@section('content')
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">DELIVERY CONFIGURATION</h1><hr>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-md-12 ">
                            <div class="form-group ">
                                <button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#add-activity-modal"><i class="fa fa-plus"></i>&nbsp;&nbsp;CREATE NEW</button>
                            </div>
                        </div>
                        <table class="table table-bordered" id="dataTable" >
                            <thead>
                            <tr>
                                <th>Location</th>
                                <th>Amount</th>
                                <th>Created By</th>
                                <th>Date Creted</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($configuration as $row)
                                    <tr>
                                        <td>{{$row->location_name}}</td>
                                        <td class="text-right">{{$row->delivery_amount}}</td>
                                        <td>{{ucfirst(ucwords($row->name))}}</td>
                                        <td>{{date_format(date_create($row->date_created), 'M d, Y')}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-danger delete-activity"  data-pk="{{base64_encode($row->config_id)}}"><i class="fa fa-trash"></i>&nbsp;&nbsp;&nbsp;Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Add deliver Modal -->
        <div class="modal fade" id="add-activity-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"  style="background-color: #0f6d79">
                        <h3 class="text-center font-weight-light modal-title" style="color: white;">CREATE NEW CONFIGURATION</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form method="POST" id="add-delivery-submit">{{csrf_field()}}
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label >LOCATION</label>
                                            <input required autofocus="autofocus" class="form-control py-1" id="location" type="text" placeholder="ex. Manila/Bicol" />
                                        </div><br>
                                        <div class="col-md-12">
                                            <label>AMOUNT</label>
                                            <input required autofocus="autofocus" class="form-control py-1" id="amount" type="text" placeholder="ex. 100" />
                                        </div>
                                    </div>
                                    <div class="modal-footer text-right">
                                        <div class="col-md-6">
                                            <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Save Configuration</button>
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
