@extends('management.layouts.master',[
                                'page_header'       => 'الطلبات',
                                'page_description'  => 'تعين مندوب للطلب '
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <div class="box-body">
        @include('admin.offers.formEdit')
        <!-- <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div> -->
    </div>
</div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/offer.js')}}"></script>

@endsection