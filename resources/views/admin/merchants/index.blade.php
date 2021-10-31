<style>
    span.select2-container {
        z-index: 10050;
        width: 100% !important;
        padding: 0;
    }

    .select2-container .select2-search--inline {
        float: left;
        width: 100%;
    }

    .resturant-filter span.select2-container {
        z-index: 999;
        width: 100% !important;
        padding: 0;
    }

    /*.modal-open .modal {*/
    /*overflow-x: hidden;*/
    /*overflow-y: auto;*/
    /*z-index: 99999;*/
    /*}*/
</style>
@extends('management.layouts.master',[
'page_header' => 'التجار',
'page_description' => 'عرض التجار'
])
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('flash::message')

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div>
                    <a href="{{url('admin/merchant/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> تاجر جديد
                    </a>
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">اسم المتجر</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">التصنيف</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="State: activate to sort column ascending">البريد الاليكترونى</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 35.2px;" aria-label="Total: activate to sort column ascending">الهاتف</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 78.2px;" aria-label="Order date: activate to sort column ascending">العنوان</th>
                                        <!-- <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Note: activate to sort column ascending">الصورة</th> -->
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Note: activate to sort column ascending">حالة المطعم</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @php $count = 1; @endphp
                                    @foreach($merchants as $merchant)
                                    <tr id="removable{{$merchant->id}}">
                                        <td>{{$count}}</td>
                                        <td>{{$merchant->name}}</td>
                                        <td>{{$merchant->type->name_ar}}</td>
                                        <td>{{$merchant->email}}</td>
                                        <td>{{$merchant->phone}}</td>
                                        <td>{{$merchant->address}}</td>
                                        {{-- <td>
                                            <a href="{{$merchant->photo_url}}" target="_blank">
                                        <img class="img-index" src="{{$merchant->photo_url}}" height="50" title="user image">
                                        </a>
                                        </td>--}}
                                        <td class="text-center">
                                            @if($merchant->availability == 'open')
                                            <i class="fa fa-circle-o " style="color: green;"></i> مفتوح
                                            @else
                                            <i class="fa fa-circle-o " style="color: red;"></i> مغلق
                                            @endif

                                        </td>

                                        <td>
                                            {{-- <a href="{{url('admin/order/'.$ord->id)}}" class="btn btn-info" title="عرض التفاصيل"> <i class="fa fa-eye"></i></a>
                                            <a href="{{url('admin/assignRunner/'.$ord->id)}}" class="btn btn-success " title="إضافة مندوب"> <span class="fa fa-user-o"></span> </a>
                                            --}}
                                            <!-- activate and de activate -->
                                            @if($merchant->activated)
                                            <a href="merchant/{{$merchant->id}}/de-activate" title='ايقاف التفعيل' class="btn btn-xs btn-danger"><i class="fa fa-close"></i> إيقاف</a>
                                            @else
                                            <a href="merchant/{{$merchant->id}}/activate" title='تفعيل' class="btn btn-xs btn-success"><i class="fa fa-check"></i> تفعيل</a>
                                            @endif
                                            <!-- end activate and de activate -->
                                            <!-- --edit merchant  -->
                                            <a href="{{ url('admin/merchant/'.$merchant->id.'/edit') }}" class="btn btn-success btn-sm ">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <!-- --delete merchant  -->
                                            <a href="javascript:void(0);" data-id="{{$merchant->id}}" onclick="deleteMerchant(this);" class="btn btn-danger btn-sm ">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                              <!-- --edit merchant items  -->
                                              <a href="{{ url('admin/showItems/'.$merchant->id) }}"  class="btn btn-secondary btn-sm ">
                                               items
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

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>




@stop
@section('scripts')
<script src="{{asset('custom/js/merchant.js')}}"></script>

@endsection