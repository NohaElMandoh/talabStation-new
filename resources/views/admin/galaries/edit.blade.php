@extends('management.layouts.master',[
                                'page_header'       => 'تصنيفات المطاعم',
                                'page_description'  => 'تعديل تصنيف'
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->

    <div class="box-body">

        @include('admin.galaries.formEdit')

    </div>

</div><!-- /.box -->

@endsection

@section('scripts')
<script src="{{asset('custom/js/galary.js')}}"></script>
@endsection