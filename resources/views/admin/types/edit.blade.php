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
تعديل نوع متجر 
@endsection
@section('content')
      
<div class="box box-primary">
    <div class="box-body">
        @include('admin.types.formEdit')
    </div>
</div><!-- /.box -->

@section('scripts')
<script src="{{asset('custom/js/type.js')}}"></script>
@endsection

@endsection