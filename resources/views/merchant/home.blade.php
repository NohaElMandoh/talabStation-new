@extends('management-merchant.layouts.master')
@inject('merchant','App\Models\Merchant')
@inject('order','App\Models\Order')
@inject('client','App\Models\Client')
@inject('runner','App\Models\Runner')

<?php
$usersCount = $client->all()->count();
$ordersCount = $order->where('state', '!=', 'pending')->get()->count();
$merchantCount = $merchant->all()->count();
$runnerCount = $runner->all()->count();

?>
<style>
    /* Add the following CSS block to your own
stylesheet. */
    .lnr {
        display: inline-block;
        fill: currentColor;
        width: 1em;
        height: 1em;
        vertical-align: -0.05em;
    }

    .lnr-mustache {
        color: #0F52BA;
        /* We can use "color" for setting the color
  of the SVG because we set its "fill" to
  "currentColor" */
        font-size: 40px;
        /* We can use "font-size" for changing the size
  of the SVG because its width and height were
  set 1em.
  To get crisp results, use sizes that are
  a multiple of 20; because Linearicons was
  designed on a 20 by 20 grid. */
    }
    /* ----custom styles */

/* #title {
    color: red;
} */
</style>
@section('content')
<div class="mb-3 card">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
            <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
            <!-- <span class="lnr lnr-cart"></span> -->
            <span id="title">الطلبات</span>
        </div>

    </div>
    <div class="no-gutters row">


        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                <div class="widget-chart-content" style="text-align: right;">
                    <div class="widget-subheading">قيد الإنتظار</div>
                    <div class="widget-numbers" style="margin-right: 0;"><a href="{{url('merchant/order')}}">{{count($new_orders)}}</a></div>
                    <!-- <div class="widget-description opacity-8 text-focus">
                                                                <div class="d-inline text-danger pr-1">
                                                                    <i class="fa fa-angle-down"></i>
                                                                    <span class="pl-1">54.1%</span>
                                                                </div>
                                                                less earnings
                                                            </div> -->
                </div>
                <div class="icon-wrapper rounded-circle" style="margin:0 0 0 1rem">
                    <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                    <i class="lnr lnr-cart text-dark opacity-8"></i>
                    <!-- <span class="lnr lnr-cart"></span> -->

                </div>

            </div>
            <div class="divider m-0 d-md-none d-sm-block"></div>
        </div>
        
        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">

                <div class="widget-chart-content" style="text-align: right;">
                    <div class="widget-subheading">مكتملة</div>
                    <div class="widget-numbers" style="margin-right: 0;"><span><a href="{{url('merchant/completeOrders')}}">{{count($completed_orders)}}</a></span></div>
                    <!-- <div class="widget-description opacity-8 text-focus">
                        Grow Rate:
                        <span class="text-info pl-1">
                            <i class="fa fa-angle-down"></i>
                            <span class="pl-1">14.1%</span>
                        </span>
                    </div> -->
                </div>
                <div class="icon-wrapper rounded-circle" style="margin:0 0 0 1rem">
                    <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                    <i class="lnr lnr-cart text-white"></i>
                </div>
            </div>
            <div class="divider m-0 d-md-none d-sm-block"></div>
        </div>
        
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">

                <div class="widget-chart-content" style="text-align: right;">
                    <div class="widget-subheading">مرفوضة</div>
                    <div class="widget-numbers" style="margin-right: 0;"><a href="{{url('merchant/rejectedOrders')}}">{{count($rejected_orders)}}</a></div>
                    <!-- <div class="widget-description text-focus">
                        Increased by
                        <span class="text-warning pl-1">
                            <i class="fa fa-angle-up"></i>
                            <span class="pl-1">7.35%</span>
                        </span>
                    </div> -->
                </div>
                <div class="icon-wrapper rounded-circle" style="margin:0 0 0 1rem">
                    <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                    <i class="lnr lnr-cart text-white"></i>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">

                <div class="widget-chart-content" style="text-align: right;">
                    <div class="widget-subheading">الإجمالى</div>
                    <div class="widget-numbers " style="margin-right: 0;"><span>{{count($all_orders)}}</span></div>
                    <!-- <div class="widget-description text-focus">
                        Increased by
                        <span class="text-warning pl-1">
                            <i class="fa fa-angle-up"></i>
                            <span class="pl-1">7.35%</span>
                        </span>
                    </div> -->
                </div>
                <div class="icon-wrapper rounded-circle" style="margin:0 0 0 1rem">
                    <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                    <i class="lnr lnr-cart text-white"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- -----------products and offers -->
