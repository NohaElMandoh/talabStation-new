@extends('management-merchant.layouts.master')

@inject('merchant','App\Models\Merchant')
<?php
$merchants = $merchant->pluck('name', 'id')->toArray();
?>
@section('subTitle')
عرض التفاصيل
@endsection
@section('content')
<div class="row">
  
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4">

                    <div class="row">
                        <div class="col-sm-12">
                           <h5 style="text-align: center;">قريبـــــــــــــــــــــــــــــا</h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('merchant-js/custom/js/order.js')}}"></script>

@endsection