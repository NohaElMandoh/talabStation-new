@extends('management.layouts.master')
@inject('merchant','App\Models\Merchant')
<?php
$merchants = $merchant->pluck('name', 'id')->toArray();
?>
@section('subTitle')
عرض التفاصيل
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">رقم الطلب</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">العميل</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="State: activate to sort column ascending">الحالة</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 35.2px;" aria-label="Total: activate to sort column ascending">الإجمالى</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 78.2px;" aria-label="Order date: activate to sort column ascending">وقت الطلب</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Note: activate to sort column ascending">ملاحظات</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @php $count = 1; @endphp
                                    @foreach($order as $ord)
                                    <tr id="removable{{$ord->id}}">
                                        <td>{{$count}}</td>
                                        <td><a href="{{url('admin/order/'.$ord->id)}}">#{{$ord->id}}</a></td>
                                        <td>@if(!empty($ord->client)){{$ord->client->name}}@endif</td>
                                        <td>{{$ord->state_text}}</td>
                                        <td>{{$ord->total}}</td>
                                        <td>{{$ord->created_at}}</td>
                                        <td>{{$ord->note}}</td>

                                        <td>
                                            <a href="{{url('admin/order/'.$ord->id)}}" class="btn btn-info" title="عرض التفاصيل"> <i class="fa fa-eye"></i></a>
                                            <a href="{{url('admin/assignRunner/'.$ord->id)}}" class="btn btn-success " title="إضافة مندوب">
                                                <span class="fa fa-user-o"></span> </a>
                                            <a href="{{ url('admin/order/'.$ord->id.'/edit') }}" class="btn btn-primary ">
                                                <span class="icon-pencil"></span>
                                            </a>




                                        </td>

                                        {{-- <td class="text-center">

                                            <a class="btn btn-primary float-right add_order_id" data-id="{{$ord->id}}" data-placement="left" title="Assign Order" data-target="#addOrder" data-toggle="modal" id="add_order_id">
                                        <i class="fa fa-plus"></i>
                                        </a>
                                        </td>--}}
                                    </tr>
                                    @php $count ++; @endphp
                                    @endforeach

                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Position</th>
                                        <th rowspan="1" colspan="1">Office</th>
                                        <th rowspan="1" colspan="1">Age</th>
                                        <th rowspan="1" colspan="1">Start date</th>
                                        <th rowspan="1" colspan="1">Salary</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('public/custom/js/order.js')}}"></script>

@endsection


<!--Add Order-->
{{--<div class="modal fade" id="addOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="modal-body">
    <div class="error hidden">
        <ul></ul>
    </div>
    <div class="form-group">

        <label for="type">Runners</label>
        <select class="form-control validate[required]" id="runner_id" name="runner_id">
            <option disabled selected>Select Type</option>

            @if(!empty($runners))
            @foreach($runners as $runner)
            <option value="{{$runner->id}}">{{$runner->name}}</option>
            @endforeach
            @endif
        </select>
    </div>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" id="add_category" data-route="{{url('admin/addRunner')}}">Save</button>
</div>
</form>
</div>
</div>
</div>--}}
<!--Add Runner-->