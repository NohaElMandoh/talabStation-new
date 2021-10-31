<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            {!! Form::open([
            'method' => 'GET'
            ]) !!}
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('order_id',\Request::input('order_id'),[
                    'class' => 'form-control',
                    'placeholder' => 'رقم الطلب'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::select('merchant_id',$merchant->get()->pluck('merchant_details','id')->toArray(),request()->input('merchant_id'),[
                    'class' => 'form-control',
                    'placeholder' => 'كل المطاعم'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::select('state',
                    [
                    'pending' => 'قيد التنفيذ',
                    'accepted' => 'تم تأكيد الطلب',
                    'rejected' => 'مرفوض',
                    ],\Request::input('state'),[
                    'class' => 'form-control',
                    'placeholder' => 'كل حالات الطلبات'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('from',\Request::input('from'),[
                    'class' => 'form-control datepicker',
                    'placeholder' => 'من'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    {!! Form::text('to',\Request::input('to'),[
                    'class' => 'form-control datepicker',
                    'placeholder' => 'إلى'
                    ]) !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="">&nbsp;</label>
                    <button class="btn btn-flat btn-block btn-primary">بحث</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <th>#</th>
                    <th>رقم الطلب</th>
                    <th>المطعم</th>
                    <th>الإجمالى</th>
                    <th>ملاحظات</th>
                    <th>الحالة</th>
                    <th>وقت الطلب</th>
                    <th class="text-center">عرض</th>
                    <th class="text-center">اضافه مندوب</th>

                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach($order as $ord)
                    <tr id="removable{{$ord->id}}">
                        <td>{{$count}}</td>
                        <td><a href="{{url('admin/order/'.$ord->id)}}">#{{$ord->id}}</a></td>
                        <td>@if(!empty($ord->merchant)){{$ord->merchant->name}}@endif</td>
                        <td>{{$ord->total}}</td>
                        <td>{{$ord->note}}</td>
                        <td>{{$ord->state_text}}</td>
                        <td>{{$ord->created_at}}</td>
                        <td>
                            <a href="{{url('admin/order/'.$ord->id)}}" class="btn btn-success btn-block">عرض الطلب</a>
                        </td>
                        <td class="text-center">

                            <a class="btn btn-primary float-right" data-id="{{$ord->id}}" data-placement="left" title="Assign Order" data-target="#addOrder" data-toggle="modal" id="add">
                                <i class="fa fa-plus"></i>
                            </a>
                        </td>
                    </tr>
                    @php $count ++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {{-- {!! $order->appends([
                    'order_id' => \Request::input('order_id'),
                    'restaurant_id' => \Request::input('restaurant_id'),
                    'state' => \Request::input('state'),
                    'from' => \Request::input('from'),
                    'to' => \Request::input('to'),
                ])->links() !!}--}}
        </div>
    </div>
</div>
<!--Add Order-->
<div class="modal fade" id="addOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Assign Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="add_form">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-body">
                    <div class="error hidden">
                        <ul></ul>
                    </div>
                    <div class="form-group">

                        <label for="type">Runners</label>
                        <select class="form-control validate[required]" id="runner_id" name="runner_id">
                            <option disabled selected>Select Type</option>

                            @if(!empty($runners))
                            @foreach($runners as $runner)
                            <option value="{{$runner->id}}">{{$runner->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add_category" data-route="{{url('admin/addRunner')}}">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Add Runner-->