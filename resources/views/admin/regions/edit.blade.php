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
تعديل منطقة 
@endsection
@section('content')
<div class="box box-primary">
    <div class="box-body">
        @include('admin.regions.formEdit')
    </div>
 
</div><!-- /.box -->

@endsection
@section('scripts')
<script src="{{asset('custom/js/region.js')}}"></script>
@endsection