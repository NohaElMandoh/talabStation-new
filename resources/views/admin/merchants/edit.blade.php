@extends('management.layouts.master',[
                                'page_header'       => 'المتاجر',
                                'page_description'  => 'تعديل المتجر '
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
  

    <div class="box-body">
        @include('admin.merchants.formEdit')
        <!-- <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div> -->

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection
@section('scripts')
<script src="{{asset('custom/js/merchant.js')}}"></script>

@endsection