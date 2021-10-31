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
إضافة نوع متجر جديد
@endsection
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <div class="box-body">

        @include('admin.types.form')
    </div>

</div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/type.js')}}"></script>
@endsection