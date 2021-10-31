@extends('management-merchant.layouts.master')
@section('content')
    <div class="box box-primary">
        <div class="box-body">
            @include('merchant.items.formEdit')
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{asset('merchant-js/custom/js/item.js')}}"></script>
@endsection