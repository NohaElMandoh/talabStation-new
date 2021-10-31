@extends('management.layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        @include('flash::message')

        <div class="main-card mb-3 card">
            <div class="card-body">

                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;text-align: right;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">العنوان</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">المحتوى</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">التاريخ</th>



                                    </tr>
                                </thead>

                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($notifications as $notification)
                                    <tr id="removable{{$notification->id}}">
                                        <td>{{$count}}</td>
                                        <td>{{$notification->title}}</td>
                                        <td>{!!html_entity_decode($notification->content)!!}</td>

                                        <td> {{date('d-m-Y', strtotime($notification->created_at))}}&nbsp;&nbsp; {{$notification->created_at->format('g:i A')}}

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
<script src="{{asset('public/custom/js/category.js')}}"></script>

@endsection