@extends('management.layouts.master',[
'page_header' => 'العروض',
'page_description' => 'عرض جديد '
])
@section('style')
<style>
    .form-control {
        text-align: right;
    }
    .table thead th {
text-align: right;
 }

th {
    text-align: right;
}
</style>
@endsection
@section('subTitle')
إضافة عرض
@endsection

@section('content')
<!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
  
    <div class="box-body">
        @include('admin.offers.form')
        <!-- <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div> -->
    </div>
    {!! Form::close()!!}
</div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/offer.js')}}"></script>

@endsection