@extends('management.layouts.master')
@section('content')
    
    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
    
        <div class="box-body">
            @include('admin.clients.form')
            
        </div>
     
    </div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/client.js')}}"></script>
@endsection