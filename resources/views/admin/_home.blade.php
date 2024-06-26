@extends('admin.layouts.main',[
                                'page_header'       => 'تطبيق أكلات',
                                'page_description'  => 'لوحة التحكم'
                                ])
@inject('merchant','App\Models\Merchant')
@inject('order','App\Models\Order')
@inject('client','App\Models\Client')
@inject('runner','App\Models\Runner')

<?php
    $usersCount = $client->all()->count();
    $ordersCount = $order->where('state','!=','pending')->get()->count();
    $merchantCount = $merchant->all()->count();
    $runnerCount = $runner->all()->count();

?>
@section('content')
        <!-- Info boxes -->
<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-cutlery"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">عدد التجار</span>
                <span class="info-box-number">{{$merchantCount}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-tasks"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">عدد الطلبات المكتملة</span>
                <span class="info-box-number">{{$ordersCount}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">عدد المستخدمين</span>
                <span class="info-box-number">{{$usersCount}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
       <!-- /.col -->
       <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">عدد المناديب</span>
                <span class="info-box-number">{{$runnerCount}}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

</div>
<!-- /.row -->
@endsection
