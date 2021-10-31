@extends('management.layouts.master')
@section('content')
   {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cutlery"></i> {{$restaurant->name}}</a></li>
    </ol>--}}
    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
    

        <div class="box-body">

            @include('admin.clients.formEdit')

        </div>
        
    </div><!-- /.box -->

@endsection

@section('scripts')
<script src="{{asset('custom/js/client.js')}}"></script>
@endsection