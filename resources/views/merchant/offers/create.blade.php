@extends('management-merchant.layouts.master')
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
إضافة عرض
@endsection




@section('content')
<!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
  
    <div class="box-body">
        @include('merchant.offers.form')
        <!-- <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div> -->
    </div>
    {!! Form::close()!!}
</div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('merchant-js/custom/js/offer.js')}}"></script>

@endsection