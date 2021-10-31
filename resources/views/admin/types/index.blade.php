@extends('management.layouts.master')
@section('subTitle')
نوع المتجر
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        @include('flash::message')

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div>
                    <a href="{{url('admin/type/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i>نوع جديد
                    </a>
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;text-align: right;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">اسم النوع </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending"> En-اسم النوع </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending"> صورة </th>


                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                            
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($types as $type)
                                    <tr id="removable{{$type->id}}">
                                        <td>{{$count}}</td>
                                        <td>{{$type->name_ar}}</td>
                                        <td>{{$type->name_en}}</td>
                                        <td>
                                        @if(!empty($type->photo))
                                            <a href="{{url($type->photo)}}" target="_blank">
                                                <img class="img-index" src="{{url($type->photo)}}" height="100" width="100" title="type image">
                                            </a>
                                            @endif
                                        </td>

                                        <td>

                                            <!-- --edit type  -->
                                            <a href="type/{{$type->id}}/edit" class="btn btn-success btn-sm ">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <!-- --delete image  -->
                                            <a href="javascript:void(0);"  data-id="{{$type->id}}" onclick="deleteType(this);" class="btn btn-danger btn-sm ">
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
<script src="{{asset('custom/js/type.js')}}"></script>

@endsection
