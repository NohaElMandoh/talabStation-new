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
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">الاسم </th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">الهاتف</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">البريد الاليكترونى</th>

                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">الرسالة</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">النوع</th>


                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>


                                    </tr>
                                </thead>
                            
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($contacts as $contact)
                                    <tr id="removable{{$contact->id}}">
                                        <td>{{$count}}</td>
                                        <td>{{$contact->name}}</td>
                                        <td>
                                        {{$contact->phone}}
                                        </td>
                                        <td>
                                        {{$contact->email}}
                                        </td>
                                        <td>
                                        {{$contact->content}}
                                        </td>
                                        <td>
                                        {{$contact->type}}
                                        </td>
                                        <td>

                                        <a href="{{url('admin/contact/'.$contact->id)}}" class="btn btn-info" title="عرض التفاصيل"> <i class="fa fa-eye"></i></a>

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
<script src="{{asset('public/custom/js/contact.js')}}"></script>

@endsection


