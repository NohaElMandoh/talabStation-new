@extends('management-merchant.layouts.master')
@section('style')
<style>
    .table thead th {
        text-align: right;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="col-sm-12 col-12 text-center text-sm-right">
                    <!-- <h2>تفاصيل طلب</h2> -->
                    <p class="pb-sm-3"> {{$order->id}} : تفاصيل الطلب رقم </p>

                </div>
            </div>
        </div>
    </div>
</div>
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
                                        <!-- <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">رقم الطلب</th> -->
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">المنتجات والوصف</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="State: activate to sort column ascending">نوع المنتج</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 35.2px;" aria-label="Total: activate to sort column ascending">الكمية</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 78.2px;" aria-label="Order date: activate to sort column ascending">سعر الوحدة</th>
                                        <!-- <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 78.2px;" aria-label="Order date: activate to sort column ascending">الحالة</th> -->

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Note: activate to sort column ascending">ملاحظات</th>
                                        <!-- <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th> -->



                                    </tr>
                                </thead>
                                <tbody>

                                    @php $count = 1; @endphp
                                    @foreach($items as $item)




                                    <tr id="">
                                        <td>{{$count}}</td>
                                        <td>
                                            <p>{{$item->item->name}}</p>
                                            <p class="text-muted">{{$item->item->description}}
                                            </p>
                                        </td>
                                        <td>{{$item->item->type}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->price}}</td>
                                      {{--  <td>
                                            @if($item->merchant_state =='accepted') مقبول
                                            @elseif ($item->merchant_state =='pending') قيد الانتظار
                                            @elseif ($item->merchant_state =='rejected') مرفوض
                                            @elseif ($item->merchant_state =='deliverd-to-runner') تم التسليم
                                            @endif
                                        </td>--}}

                                        <td>{{$item->note}}</td>


                                        {{--<td>--}}
                                            <!-- --accept item or refuse it  -->
                                            {{-- @if($item->merchant_state =='pending' || $item->merchant_state =='rejected')--}}
                                          {{--  <a href="javascript:void(0);" onclick="acceptItem({{$item->id}});" title="قبول الطلب" class="btn btn-secondary btn-sm ">
                                                قبول
                                            </a>--}}
                                            {{-- @elseif($item->merchant_state =='accepted')--}}
                                          {{--  <a href="javascript:void(0);" onclick="rejecteItem({{$item->id}});" title='رفض الطلب' class="btn btn-danger btn-sm ">
                                                رفض
                                            </a>--}}
                                            {{-- @endif--}}

                                         {{--   <!-- ----------------Deliver  to Runner -->
                                            <a href="javascript:void(0);" onclick="deliverItem({{$item->id}});" title="تسليم الطلب" class="btn btn-primary btn-sm ">
                                             تسليم
                                            </a>
                                        </td>--}}

                                        {{-- <td class="text-center">

                                            <a class="btn btn-primary float-right add_order_id" data-id="{{$ord->id}}" data-placement="left" title="Assign Order" data-target="#addOrder" data-toggle="modal" id="add_order_id">
                                        <i class="fa fa-plus"></i>
                                        </a>
                                        </td>--}}
                                    </tr>
                                    @php $count ++; @endphp

                                    @endforeach


                                </tbody>

                            </table>
                       
                            <p><a  class="btn btn-secondary btn-sm btnPrint " href="{{URL::to('merchant/printInvoice/'.$order->id)}}">طباعه</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection


@section('scripts')
<script src="{{asset('merchant-js/custom/js/order.js')}}"></script>
<!-- <script src="{{asset('merchant-js/custom/js/jquery.printPage.js')}}"></script> -->


<script>
$(document).ready(function() {
    $(".btnPrint").printPage();
  });
  </script>

@endsection