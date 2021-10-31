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
إضافة وحدة جديدة
@endsection
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <div class="box-body">
        @include('admin.units.form')
    </div>
    
</div><!-- /.box -->

@endsection
@section('scripts')
<script src="{{asset('custom/js/unit.js')}}"></script>
@endsection