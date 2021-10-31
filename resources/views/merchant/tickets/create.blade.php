@extends('management-merchant.layouts.master')
@section('content')
   
    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
       
        <div class="box-body">
            @include('merchant.tickets.form')
            <!-- <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div> -->
        </div>
    </div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('merchant-js/custom/js/ticket.js')}}"></script>

@endsection