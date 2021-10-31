@extends('management.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('flash::message')

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div>
                    <a href="{{url('admin/unit/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> وحدة جديدة
                    </a>
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;text-align: right;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">اسم الوحدة </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending"> En-اسم الوحدة </th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                            
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($units as $unit)
                                    <tr id="removable{{$unit->id}}">
                                        <td>{{$count}}</td>
                                        <td>{{$unit->name_ar}}</td>
                                        <td>{{$unit->name_en}}</td>

                                        <td>

                                            <!-- --edit unit  -->
                                            <a href="unit/{{$unit->id}}/edit" class="btn btn-success btn-sm ">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <!-- --delete image  -->
                                            <a href="javascript:void(0);"  data-id="{{$unit->id}}" onclick="deleteUnit(this);" class="btn btn-danger btn-sm ">
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
<script src="{{asset('custom/js/unit.js')}}"></script>

@endsection

