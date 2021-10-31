@extends('management.layouts.master',[
'page_header' => ' عرض الطلب',
'page_description' => 'عرض'
])
@section('style')
<style>
    .table thead th {
        text-align: right;
    }
</style>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-5">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <div>

                    @if(!empty($offer->photo_url))
                    <img height="300px" width="400px" src="{{url($offer->photo)}}" alt="">
                    @else
                    <img height="100px" width="100px" src="{{url($offer->photo)}}" alt="">
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="main-card mb-3 card">
            <div class="card-body" style="text-align: right;">
                <h5 class="card-title">بيانات العرض</h5>
                <table class="mb-0 table table-bordered" dir="rtl" style="text-align: right;">
                    <tbody>
                        <tr>
                            <th scope="row" style="text-align: right;">
                                <b>الاسم </b></th>
                            <td>{{$offer->name}}<b></td>
                        </tr>
                      
                        <tr>
                            <th scope="row" style="text-align: right;"><b>تصنيف العرض</b></th>
                            <td>  {{$offer->offerTitle->name}}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>السعر</b></th>
                            <td>{{$offer->price}}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>تاريخ البداية</b></th>
                            <td>{{date('d-m-Y', strtotime($offer->starting_at))}}</td>
                        </tr> <tr>
                            <th scope="row" style="text-align: right;"><b>تاريخ النهاية</b></th>
                            <td>{{date('d-m-Y', strtotime($offer->ending_at))}}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>متاح/غير متاح</b></th>
                            <td>@if($offer->available ==true) متاح @else غير متاح @endif</td>
                        </tr>
                       
                      
                    </tbody>
                </table>
                <div class="form-row"> 
                <div class="col-md-12">
                        <h5 class="card-title" style="margin-top: 10px;">وصف العرض</h5> 
                        {{$offer->description}}
                </div>       
            </div>
                <div class="form-row">
                        <div class="col-md-12">
                        <h5 class="card-title" style="margin-top: 10px;">أصناف العرض</h5>
                            <!-- <label> :أصناف العرض</label> -->
                            <div class="card-body item_table" dir='rtl'>
                
                                <table class="mb-0 table table-hover" id="itemstable" style="text-align: right;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="text-align: right;">الصنف</th>
                                            <!-- <th>الكمية</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @if(!empty($offer->items ))
                                        @foreach($offer->items as $i)

                                        <tr>
                                            <td>{{$count}}</td>
                                            <td>{{$i->name}}</td>

                                        </tr>
                                        @php $count ++; @endphp
                                        @endforeach
                                        @endif
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