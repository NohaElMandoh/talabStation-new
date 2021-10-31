@extends('management.layouts.master',[
                                'page_header'       => 'الطلبات',
                                'page_description'  => 'تعين مندوب للطلب '
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
    

   {{-- {!! Form::model($model,[
                            'action'=>'OrderController@addRunner',
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'POST',
                            'files'=>'true'
                            ])!!}--}}
    <div class="box-body">
        @include('admin.orders.formEdit')
        <!-- <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div> -->
    </div>
   
  {{--  {!! Form::close()!!}--}}
</div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/order.js')}}"></script>

@endsection