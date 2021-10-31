@extends('management.layouts.master',[
'page_header' => ' عرض الطلبات',
'page_description' => 'عرض'
])
@inject('merchant','App\Models\Merchant')
<?php
$merchants = $merchant->pluck('name', 'id')->toArray();
?>
@section('subTitle')
عرض التفاصيل
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div>
                    <a href="{{url('admin/offer/create')}}" class="btn btn-primary">
                        <i class="fa fa-plus"></i> عرض جديد
                    </a>
                </div>
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                            <table dir="rtl" style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 119.2px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">#</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Offer_name: activate to sort column ascending">العنوان</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Offer_Merch: activate to sort column ascending">ألمتجر</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Photo: activate to sort column ascending">الصورة</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Offer_Start: activate to sort column ascending">بداية العرض</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 35.2px;" aria-label="Offer_end: activate to sort column ascending">نهاية العرض</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 78.2px;" aria-label="Offer date: activate to sort column ascending"> متاح / غير متاح</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending"> التفاصيل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $count = 1; @endphp
                                    @foreach($offers as $offer)
                                    <tr id="removable{{$offer->id}}">
                                        <td>{{$count}}</td>
                                        <td><a href="{{url('admin/offer/'.$offer->id)}}">{{$offer->name}}</a></td>
                                        <td>{{$offer->merchant->name}}</td>

                                        <td>@if(!empty($offer->photo_url))
                                            <a href="{{url($offer->photo)}}" target="_blank">
                                                <img class="img-index" src="{{url($offer->photo)}}" height="50" title="offer image">
                                            </a>
                                            @endif
                                        </td>
                                        <td>{{$offer->starting_at}}</td>
                                        <td>{{$offer->ending_at}}</td>
                                        <td>@if($offer->available ==true) متاح @else غير متاح @endif</td>

                                        <td>
                                            <!-- --show offer details -->
                                            <a href="{{url('admin/offer/'.$offer->id)}}" class="btn btn-info btn-sm" title="عرض التفاصيل"> <i class="fa fa-eye"></i></a>
                                            <!-- --edit offer  -->
                                            <a href="{{ url('admin/offer/'.$offer->id.'/edit') }}" class="btn btn-success btn-sm ">
                                                <i class="fa fa-pencil" aria-hidden="true"></i>
                                            </a>
                                            <!-- --delete offer  -->
                                            <a href="javascript:void(0);" data-id="{{$offer->id}}" onclick="deleteOffer(this);" class="btn btn-danger btn-sm ">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                             <!-- --send notification or not  -->
                                             @if($offer->notify ==1)
                                             <a  href="javascript:void(0);" onclick="noNotify({{$offer->id}});" title="حذف من الاشعارات" class="btn btn-secondary btn-sm ">
                                             <i class="fa fa-flag" style="color: white;" aria-hidden="true"></i>حذف 
                                            </a>
                                            @elseif($offer->notify ==0)
                                            <a  href="javascript:void(0);" onclick="notify({{$offer->id}});" title='اضافه الى الاشعارات'class="btn btn-secondary btn-sm ">
                                             <i class="fa fa-flag" style="color: white;" aria-hidden="true"></i>اضافه 
                                            </a>
                                            @elseif($offer->notify ==2)
                                            <a  href=""  onclick="notify({{$offer->id}});" title='تم ارسال الاشعارات' class="btn btn-secondary btn-sm ">
                                             <i class="fa fa-flag" style="color: white;" aria-hidden="true"></i>تم الارسال 
                                            </a>
                                            @endif
                                        
                                        </td>
                                    </tr>
                                    @php $count ++; @endphp
                                    @endforeach

                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Name</th>
                                        <th rowspan="1" colspan="1">Position</th>
                                        <th rowspan="1" colspan="1">Office</th>
                                        <th rowspan="1" colspan="1">Age</th>
                                        <th rowspan="1" colspan="1">Start date</th>
                                        <th rowspan="1" colspan="1">Salary</th>
                                    </tr>
                                </tfoot> -->
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
<script src="{{asset('custom/js/offer.js')}}"></script>

@endsection