@extends('management-merchant.layouts.master')

@inject('merchant','App\Models\Merchant')
<?php
$merchants = $merchant->pluck('name', 'id')->toArray();
?>
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
                <form action="{{url('merchant/filterCompletedOrders')}}" method="GET">
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

                            <input type="date" name="ending_at" class="form-control validate[required]" id="ending_at" formate="yyyy-mm-dd" value="{{old('ending_at')}}">

                        </div>
                        <div class="col-md-6">
                            <label for="starting_at" class=""> : من </label>
                            <input type="date" name="starting_at" class="form-control validate[required]" id="starting_at" formate="yyyy-mm-dd" value="{{old('starting_at')}}">

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

                                    @php $count = 1;
                                    $total=0;
                                    @endphp
                                    @foreach($orders as $o)
                           

                                    <tr id="">
                                        <td>{{$count}}</td>
                                        <td>{{--<a href="{{url('merchant/order/'.$o->id)}}">#{{$o->id}}</a>--}}</td>
                                        <td>@if(!empty($o->client)){{$o->client->name}}@endif</td>
                                        <td>{{$o->state_text}}</td>
                                        <td>

                                          {{--  @foreach($o->items as $item)

                                            @if($item->merchant_id== Auth::user()->id)
                                            @php
                                               $total += ($item->pivot->price * $item->pivot->quantity)
                                            @endphp
                                            @endif
                                            @endforeach
                                            {{$total}}--}}

                                        </td>
                                        <td>{{$o->created_at}}<br> 
                                
                                  
                                @php
                               
$strTimeAgo = ""; 
if(!empty($o->created_at)) {
$strTimeAgo = timeago($o->created_at);
}


@endphp
</td>
                                        <td>{{$o->note}}</td>

                                        <td>
                                            <a href="{{url('merchant/order/'.$o->id)}}" class="btn btn-info" title="عرض التفاصيل"> <i class="fa fa-eye"></i></a>

                                          {{--  <a href="{{ url('merchant/order/'.$o->id.'/edit') }}" class="btn btn-primary ">
                                                <span class="icon-pencil"></span>
                                            </a>--}}
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

@endsection
@section('scripts')
<script src="{{asset('merchant-js/custom/js/order.js')}}"></script>

@endsection