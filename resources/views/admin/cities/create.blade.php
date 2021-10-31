@extends('management.layouts.master')
@section('style')
<style>
ul
{
    list-style-type:none;   
}
</style>
@endsection
@section('subTitle')
إضافة محافظة
@endsection
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
   
    <div class="box-body">

        @include('admin.cities.form')

      
    </div>

</div><!-- /.box -->

@endsection
@section('scripts')
<script src="{{asset('custom/js/city.js')}}"></script>
@endsection