@extends('admin.layouts.main',[
                                'page_header'       => 'الوحدة',
                                'page_description'  => 'تعديل وحدة'
                                ])
@section('content')
        <!-- general form elements -->
<div class="box box-primary">
    <!-- form start -->
    {!! Form::model($model,[
                            'action'=>['UnitController@update',$model->id],
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'PUT'
                            ])!!}

    <div class="box-body">

        @include('admin.units.form')

        <div class="box-footer">
            <button type="submit" class="btn btn-primary">حفظ</button>
        </div>

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection