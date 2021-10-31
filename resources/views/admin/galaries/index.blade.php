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
                    <a href="{{url('admin/galary/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i>صورة جديدة
                    </a>
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">اسم الصورة</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">الصورة</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="State: activate to sort column ascending">مكان العرض</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 35.2px;" aria-label="Total: activate to sort column ascending">الحالة</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @php $count = 1; @endphp
                                    @foreach($galaries as $galary)
                                    <tr id="removable{{$galary->id}}">
                                        <td>{{$count}}</td>
                                        <td>{{$galary->name}}</td>
                                         <td>
                                         @if(!empty($galary->photo_url))
                                            <a href="{{url("public/".$galary->photo)}}" target="_blank">
                                                <img class="img-index" src="{{url("public/".$galary->photo)}}" height="50" title="offer image">
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{$galary->position}}</td>
                                        <td class="text-center">
                                           {{$galary->display}}

                                        </td>

                                        <td>
                                           
                                            <!-- activate and de activate -->
                                            @if($galary->display ==1)
                                             <a  href="javascript:void(0);" onclick="noDisplay({{$galary->id}});" title="الغاء من العرض" class="btn btn-secondary btn-sm ">
                                             حذف من العرض 
                                            </a>
                                            @elseif($galary->display ==0)
                                            <a  href="javascript:void(0);" onclick="display({{$galary->id}});"  title='اضافه الى العرض'class="btn btn-secondary btn-sm ">
                                              اضافه الى العرض 
                                            </a>
                                           
                                            @endif
                                            <!-- end activate and de activate -->
                                            <!-- --edit offer  -->
                                            <a href="{{ url('admin/galary/'.$galary->id.'/edit') }}" class="btn btn-success btn-sm ">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <!-- --delete image  -->
                                            <a href="javascript:void(0);"  data-id="{{$galary->id}}"  onclick="deleteImage(this);" class="btn btn-danger btn-sm ">
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
<script src="{{asset('custom/js/galary.js')}}"></script>

@endsection