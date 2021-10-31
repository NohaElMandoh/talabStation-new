@extends('management.layouts.master')

@section('style')
<style>
    .table thead th {
        text-align: right;
    }
</style>
@endsection
@section('subTitle')
تفاصيل الرسالة
@endsection
@section('content')


<div class="row">
 
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body" style="text-align: right;">
                <h5 class="card-title">:بيانات الرسالة</h5>
                @if(!empty($contact))
                <table class="mb-0 table table-bordered" dir="rtl" style="text-align: right;">
                    <tbody>
                        <tr>
                            <th scope="row" style="text-align: right;">
                                <b>الاسم </b></th>
                            <td>{{$contact->name}}<b></td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>البريد الاليكترونى </b></th>
                            <td>{{$contact->email}}<b></td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>التليفون</b></th>
                            <td>{{$contact->phone}}</td>
                        </tr>

                        <tr>
                            <th scope="row" style="text-align: right;"><b>نوع الرسالة</b></th>
                            <td>{{$contact->type}}</td>
                        </tr>
                        <tr>
                            <th scope="row" style="text-align: right;"><b>التاريخ</b></th>
                            <td>{{$contact->created_at}}</td>
                        </tr>

                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body" style="text-align: right;">
                <h5 class="card-title"><b>:محتوى الرسالة</b></h5>
                @if(!empty($contact))
                {{$contact->content}}
                @endif
            </div>
        </div>
    </div>

</div>

@endsection