@extends('management-merchant.layouts.master')

@inject('merchant','App\Models\Merchant')
<?php $merchants = $merchant->pluck('name', 'id')->toArray(); ?>
@section('subTitle')
    عرض التفاصيل
@endsection
@section('content')
    <div class="row">
        <!-- -----block for fillter--- -->
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <!-- <div class="card-title">Page Block Loading</div> -->
                    <form action="{{ url('merchant/filterAcceptedOrders') }}" method="GET">
                        {{ csrf_field() }}
                        <div class="form-row">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}<br>
                                    @endforeach
                                </div>
                            @endif


                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="ending_at" class=""> : إلى </label>

                                <input type="date" name="ending_at" class="form-control validate[required]" id="ending_at"
                                    formate="yyyy-mm-dd" value="{{ old('ending_at') }}">

                            </div>
                            <div class="col-md-6">
                                <label for="starting_at" class=""> : من </label>
                                <input type="date" name="starting_at" class="form-control validate[required]"
                                    id="starting_at" formate="yyyy-mm-dd" value="{{ old('starting_at') }}">

                            </div>


                        </div>
                        <div class="form-row">
                            <div class="text-center">

                                <button type="submit" class="btn btn-primary mb-2 block-page-btn-example-3 ">
                                    filtter
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- -----end block for fillter--- -->
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                        <div class="row">
                            <div class="col-sm-12">
                                <table dir="rtl" style="width: 100%;" id="example"
                                    class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid"
                                    aria-describedby="example_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" style="width: 119.2px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">#</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                style="width: 187.2px;"
                                                aria-label="Order_Num: activate to sort column ascending">رقم الطلب</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                style="width: 84.2px;"
                                                aria-label="Client: activate to sort column ascending">العميل</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                style="width: 84.2px;"
                                                aria-label="State: activate to sort column ascending">الحالة</th>

                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                style="width: 35.2px;"
                                                aria-label="Total: activate to sort column ascending">الإجمالى</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                style="width: 78.2px;"
                                                aria-label="Order date: activate to sort column ascending">وقت الطلب</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                style="width: 62.2px;" aria-label="Note: activate to sort column ascending">
                                                ملاحظات</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                                style="width: 62.2px;"
                                                aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php$count = 1;
                                            $total = 0;
                                        @endphp
                                        @foreach ($orders as $o)


                                            <tr id="removable{{ $o->id }}" style="text-align:right">
                                                <td>{{ $count }}</td>
                                                <td><a href="{{ url('merchant/order/' . $o->id) }}">#{{ $o->id }}</a>
                                                </td>
                                                <td>
                                                    @if (!empty($o->client))
                                                        {{ $o->client->name }}@endif
                                                </td>
                                                <td>{{ $o->state_text }}</td>
                                                <td>


                                                    {{ $o->total }}

                                                </td>
                                                <td>{{ $o->created_at }}<br>


                                                    @php
                                                        
                                                        $strTimeAgo = '';
                                                        if (!empty($o->created_at)) {
                                                            $strTimeAgo = timeago($o->created_at);
                                                        }
                                                        
                                                    @endphp
                                                </td>
                                                <td>{{ $o->note }}</td>

                                                <td>
                                                    <a href="{{ url('merchant/order/' . $o->id) }}" class="btn btn-info"
                                                        title="عرض التفاصيل"> <i class="fa fa-eye"></i></a>
                                                    <!-- --accept item or refuse it  -->
                                                    @if ($o->state == 'accepted')
                                      <a href="javascript:void(0);" onclick="deliveredOrder({{$o->id}});" title=" تسليم الطلب" class="btn btn-success  ">
                                                تسليم
                                            </a>
                                            <button type="button" class="btn btn-danger " id="rej_btn"
                                            data-id="{{ $o->id }}" data-toggle="modal"
                                            data-target="#rejectOrderReason" >إنهاء</button>
                                            @endif 
                                            
                                                    {{-- <a href="{{ url('merchant/order/'.$o->id.'/edit') }}" class="btn btn-primary ">
                                                <span class="icon-pencil"></span>
                                            </a> --}}
                                                </td>
                                            </tr>
                                            @php $count ++; @endphp
                                        @endforeach



                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
          <!--rejectOrderReasony-->
          <div class="modal fade" id="rejectOrderReason" data-backdrop="false" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">إلغاء طلب</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form id="add_form">
                      <div class="modal-body">
                          <div class="error hidden">
                              <ul></ul>
                          </div>
                          <input type="hidden" name="id" id="order_id">

                          <div class="form-group">
                              <label for="name" class="col-form-label"><span style="color: red;">*</span>سبب غلق الطلب</label>
                              <input type="text" class="form-control validate[required]" name="merchant_reject_reason"
                                  id="merchant_reject_reason">
                          </div>

                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                          <button type="submit" class="btn btn-primary" id="add_reason">حفظ</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>


@endsection
@section('scripts')
<script src="{{ asset('merchant-js/custom/js/order.js') }}"></script>

@endsection
