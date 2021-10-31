@extends('management-merchant.layouts.master')
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

                    @if(!empty($item->photo_url))
                    <img height="300px" width="400px" src="{{url($item->photo)}}" alt="">
                    @else
                    <img height="100px" width="100px" src="{{url($item->photo)}}" alt="">
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="main-card mb-3 card">
            <div class="card-body" style="text-align: right;">
                <h5 class="card-title">بيانات المنتج</h5>
                <table class="mb-0 table table-bordered" dir="rtl" style="text-align: right;">
                    <tbody>
                        <tr>
                            <th scope="row" style="text-align: right;">
                                <b>الاسم </b></th>
                            <td>{{$item->name}}<b></td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>الوصف </b></th>
                            <td>{{$item->description}}<b></td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>السعر</b></th>
                            <td>{{$item->price}}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>الوحدة</b></th>
                            <td>{{$item->unit->name_ar}}</td>
                        </tr>

                        <tr>
                            <th scope="row" style="text-align: right;"><b>الخصم</b></th>
                            <td>{{$item->discount}}</td>
                        </tr>
                        
                        <tr>
                            <th scope="row" style="text-align: right;"><b>التصنيف</b></th>
                            <td>{{$item->category->name}}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


@endsection