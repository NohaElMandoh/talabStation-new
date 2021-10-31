@extends('management.layouts.master')
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
    <div class="box-body">
        @include('admin.categories.formEdit')
    </div>

</div><!-- /.box -->

@endsection
@section('scripts')
<script src="{{asset('custom/js/category.js')}}"></script>
@endsection