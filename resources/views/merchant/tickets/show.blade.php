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
 
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body" style="text-align: right;">
             
                <div class="form-row"> 
                <div class="col-md-12">
                        <h5 class="card-title" style="margin-top: 10px;">نوع الرسالة</h5> 
                        {{$ticket->type}}
                </div>       
            </div>
            
            <div class="form-row"> 
                <div class="col-md-12">
                        <h5 class="card-title" style="margin-top: 10px;">تاريخ الرسالة</h5> 
                        {{date('d-m-Y', strtotime($ticket->created_at))}}
                </div>       
            </div>
                <div class="form-row"> 
                <div class="col-md-12">
                        <h5 class="card-title" style="margin-top: 10px;">المحتوى </h5> 
                        {!!html_entity_decode($ticket->content)!!}   
                </div>       
            </div>
            </div>
        </div>
    </div>

</div>


@endsection