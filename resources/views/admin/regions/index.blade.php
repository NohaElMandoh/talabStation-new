@extends('management.layouts.master')
@section('content')

<div class="row">
    <div class="col-md-12">
        @include('flash::message')

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div>
                    <a href="{{url('admin/region/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> منطقة جديدة
                    </a>
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;text-align: right;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">اسم المنطقة </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending"> En-اسم المنطقة </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending"> المحافظة </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending"> تكلفة التوصيل </th>



                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                            
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($regions as $region)
                                    <tr id="removable{{$region->id}}">
                                        <td>{{$count}}</td>
                                        <td>{{$region->name_ar}}</td>
                                        <td>{{$region->name_en}}</td>
                                        <td>
                                        {{$region->city->name_ar}}
                                        <br>
                                        {{$region->city->name_en}}
                                        </td>
                                        <td>{{$region->delivery_cost}}</td>

                                        <td>

                                            <!-- --edit unit  -->
                                            <a href="region/{{$region->id}}/edit" class="btn btn-success btn-sm ">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <!-- --delete image  -->
                                            <a href="javascript:void(0);"  data-id="{{$region->id}}" onclick="deleteRegion(this);" class="btn btn-danger btn-sm ">
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




@endsection

@section('scripts')
<script src="{{asset('custom/js/region.js')}}"></script>

@endsection

