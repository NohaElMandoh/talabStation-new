@extends('management.layouts.master',[
                                'page_header'       => 'أصناف الطعام',
                                'page_description'  => 'صنف جديد'
                                ])
@section('content')
   {{-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-cutlery"></i> {{$restaurant->name}}</a></li>
    </ol> --}}
    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
       
        <div class="box-body">
            @include('admin.items.form')
            <!-- <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div> -->
        </div>
    </div><!-- /.box -->
@endsection
@section('scripts')
<script src="{{asset('custom/js/item.js')}}"></script>

@endsection