@extends('management.layouts.master',[
'page_header' => ' عرض الطلب',
'page_description' => 'عرض'
])
@section('style')
<style>
    .table thead th {
        text-align: right;
    }
</style>
@endsection
@section('content')
<div class="content-body">
    <section class="card">
        <div id="invoice-template" class="card-body p-4">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">

                <div class="col-sm-6 col-12 text-center text-sm-left">
                    <h2>فاتورة</h2>
                    <p class="pb-sm-3"># {{$order->id}}</p>
                    <ul class="px-0 list-unstyled">
                        <li>إجمالى الفاتورة</li>
                        <li class="lead text-bold-800">{{$order->total}}</li>
                    </ul>
                </div>
                <div class="col-sm-6 col-12 text-center text-sm-right">
                    <div class="media row" style="margin-right: 10px;">

                        <div class="col-12 col-sm-9 col-xl-10">
                            <div class="media-body">
                                <ul class="ml-2 px-0 list-unstyled">
                                    <li class="text-bold-800">Talab Station Company</li>
                                    <li> شركة طلب ستاشن </li>
                                    <li>شمال سيناء -العريش -شارع القاهرة</li>

                                </ul>
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-xl-2">
                            <img src="{{asset('public/Dashboard-UI/images/talab-station-logo.png')}}" alt="company logo" class="mb-1 mb-sm-0">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Invoice Company Details -->

            <!-- Invoice Customer Details -->
            <div id="invoice-customer-details" class="row pt-2">
                <div class="col-12 text-center text-sm-right">
                    <p class="text-muted"> :بيانات العميل</p>
                </div>
                <div class="col-sm-6 col-12 text-center text-sm-left">
                    @if(!empty($order))
                    <p>{{$order->created_at}}<span class="text-muted"> :تاريخ الفاتورة</span></p>
                    <!-- <p><span class="text-muted">Terms :</span> Due on Receipt</p>
        <p><span class="text-muted">Due Date :</span> 10/05/2019</p> -->
                    @endif
                </div>
                <div class="col-sm-6 col-12 text-center text-sm-right">
                    <ul class="px-0 list-unstyled">
                        @if(!empty($order->client))
                        <li class="text-bold-800">{{$order->client->name}}<span class="text-muted"> :اسم العميل</span></li>
                        <li>{{$order->client->address}}<span class="text-muted"> :العنوان</span></li>
                        <li>{{$order->client->email}}<span class="text-muted"> :البريد الاليكترونى</span></li>
                        <li>{{$order->client->phone}}<span class="text-muted"> :رقم التليفون</span></li>
                        @endif
                    </ul>
                </div>

            </div>
            <!-- Invoice Customer Details -->

            <!-- Invoice Items Details -->
            <div id="invoice-items-details" class="pt-2">
                <div class="row">
                    <div class="table-responsive col-12" style="text-align: right;">
                        <table class="table" dir="rtl">
                            <thead style="text-align: right;">
                                <tr>
                                    <th>#</th>
                                    <th>المنتجات &amp; والوصف</th>
                                    <th  class="text-right">نوع المنتج</th>
                                    <th class="text-right">الكمية</th>
                                    <th class="text-right">سعر الوحدة</th>
                                    <th class="text-right">ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach($items as $item)
                                
                                <tr>
                                    <th scope="row">{{$count}}</th>
                                   <td>
                                        <p>{{$item->item->name}}</p>
                                        <p class="text-muted">{{$item->item->description}}
                                        </p>
                                       
                                    </td>
                                    <td class="text-right">{{$item->item->type}}</td>
                                    <td class="text-right">{{$item->quantity}}</td>
                                    <td class="text-right">{{$item->price}}</td>
                                    <td class="text-right">{{$item->note}}</td>
                                </tr>
                                @php $count ++; @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-sm-7 col-12 text-center text-sm-left">
          <p class="lead">Payment Methods:</p>
          <div class="row">
            <div class="col-sm-8">
              <div class="table-responsive">
                <table class="table table-borderless table-sm">
                  <tbody>
                    <tr>
                      <td>Bank name:</td>
                      <td class="text-right">ABC Bank, USA</td>
                    </tr>
                    <tr>
                      <td>Acc name:</td>
                      <td class="text-right">Amanda Orton</td>
                    </tr>
                    <tr>
                      <td>IBAN:</td>
                      <td class="text-right">FGS165461646546AA</td>
                    </tr>
                    <tr>
                      <td>SWIFT code:</td>
                      <td class="text-right">BTNPP34</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div> -->
                    <div class="col-sm-5 col-12">
                        <p class="lead" style="text-align: right;">إجمالى الفاتورة</p>
                        <div class="table-responsive">
                            <table class="table" style="text-align: right;">
                                <tbody>
                                    <tr>
                                        <td class="text-left">{{$order->cost}}</td>

                                        <td>التكلفة</td>

                                    </tr>
                                    <tr>
                                        <td class="text-left">{{$order->delivery_cost}}</td>
                                        <td>تكلفة التوصيل</td>

                                    </tr>
                                    <tr>
                                        <td class="text-bold-800 text-left">{{$order->shopping_cost}}</td>

                                        <td class="text-bold-800">تكلفه المشتريات</td>
                                    </tr>
                                    <tr>
                                        <td class="pink text-left">{{$order->total}}</td>

                                        <td>الاجمالى</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="text-center">
            <p class="mb-0 mt-1">Authorized person</p>
            <img src="../../../app-assets/images/pages/signature-scan.png" alt="signature" class="height-100">
            <h6>Amanda Orton</h6>
            <p class="text-muted">Managing Director</p>
          </div> -->
                    </div>
                </div>
            </div>

            <!-- Invoice Footer -->
            <div id="invoice-footer">
                <div class="row">
                    <!-- <div class="col-sm-7 col-12 text-center text-sm-left">
          <h6>Terms &amp; Condition</h6>
          <p>Test pilot isn't always the healthiest business.</p>
        </div> -->
                    <div class="col-sm-5 col-12 text-center">
                      {{--  <button type="button" class="btn btn-info btn-print btn-lg my-1 btnPrint"><i class="la la-paper-plane-o mr-50 "></i>
                            Print
                            Invoice</button>--}}

                            <p><a class="btnPrint" href='#'>طباعه</a></p>
                    </div>
                </div>
            </div>
            <!-- Invoice Footer -->

        </div>
    </section>