<div class="mb-3 card">
    <div class="card-header-tab card-header">
        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
            <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
            <!-- <span class="lnr lnr-cart"></span> -->
            المنتجات والعروض
        </div>

    </div>
    <div class="no-gutters row">


    <div class="col-sm-6 col-md-4 col-xl-4">
           
        </div>
        <div class="col-sm-6 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">

                <div class="widget-chart-content" style="text-align: right;">
                    <div class="widget-subheading">العروض </div>
                    <div class="widget-numbers" style="margin-right: 0;"><span><a href="{{url('merchant/offer')}}">{{Auth::user()->offers()->count()}}</a></span></div>
                    <!-- <div class="widget-description opacity-8 text-focus">
                        Grow Rate:
                        <span class="text-info pl-1">
                            <i class="fa fa-angle-down"></i>
                            <span class="pl-1">14.1%</span>
                        </span>
                    </div> -->
                </div>
                <div class="icon-wrapper rounded-circle" style="margin:0 0 0 1rem">
                    <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                    <i class="lnr lnr-gift text-white"></i>
                    
                </div>
            </div>
            <div class="divider m-0 d-md-none d-sm-block"></div>
        </div>
        <div class="col-sm-12 col-md-4 col-xl-4">
            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">

                <div class="widget-chart-content" style="text-align: right;">
                    <div class="widget-subheading">إجمالى المنتجات</div>
                    <div class="widget-numbers " style="margin-right: 0;"><span><a href="{{url('merchant/item')}}"> {{Auth::user()->items()->count()}}</a></span></div>
                    <!-- <div class="widget-description text-focus">
                        Increased by
                        <span class="text-warning pl-1">
                            <i class="fa fa-angle-up"></i>
                            <span class="pl-1">7.35%</span>
                        </span>
                    </div> -->
                </div>
                <div class="icon-wrapper rounded-circle" style="margin:0 0 0 1rem">
                    <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                    <i class="lnr lnr-store text-white"></i>
                </div>
            </div>
        </div>
        
       
    </div>
</div>



{{--
<div class="row" dir="rtl">
    <div class="col-sm-12 col-md-5 col-xl-12">
        <div class="card-hover-shadow-2x mb-3 card">
            <div class="card-header">
                <div>أحدث الإشعارات</div>
                <div class="btn-actions-pane-right actions-icon-btn">
                    <div class="btn-group dropdown">
                        <button data-toggle="dropdown" type="button" aria-haspopup="true" aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
                            <span class="btn-icon-wrapper">
                                <i class="icon ion-android-apps"></i>
                            </span>
                        </button>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                            <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-file-empty"> </i><span>Settings</span>
                            </button>
                            <button type="button" tabindex="0" class="dropdown-item"><i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                            </button>
                            <div tabindex="-1" class="dropdown-divider"></div>
                            <div class="p-3 text-right">
                                <button class="mr-2 btn-shadow btn-sm btn btn-link">
                                    View Details
                                </button>
                                <button class="mr-2 btn-shadow btn-sm btn btn-primary">
                                    Action
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scroll-area-lg">
                <div class="scrollbar-container ps ps--active-y">
                    <div class="p-4" style="text-align: right;">
                        <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                            <!-- <div id="" class="vertical-timeline-item vertical-timeline-element" dir="rtl">
                                <div>
                                    <span class="vertical-timeline-element-icon bounce-in"></span>

                                    <div class="vertical-timeline-element-content bounce-in">
                                        <span class="vertical-timeline-element-date"></span>
                                        <h4 class="timeline-title">All Hands
                                            Meeting</h4>
                                    </div>
                                </div>
                            </div>
                            <div id="" class="vertical-timeline-item vertical-timeline-element">
                                <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                    <div class="vertical-timeline-element-content bounce-in">
                                        <p>Yet another one, at <span class="text-success">15:00 PM</span>
                                        </p><span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div> -->
                            @if(!empty($notifications))
                            @foreach($notifications as $notify)
                            <div id="" class="vertical-timeline-item vertical-timeline-element">
                                <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                    <div class="vertical-timeline-element-content bounce-in">

                                        <h4 class="timeline-title"><a href="{{url('/'.$notify->order_url)}}" id="markNoti" data-id="{{$notify->id}}">
                                                {{$notify->title}}</a></h4>
                                        <span class="text-success">{{$notify->created_at->toDateString()}}</span>
                                        <span class="vertical-timeline-element-date"></span>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                    </div>
                    <div class="ps__rail-y" style="top: 0px; height: 400px; right: 0px;">
                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 235px;"></div>
                    </div>
                </div>
            </div>
            <div class="d-block text-center card-footer">
                <button class="btn-shadow btn-wide btn-pill btn btn-focus">
                    <span class="badge badge-dot badge-dot-lg badge-warning badge-pulse">Badge</span>
                    <a class="@if(Request::is('admin/notification') == true) mm-active selected @endif" href="{{url('admin/notification')}}"> جميع الاشعارات </a>

                    <!-- View All Notifications -->
                </button>
            </div>
        </div>
    </div>

</div>

--}}

<!-- /.row -->
@endsection