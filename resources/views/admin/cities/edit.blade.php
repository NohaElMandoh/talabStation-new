@extends('management.layouts.master')
@section('content')
        <!-- general form elements -->
<div class="box box-primary">


    <div class="box-body">

        @include('admin.cities.formEdit')


    </div>


</div><!-- /.box -->

@endsection
@section('scripts')
<script src="{{asset('custom/js/city.js')}}"></script>
@endsection