</div>
<!-- <div class="app-inner-layout__wrapper">
    <div class="app-inner-layout__content card">
        <div class="table-responsive">
            <div class="app-inner-layout__top-pane">
                <div >
                    <div class="mobile-app-menu-btn">
                        <button type="button" class="hamburger hamburger--elastic">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                    <div class="avatar-icon-wrapper mr-2">
                        <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                        <div class="avatar-icon avatar-icon-xl rounded"><img width="82" src="assets/images/avatars/1.jpg" alt=""></div>
                    </div>
                    <h4 class="mb-0 text-nowrap">Chad Evans
                        <div class="opacity-7">Last Seen Online: <span class="opacity-8">10 minutes ago</span>
                        </div>
                    </h4>
                </div>
                <div class="pane-right">
                    <div class="btn-group dropdown">
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="ml-2 dropdown-toggle btn btn-primary">
                            <span class="opacity-7 mr-1">
                                <i class="fa fa-cog"></i>
                            </span>
                            Actions
                        </button>
                        <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                            <ul class="nav flex-column">
                                <li class="nav-item-header nav-item">Activity</li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link">Chat
                                        <div class="ml-auto badge badge-pill badge-info">8</div>
                                    </a></li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link">Recover Password</a>
                                </li>
                                <li class="nav-item-header nav-item">My Account</li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link">Settings
                                        <div class="ml-auto badge badge-success">New</div>
                                    </a></li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link">Messages
                                        <div class="ml-auto badge badge-warning">512</div>
                                    </a></li>
                                <li class="nav-item"><a href="javascript:void(0);" class="nav-link">Logs</a></li>
                                <li class="nav-item-divider nav-item"></li>
                                <li class="nav-item-btn nav-item">
                                    <button class="btn-wide btn-shadow btn btn-danger btn-sm">
                                        Cancel
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-wrapper">
         
                <div class="float-right">
                    <div class="chat-box-wrapper chat-box-wrapper-right">
                        <div>
                            <div class="chat-box">Denouncing pleasure and praising pain was born
                                and I will give you a complete account.
                            </div>
                            <small class="opacity-6">
                                <i class="fa fa-calendar-alt mr-1"></i>
                                11:01 AM | Yesterday
                            </small>
                        </div>
                        <div>
                            <div class="avatar-icon-wrapper ml-1">
                                <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                                <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/3.jpg" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-box-wrapper">
                    <div>
                        <div class="avatar-icon-wrapper mr-1">
                            <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/2.jpg" alt=""></div>
                        </div>
                    </div>
                    <div>
                        <div class="chat-box">Born and I will give you a complete account of the
                            system.
                        </div>
                        <small class="opacity-6">
                            <i class="fa fa-calendar-alt mr-1"></i>
                            11:01 AM | Yesterday
                        </small>
                    </div>
                </div>
                <div class="float-right">
                    <div class="chat-box-wrapper chat-box-wrapper-right">
                        <div>
                            <div class="chat-box">The master-builder of human happiness.</div>
                            <small class="opacity-6">
                                <i class="fa fa-calendar-alt mr-1"></i>
                                11:01 AM | Yesterday
                            </small>
                        </div>
                        <div>
                            <div class="avatar-icon-wrapper ml-1">
                                <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                                <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/3.jpg" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-box-wrapper">
                    <div>
                        <div class="avatar-icon-wrapper mr-1">
                            <div class="badge badge-bottom btn-shine badge-success badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon avatar-icon-lg rounded"><img src="assets/images/avatars/2.jpg" alt=""></div>
                        </div>
                    </div>
                    <div>
                        <div class="chat-box">Mistaken idea of denouncing pleasure and praising
                            pain was born and I will give you
                        </div>
                        <small class="opacity-6">
                            <i class="fa fa-calendar-alt mr-1"></i>
                            11:01 AM | Yesterday
                        </small>
                    </div>
                </div>
            </div>
            <div class="app-inner-layout__bottom-pane d-block text-center">
                <div class="mb-0 position-relative row form-group">
                    <div class="col-sm-12">
                        <input placeholder="Write here and hit enter to send..." type="text" class="form-control-lg form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-inner-layout__sidebar card">
        <div class="app-inner-layout__sidebar-header">
            <ul class="nav flex-column">
                <li class="pt-4 pl-3 pr-3 pb-3 nav-item">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                        <input placeholder="Search..." type="text" class="form-control">
                    </div>
                </li>
                <li class="nav-item-header nav-item">Friends Online</li>
            </ul>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <button type="button" tabindex="0" class="dropdown-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="avatar-icon-wrapper">
                                    <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                    <div class="avatar-icon"><img src="assets/images/avatars/2.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">Alina Mcloughlin</div>
                                <div class="widget-subheading">Aenean vulputate eleifend
                                    tellus.
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" tabindex="0" class="dropdown-item active">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="avatar-icon-wrapper">
                                    <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                    <div class="avatar-icon"><img src="assets/images/avatars/3.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">Chad Evans</div>
                                <div class="widget-subheading">Vivamus elementum semper nisi.
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" tabindex="0" class="dropdown-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="avatar-icon-wrapper">
                                    <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                    <div class="avatar-icon"><img src="assets/images/avatars/3.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">Ella-Rose Henry</div>
                                <div class="widget-subheading">Etiam sit amet orci eget eros
                                    faucibus
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" tabindex="0" class="dropdown-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="avatar-icon-wrapper">
                                    <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                    <div class="avatar-icon"><img src="assets/images/avatars/2.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">Ruben Tillman</div>
                                <div class="widget-subheading">Lorem ipsum dolor sit amet,
                                    consectetuer
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" tabindex="0" class="dropdown-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="avatar-icon-wrapper">
                                    <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                    <div class="avatar-icon"><img src="assets/images/avatars/3.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">Ella-Rose Henry</div>
                                <div class="widget-subheading">Etiam sit amet orci eget eros
                                    faucibus
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </li>
            <li class="nav-item">
                <button type="button" tabindex="0" class="dropdown-item">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left mr-3">
                                <div class="avatar-icon-wrapper">
                                    <div class="badge badge-bottom badge-success badge-dot badge-dot-lg"></div>
                                    <div class="avatar-icon"><img src="assets/images/avatars/2.jpg" alt=""></div>
                                </div>
                            </div>
                            <div class="widget-content-left">
                                <div class="widget-heading">Ruben Tillman</div>
                                <div class="widget-subheading">Lorem ipsum dolor sit amet,
                                    consectetuer
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </li>
        </ul>
        <div class="app-inner-layout__sidebar-footer pb-3">
            <ul class="nav flex-column">
                <li class="nav-item-divider nav-item"></li>
                <li class="nav-item-header nav-item">Offline Friends</li>
                <li class="text-center p-2 nav-item">
                    <div class="avatar-wrapper avatar-wrapper-overlap">
                        <div class="avatar-icon-wrapper">
                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon rounded"><img src="assets/images/avatars/5.jpg" alt=""></div>
                        </div>
                        <div class="avatar-icon-wrapper">
                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon rounded"><img src="assets/images/avatars/10.jpg" alt=""></div>
                        </div>
                        <div class="avatar-icon-wrapper">
                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon rounded"><img src="assets/images/avatars/7.jpg" alt=""></div>
                        </div>
                        <div class="avatar-icon-wrapper">
                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon rounded"><img src="assets/images/avatars/8.jpg" alt=""></div>
                        </div>
                        <div class="avatar-icon-wrapper">
                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon rounded"><img src="assets/images/avatars/1.jpg" alt=""></div>
                        </div>
                        <div class="avatar-icon-wrapper">
                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon rounded"><img src="assets/images/avatars/2.jpg" alt=""></div>
                        </div>
                        <div class="avatar-icon-wrapper">
                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon rounded"><img src="assets/images/avatars/3.jpg" alt=""></div>
                        </div>
                        <div class="avatar-icon-wrapper">
                            <div class="badge badge-bottom badge-danger badge-dot badge-dot-lg"></div>
                            <div class="avatar-icon rounded"><img src="assets/images/avatars/4.jpg" alt=""></div>
                        </div>
                        <div class="avatar-icon-wrapper avatar-icon-add">
                            <div class="avatar-icon rounded"><i>+</i></div>
                        </div>
                    </div>
                </li>
                <li class="nav-item-btn text-center nav-item">
                    <button class="btn-wide btn-pill btn btn-success btn-sm">Offline Group
                        Conversation
                    </button>
                </li>
            </ul>
        </div>
    </div>
</div> -->
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $(".btnPrint").printPage();
  });
  </script>
@endsection