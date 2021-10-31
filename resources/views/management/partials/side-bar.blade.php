<style>
    /* .vertical-nav-menu i.metismenu-state-icon, .vertical-nav-menu i.metismenu-icon{
        text-align: center;
    width: 24px;
    height: 34px;
    line-height: 34px;
    position: absolute;
    right: -5px;
    top: 50%;
    margin-top: -17px;
    font-size: 1.1rem;
    opacity: .45;
    transition: color .2s;
     } */
    i.lnr.lnr-home.metismenu-icon.pe-7s-rocket {
        text-align: center;
        width: 24px;
        height: 34px;
        line-height: 34px;
        position: absolute;
        right: -5px;
        top: 50%;
        margin-top: -17px;
        font-size: 1.1rem;
        opacity: .45;
        transition: color .2s;
    }
</style>
<div class="app-sidebar-wrapper">
    <div class="app-sidebar sidebar-shadow">
        <div class="app-header__logo">
            <!-- <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button> -->
            <a href="{{asset('images/talab-station-logo.png')}}" data-toggle="tooltip" data-placement="bottom" title="" class="logo-src" data-original-title="Talab Station"></a>

        </div>
        <div class="scrollbar-sidebar scrollbar-container ps ps--active-y">
            <div class="app-sidebar__inner">
                <ul class="vertical-nav-menu metismenu">
                    <!-- <li class="app-sidebar__heading">القائمة</li> -->
                    <li class="@if(Request::is('admin/') == true) mm-active selected @endif">

                        <a href="#" aria-expanded="false">
                            <!-- <i class="lnr lnr-chevron-down metismenu-state-icon "></i> -->
                            <i class="lnr lnr-home metismenu-icon " aria-hidden="true"></i>

                            القائمة الرئيسية

                            <i class="fa fa-caret-left" aria-hidden="true"></i>

                            <!-- <i class="lnr lnr-home metismenu-icon " aria-hidden="true"></i> -->
                        </a>


                        {{-- <a href="#" aria-expanded="@if(Request::is('admin/') == true) true @endif">
                            <span class="lnr lnr-chevron-down"></span>

                          
                            القائمة الرئيسية
                            <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>  -->
                            <!-- <i class="fa fa-caret-left" aria-hidden="true"></i> -->
                            <i class="lnr lnr-home metismenu-icon" aria-hidden="true"></i>

                        </a>--}}
                        <ul class=" mm-collapse mm-show  ">

                            <li><a class="@if(Request::is('admin/') == true) mm-active selected @endif" href="{{url('admin')}}">لوحة التحكم</a></li>

                        </ul>
                    </li>
                    <li class="mm-active">
                    <a href="#" aria-expanded="false">
                            <i class="lnr lnr-chevron-down metismenu-state-icon "></i>
                            الطلبات
                            <i class="lnr lnr-cart metismenu-icon " aria-hidden="true"></i>
                        </a>
                       
                        <ul class=" mm-collapse mm-show  ">

                            <li><a class="@if(Request::is('admin/order') == true) mm-active selected @endif" href="{{url('admin/order')}}">الطلبات</a></li>

                        </ul>
                    </li>
                    <li class=" @if(Request::is('admin/galary') == true) mm-active @endif ">
                        <a href="#" aria-expanded="true">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            المعرض
                            <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>  -->
                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <ul class="mm-show mm-collapse">

                            <li><a class="@if(Request::is('admin/galary') == true) mm-active selected @endif" href="{{url('admin/galary')}}">معرض الصور</a></li>

                        </ul>
                    </li>
                    <li class="@if(Request::is('admin/merchant') == true || Request::is('admin/offer') == true) mm-active @endif">
                        <a href="#" aria-expanded="true">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            التجار
                            <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>  -->
                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <ul class="mm-show mm-collapse">

                            <li><a class="@if(Request::is('admin/merchant') == true) mm-active selected @endif" href="{{url('admin/merchant')}}">التجار</a></li>
                            <li><a class="@if(Request::is('admin/offer') == true) mm-active selected @endif" href="{{url('admin/offer')}}">عروض التجار</a></li>

                        </ul>
                    </li>
                    <li class="mm-active">
                        <a href="#" aria-expanded="true">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            العملاء
                            <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>  -->
                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <ul class="mm-show mm-collapse">

                            <li><a class="@if(Request::is('admin/client') == true) mm-active selected @endif" href="{{url('admin/client')}}">العملاء</a></li>

                        </ul>
                    </li>
                    <li class="mm-active">
                        <a href="#" aria-expanded="true">
                            <i class="metismenu-icon pe-7s-rocket"></i>
                            أقسام عامة
                            <!-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>  -->
                            <i class="fa fa-caret-left" aria-hidden="true"></i>
                        </a>
                        <ul class="mm-show mm-collapse">

                            <li><a class="@if(Request::is('admin/category') == true) mm-active selected @endif" href="{{url('admin/category')}}">التصنيفات</a></li>
                            <li><a class="@if(Request::is('admin/city') == true) mm-active selected @endif" href="{{url('admin/city')}}">المحافظات</a></li>
                            <li><a class="@if(Request::is('admin/region') == true) mm-active selected @endif" href="{{url('admin/region')}}">المناطق</a></li>

                            <li><a class="@if(Request::is('admin/unit') == true) mm-active selected @endif" href="{{url('admin/unit')}}">الوحدات</a></li>
                            <li><a class="@if(Request::is('admin/type') == true) mm-active selected @endif" href="{{url('admin/type')}}">نوع المتجر</a></li>

                        </ul>
                    </li>
                    {{-- <li class="mm-active">
                      <a class="@if(Request::is('admin/role') == true) mm-active selected @endif" href="{{url('admin/role')}}">الرتب</a>
                    </li>--}}
                    <li class="mm-active">
                        <a class="@if(Request::is('admin/notification') == true) mm-active selected @endif" href="{{url('admin/notification')}}">الاشعارات</a>
                    </li>
                    <li class="mm-active">
                        <a class="@if(Request::is('admin/contact') == true) mm-active selected @endif" href="{{url('admin/contact')}}">تواصل معنا</a>
                    </li>
                    <li class="mm-active">
                        <a class="@if(Request::is('admin/settings') == true) mm-active selected @endif" href="{{url('admin/settings')}}">الإعدادات</a>
                    </li>



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