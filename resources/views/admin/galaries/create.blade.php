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
إضافة صورة
@endsection

@section('content')
<!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
  
    <div class="box-body">
        @include('admin.galaries.form')
        <!-- <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div> -->
    </div>
    {!! Form::close()!!}
</div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/galary.js')}}"></script>
@endsection