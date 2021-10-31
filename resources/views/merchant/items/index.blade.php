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
@extends('management-merchant.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('flash::message')

        <div class="main-card mb-3 card">
            <div class="card-body">
             <div>
                    <a href="{{url('merchant/item/create/')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> منتج جديد
                    </a>  
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">اسم المنتج</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">الوصف</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="State: activate to sort column ascending">السعر</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 35.2px;" aria-label="Total: activate to sort column ascending">الخصم</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 78.2px;" aria-label="Order date: activate to sort column ascending"> التصنيف</th>
                                        <!-- <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Note: activate to sort column ascending">الصورة</th> -->
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Note: activate to sort column ascending">الوحدة</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @php $count = 1; @endphp
                                    @foreach($items as $item)
                                    <tr >
                                        <td>{{$count}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->description}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->discount}}</td>
                                        <td>{{$item->category->name}}</td>
                                        <td class="text-center">
                                           {{$item->unit->name_ar}}

                                        </td>

                                        <td>
                                              <!-- --show offer details -->
                                              <a href="{{url('merchant/item/show/'.$item->id)}}" class="btn btn-info btn-sm" title="عرض التفاصيل"> <i class="fa fa-eye"></i></a>
                                          
                                            <!-- --edit merchant  -->
                                            <a href="{{ url('merchant/item/edit/'.$item->id) }}" class="btn btn-success btn-sm ">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <!-- --delete merchant  -->
                                            
                                            <a href="javascript:void(0);" data-id="{{$item->id}}" onclick="deleteItem(this);" class="btn btn-danger btn-sm ">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                           
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




@stop
@section('scripts')
<script src="{{asset('merchant-js/custom/js/item.js')}}"></script>

@endsection