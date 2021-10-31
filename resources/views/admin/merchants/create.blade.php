@extends('management.layouts.master')
@section('style')
<style>
    .form-control {
        text-align: right;
    }
    .table thead th {
text-align: right;
 }

th {
    text-align: right;
}
ul
{
    list-style-type:none;   
}
</style>
@endsection
@section('subTitle')
إضافة متجر
@endsection

@section('content')
<!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
  
    <div class="box-body">
        @include('admin.merchants.form')
       
    </div>
  
</div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/merchant.js')}}"></script>

@endsection