<div class="app-header">

    <div class="app-header-right">
        <div class="search-wrapper">
            <!-- <i class="search-icon-wrapper typcn typcn-zoom-outline"></i> -->
            <!-- <i ><img class="search-icon-wrapper typcn typcn-zoom-outline" src="{{asset('public/Dashboard-UI/icons/search_Zoom.png')}}"></i> -->
            <span class="material-icons search-icon-wrapper">
                search
            </span>
            <input type="text" placeholder="Search...">
        </div>
        <div class="header-btn-lg pr-0">
            <div class="header-dots">
                <!-- <div class="dropdown">
                                        <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 mr-2 btn btn-link">
                                            <i class="typcn typcn-th-large-outline"></i>
                                        </button>
                                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                                            <div class="dropdown-menu-header">
                                                <div class="dropdown-menu-header-inner bg-vicious-stance">
                                                    <div class="menu-header-image opacity-4" style="background-image: url(&#39;assets/images/dropdown-header/city5.jpg&#39;);"></div>
                                                    <div class="menu-header-content text-white">
                                                        <h5 class="menu-header-title">Grid Dashboard</h5>
                                                        <h6 class="menu-header-subtitle">Easy grid navigation inside dropdowns</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="grid-menu grid-menu-xl grid-menu-3col">
                                                <div class="no-gutters row">
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"></i>
                                                            Automation
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i class="pe-7s-piggy icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                                            Reports
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i class="pe-7s-config icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                                            Settings
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i class="pe-7s-browser icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                                            Content
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i class="pe-7s-hourglass icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                                            Activity
                                                        </button>
                                                    </div>
                                                    <div class="col-sm-6 col-xl-4">
                                                        <button class="btn-icon-vertical btn-square btn-transition btn btn-outline-link">
                                                            <i class="pe-7s-world icon-gradient bg-night-fade btn-icon-wrapper btn-icon-lg mb-3"> </i>
                                                            Contacts
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="nav flex-column">
                                                <li class="nav-item-divider nav-item"></li>
                                                <li class="nav-item-btn text-center nav-item">
                                                    <button class="btn-shadow btn btn-primary btn-sm">Follow-ups</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div> -->
                <div class="dropdown">
                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="p-0 btn btn-link">
                        <!-- <i class="typcn typcn-bell"></i> -->

                        <span class="iconify" data-icon="clarity:bell-outline-badged" data-inline="false"></span>
                        @if(!empty(Auth::user()->notificationCount()))
                        <span style="font-size: 16;color: red;">

                            {{Auth::user()->notificationCount()}}</span>
                        @endif
                        <!-- <span class="badge badge-dot badge-dot-sm badge-danger">Notifications</span> -->


                    </button>
                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu-xl rm-pointers dropdown-menu dropdown-menu-right">
                        <div class="dropdown-menu-header mb-0">
                            <div class="dropdown-menu-header-inner bg-night-sky">
                                <div class="menu-header-image opacity-5" style="background-image: url(&#39;assets/images/dropdown-header/city2.jpg&#39;);"></div>
                                <div class="menu-header-content text-light">
                                    <h5 class="menu-header-title">Notifications</h5>
                                    <h6 class="menu-header-subtitle">You have <b>
                                            <a class="@if(Request::is('admin/notification') == true) mm-active selected @endif" href="{{url('admin/notification')}}">{{Auth::user()->notificationCount()}}</a>

                                        </b> unread messages</h6>
                                </div>
                            </div>
                        </div>
                        <!-- <ul class="tabs-animated-shadow tabs-animated nav nav-justified tabs-shadow-bordered p-3">
                            <li class="nav-item">
                                <a role="tab" class="nav-link active" data-toggle="tab" href="https://demo.dashboardpack.com/kero-html-sidebar-pro/#tab-messages-header">
                                    <span>Messages</span>
                                </a>
                            </li>
                          
                        </ul> -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab-messages-header" role="tabpanel">
                                <div class="scroll-area-sm">
                                    <div class="scrollbar-container ps">
                                        <div class="p-3">
                                            <div class="notifications-box">
                                                <div class="vertical-time-simple vertical-without-time vertical-timeline vertical-timeline--one-column">
                                                    <!-- <div class="vertical-timeline-item dot-danger vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">All Hands Meeting</h4><span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item dot-warning vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <p>Yet another one, at <span class="text-success">15:00 PM</span></p><span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div> -->
                                                    @foreach(Auth::user()->notifications_header as $notification)

                                                    <div class="vertical-timeline-item dot-success vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"></span>
                                                            <div class="vertical-timeline-element-content bounce-in">
                                                                <h4 class="timeline-title">{{$notification->title}}
                                                                    <!-- <span class="badge badge-danger ml-2">NEW</span> -->
                                                                </h4>
                                                                <span class="vertical-timeline-element-date"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          
                        </div>
                        <ul class="nav flex-column">
                            <li class="nav-item-divider nav-item"></li>
                            <li class="nav-item-btn text-center nav-item">
                                <a class="btn-shadow btn-wide btn-pill btn btn-focus btn-sm" href="{{url('admin/notification')}}">See All Notification</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-btn-lg pr-0">
            <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                    <div class="widget-content-left">
                        <div class="btn-group">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                <img width="42" class="rounded" src="@if(Auth::user()->photo)  {{url(Auth::user()->photo)}} @else {{asset('Dashboard-UI/3.jpg')}} @endif " alt="">
                                <!-- <i class="fa fa-angle-down ml-2 opacity-8"></i>
                             -->
                                <span class="iconify ml-2 opacity-8" data-icon="uil:angle-down" data-inline="false"></span>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="rm-pointers dropdown-menu-lg dropdown-menu dropdown-menu-right">
                                <div class="dropdown-menu-header">
                                    <div class="dropdown-menu-header-inner bg-info">
                                        <div class="menu-header-image opacity-2" style="background-image: url(public/Dashboard-UI/1.jpg)"></div>
                                        <div class="menu-header-content text-left">
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left mr-3">
                                                        <img width="42" class="rounded-circle" src="@if(Auth::user()->photo)  {{url(Auth::user()->photo)}} @else {{asset('Dashboard-UI/3.jpg')}} @endif " alt="">
                                                    </div>
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">{{Auth::user()->name}}
                                                        </div>
                                                        <!-- <div class="widget-subheading opacity-8">A short profile description
                                                        </div> -->
                                                    </div>
                                                    <div class="widget-content-right mr-2">
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                        {{ csrf_field() }}
                                                            <button class="btn-pill btn-shadow btn-shine btn btn-focus">Logout
                                                            </button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="scroll-area-xs" style="height: 150px;">
                                    <div class="scrollbar-container ps">
                                        <ul class="nav flex-column">
                                            <li class="nav-item-header nav-item">Activity
                                            </li>
                                           {{-- <li class="nav-item-header nav-item">
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                                             
                                                    <a class="btn-pill btn-shadow btn-shine btn btn-focus">Logout
</a>
                                                </form>
                                            </li>--}}

                                            <!-- <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Chat
                                                    <div class="ml-auto badge badge-pill badge-info">8
                                                    </div>
                                                </a>
                                            </li> -->
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">profile
                                               
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Recover Password
                                                </a>
                                            </li>
                                            <li class="nav-item-header nav-item">My Account
                                            </li>
                                            <!-- <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Settings
                                                    <div class="ml-auto badge badge-success">New
                                                    </div>
                                                </a>
                                            </li> -->
                                            <!-- <li class="nav-item">
                                              <a href="javascript:void(0);" class="nav-link">Messages
                                                    <div class="ml-auto badge badge-warning">512
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="javascript:void(0);" class="nav-link">Logs
                                                </a>
                                            </li> -->
                                        </ul>
                                        <!-- <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                        </div> -->
                                    </div>
                                </div>
                                <ul class="nav flex-column">
                                    <li class="nav-item-divider mb-0 nav-item"></li>
                                </ul>
                                <div class="grid-menu grid-menu-2col">
                                    <div class="no-gutters row">
                                        <div class="col-sm-6">
                                            <a href="{{url('admin/contact')}}" class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-warning">
                                                <i class="lnr lnr-inbox pe-7s-chat icon-gradient bg-amy-crisp btn-icon-wrapper mb-2"></i>
                                                شكاوى العملاء
                                           </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <button class="btn-icon-vertical btn-transition btn-transition-alt pt-2 pb-2 btn btn-outline-danger">
                                                <i class="lnr lnr-inbox pe-7s-ticket icon-gradient bg-love-kiss btn-icon-wrapper mb-2"></i>
                                                <!-- <i class="lnr lnr-inbox"></i> -->
                                                <b>شكاوى التجار</b>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav flex-column">
                                    <li class="nav-item-divider nav-item">
                                    </li>
                                    <li class="nav-item-btn text-center nav-item">
                                        <!-- <button class="btn-wide btn btn-primary btn-sm">
                                            Open Messages
                                        </button> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="app-header-overlay d-none animated fadeIn"></div>
    <div class="page-title-heading">
        Talab Station
        <div class="page-title-subheading">
            طلب ستيشن
            @yield('subTitle')
        </div>
    </div>
</div>