@extends('management.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('flash::message')

        <div class="main-card mb-3 card">
            <div class="card-body">
                <div>
                    <a href="{{url('admin/category/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> تصنيف جديد
                    </a>
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">اسم التصنيف</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">الصورة</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                            
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($categories as $category)
                                    <tr id="removable{{$category->id}}">
                                        <td>{{$count}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            @if(!empty($category->photo))
                                            <a href="{{url($category->photo)}}" target="_blank">
                                                <img class="img-index" src="{{url($category->photo)}}" height="100" width="100" title="category image">
                                            </a>
                                            @endif
                                        </td>


                                        <td>

                                            <!-- --edit offer  -->
                                            <a href="category/{{$category->id}}/edit" class="btn btn-success btn-sm ">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <!-- --delete image  -->
                                            <a href="javascript:void(0);"  data-id="{{$category->id}}" onclick="deleteCategory(this);" class="btn btn-danger btn-sm ">
                                            <i class="fa fa-trash-o"></i>
                                            </a>
                                            {{--   <button id="{{$category->id}}" data-token="{{ csrf_token() }}" data-route="{{URL::route('category.destroy',$category->id)}}" type="button" class="destroy btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                            --}}

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
<script src="{{asset('custom/js/category.js')}}"></script>

@endsection