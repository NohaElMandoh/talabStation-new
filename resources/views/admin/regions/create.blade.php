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
إضافة منطقة جديدة
@endsection
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
    
    <div class="box-body">
        @include('admin.regions.form')
        
    </div>

</div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/region.js')}}"></script>
@endsection