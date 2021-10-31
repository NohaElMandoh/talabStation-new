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
                    <a href="{{url('merchant/ticket/create/')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i>  جديد
                    </a>  
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">المحتوى</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">النوع</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="State: activate to sort column ascending">التاريخ</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                                <tbody>

                                    @php $count = 1; @endphp
                                    @foreach($tickets as $ticket)
                                    <tr >
                                        <td>{{$count}}</td>
                                        <td>
                                        {!!html_entity_decode($ticket->content)!!}    
                                        </td>
                                        <td>{{$ticket->type_text}}</td>
                                        <td>{{date('d-m-Y', strtotime($ticket->created_at))}}</td>
                                       
                                        </td>

                                        <td>
                                               <!-- --show offer details -->
                                               <a href="{{url('merchant/ticket/'.$ticket->id)}}" class="btn btn-info btn-sm" title="عرض التفاصيل"> <i class="fa fa-eye"></i></a>
                                          
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