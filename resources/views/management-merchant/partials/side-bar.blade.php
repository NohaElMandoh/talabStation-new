<div class="app-sidebar-wrapper">
    <div class="app-sidebar sidebar-shadow">
        <div class="app-header__logo">
          <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button> 
            <a href="{{asset('images/talab-station-logo.png')}}" data-toggle="tooltip" data-placement="bottom" title="" class="logo-src" data-original-title="KeroUI Admin Template"></a>

        </div>
        <div class="scrollbar-sidebar scrollbar-container ps ps--active-y">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu metismenu">
                    <!-- <li class="app-sidebar__heading">القائمة</li> -->
                    <li class="mm-active ">
                        <a href="#" aria-expanded="@if(Request::is('merchant/') == true) true @endif">
                            <!-- <i class="metismenu-icon pe-7s-rocket"></i> -->
                            <i class="lnr lnr-home metismenu-icon " aria-hidden="true"></i>
                            القائمة الرئيسية
                            <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>  -->
                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <ul class=" mm-collapse mm-show  ">

                            <li><a  class="@if(Request::is('merchant/') == true) mm-active selected @endif" href="{{url('merchant')}}">لوحة التحكم</a></li>

                        </ul>
                    </li>
                    <li class="@if(Request::is('merchant/order') == true) mm-active  @endif">
                        <a href="#" aria-expanded="true">
                            <!-- <i class="metismenu-icon pe-7s-rocket"></i> -->
                            <i class="lnr lnr-cart metismenu-icon " aria-hidden="true"></i>
                            الطلبات
                            <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>  -->
                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <ul class=" mm-collapse mm-show  " >

                        <li><a  class="@if(Request::is('merchant/order') == true) mm-active selected @endif"  href="{{url('merchant/order')}}"> الطلبات الواردة</a></li>
                        <li><a  class="@if(Request::is('merchant/acceptedOrders') == true) mm-active selected @endif"  href="{{url('merchant/acceptedOrders')}}">    طلبات قيد التنفيذ</a></li>
                        
                        <li><a  class="@if(Request::is('merchant/completeOrders') == true) mm-active selected @endif"  href="{{url('merchant/completeOrders')}}">   الطلبات المكتملة</a></li>
                        <li><a  class="@if(Request::is('merchant/rejectedOrders') == true) mm-active selected @endif"  href="{{url('merchant/rejectedOrders')}}">   الطلبات المرفوضة</a></li>
                       
                        
                        </ul>
                    </li>
                   
            
                    <li class="@if(Request::is('merchant/item') == true) mm-active  @endif">
                      <a class="@if(Request::is('merchant/item') == true) mm-active selected @endif" href="{{url('merchant/item')}}">منتجاتى</a>
                    </li>
                    <li class="@if(Request::is('merchant/offer') == true) mm-active  @endif">
                      <a class="@if(Request::is('merchant/offer') == true) mm-active selected @endif" href="{{url('merchant/offer')}}">عروضى</a>
                    </li>
                     <li class="@if(Request::is('merchant/profile') == true) mm-active  @endif">
                      <a class="@if(Request::is('merchant/profile') == true) mm-active selected @endif" href="{{url('merchant/profile')}}">الصفحة الشخصية</a>
                    </li>
                    <li class="@if(Request::is('merchant/ticket') == true) mm-active  @endif">
                      <a class="@if(Request::is('merchant/ticket') == true) mm-active selected @endif" href="{{url('merchant/ticket')}}">تواصل معنا</a>
                    </li>
                  {{--
                    <li class="@if(Request::is('merchant/order') == true) mm-active  @endif">
                        <a href="#" aria-expanded="true">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            تقارير
                            <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>  -->
                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <ul class=" mm-collapse mm-show  ">

                        <li><a  class="@if(Request::is('merchant/report') == true) mm-active selected @endif"  href="{{url('merchant/report')}}">مبيعات</a></li>
                    
                        </ul>
                    </li>--}}
                  
<!--                 
                    <li>
                        <a href="https://demo.dashboardpack.com/kero-html-sidebar-pro/charts-sparklines.html">
                            <i class="metismenu-icon pe-7s-graph1">
                            </i>Chart Sparklines
                        </a>
                    </li> -->
                </ul>
            </div>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; height: 729px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 416px;"></div>
            </div>
        </div>
    </div>
</div>
<div class="app-sidebar-overlay d-none animated fadeIn"></div>