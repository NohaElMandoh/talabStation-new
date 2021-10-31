@extends('management-merchant.layouts.master')
@section('content')
  
    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
        <div class="box-body">

            @include('merchant.tickets.formEdit')

        </div>
    </div>

@endsection
@section('scripts')
<script src="{{asset('merchant-js/custom/js/ticket.js')}}"></script>

@endsection