@extends('management.layouts.master',[
                                'page_header'       => 'أصناف الطعام',
                                'page_description'  => 'تعديل صنف'
                                ])
@section('content')
   {{--<ol class="breadcrumb"  style="text-align: right;">
        <li ><a href="#"> {{$item->name}} تعديل</a></li>
    </ol>--}} 
    <!-- general form elements -->
    <div class="box box-primary">
        <!-- form start -->
    

        <div class="box-body">

            @include('admin.items.formEdit')

            <!-- <div class="box-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div> -->

        </div>
   

    </div><!-- /.box -->

@endsection
@section('scripts')
<script src="{{asset('custom/js/item.js')}}"></script>

@endsection