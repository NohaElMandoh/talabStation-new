

<style>
    span.select2-container {
        z-index: 10050;
        width: 100% !important;
        padding: 0;
    }

    .select2-container .select2-search--inline {
        float: left;
        width: 100%;
    }

    .resturant-filter span.select2-container {
        z-index: 999;
        width: 100% !important;
        padding: 0;
    }

    /*.modal-open .modal {*/
        /*overflow-x: hidden;*/
        /*overflow-y: auto;*/
        /*z-index: 99999;*/
    /*}*/
</style>
@extends('admin.layouts.main',[
								'page_header'		=> 'المطاعم',
								'page_description'	=> 'عرض المطاعم'
								])
@section('content')

    <div class="box box-primary">
     
        <div class="box-body">
            @include('flash::message')
         
            @if(!empty($merchants) )
            
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم المطعم</th>
                        <th>المدينة</th>
                        <th class="text-center">العمولات المستحقة</th>
                        <th class="text-center">حالة المطعم</th>
                        <th class="text-center">تفعيل / إيقاف</th>
                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>
                      
                        @foreach($merchants as $merchant)
                            <tr id="removable{{$merchant->id}}">
                                <td></td>
                                <td><a style="cursor: pointer" data-toggle="modal" data-target="#myModal{{$merchant->id}}">{{$merchant->name}}</a></td>
                                <td>
                                    @if(!empty($merchant->region))
                                        {{$merchant->region->name_ar}}
                                        @if(count((array)$merchant->region->city))
                                            {{$merchant->region->city->name_ar}}
                                        @endif
                                    @endif
                                </td>
                                <td class="text-center">
                                  {{-- {{ $merchant->total_commissions - $merchant->total_payments }}--}} 
                                </td>
                                <td class="text-center">
                                    @if($merchant->availability == 'open')
                                        <i class="fa fa-circle-o text-green"></i> مفتوح
                                    @else
                                        <i class="fa fa-circle-o text-red"></i> مغلق
                                    @endif

                                </td>
                                <td class="text-center">
                                    @if($merchant->activated)
                                        <a href="merchant/{{$merchant->id}}/de-activate" class="btn btn-xs btn-danger"><i class="fa fa-close"></i> إيقاف</a>
                                    @else
                                        <a href="merchant/{{$merchant->id}}/activate" class="btn btn-xs btn-success"><i class="fa fa-check"></i> تفعيل</a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button id="{{$merchant->id}}" data-token="{{ csrf_token() }}"
                                            data-route="{{URL::route('merchant.destroy',$merchant->id)}}"
                                            type="button" class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal{{$merchant->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">{{$merchant->name}}</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <ul>
                                                        <li> العنوان :  {{$merchant->address}}</li>
                                                        <li> المدينة :
                                                            @if(count((array)$merchant->region))
                                                                {{$merchant->region->name_ar}}
                                                                @if(count((array)$merchant->region->city))
                                                                    {{$merchant->region->city->name_ar}}
                                                                @endif
                                                            @endif
                                                        </li>
                                                        <li> الحد الأدنى للطلبات : {{$merchant->minimum_charger}}</li>
                                                        <li> للتواصل : {{$merchant->phone}}</li>
                                                        <hr>
                                                       {{-- <li>إجمالي الطلبات : {{$merchant->total_orders_amount}}</li>
                                                        <li>إجمالي العمولات المستحقة : {{$merchant->total_commissions}}</li>
                                                        <li>إجمالي المبالغ المسددة : {{$merchant->total_payments}}</li>
                                                        <li>صافي العمولات المستحقة : {{$merchant->total_commissions - $merchant->total_payments}}</li>--}}
                                                    </ul>
                                                </div>
                                                <div class="col-lg-4">
                                                    <img height="150px" width="150px" src="{{url('/'.$merchant->photo.'/')}}"/>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                  {{--  {!! $merchants->appends([
                        'name' => request()->input('name'),
                        'city_id' => request()->input('city_id'),
                        'availability' => request()->input('availability'),
                    ])->render() !!}--}}
                </div>
            @else
                <div class="col-md-4 col-md-offset-4">
                    <div class="alert alert-info bg-blue text-center">لا يوجد سجلات</div>
                </div>
            @endif

        </div>
    </div>


@stop