@extends('admin.layouts.main',[
								'page_header'		=> 'السلات',
								'page_description'	=> 'عرض السلات'
								])
@section('content')
    <div class="box box-primary">
      
        @if(!empty($carts))
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <th>#</th>
                <th>ID</th>
                <th>العميل</th>
                <th>المنتج</th>
                <th>التاريخ</th>


             {{--   <th class="text-center">تعديل</th>
                <th class="text-center">حذف</th>--}}
                </thead>
                <tbody>
                    @php $count = 1; @endphp
                    @foreach($carts as $cart)
                        <tr id="removable{{$cart->id}}">
                            <td>{{$count}}</td>
                            <td>{{$cart->id}}</td>
                            <td>{{$cart->client->name}}</td>

                            <td>{{$cart->item->name}}</td>
                            <td>{{$cart->created_at}}</td>


                          {{-- <td class="text-center"><a href="unit/{{$unit->id}}/edit" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a></td>
                       

                            <td class="text-center">
                                      {!! Form::open([
                                          'action' => ['UnitController@destroy',$unit->id],
                                          'method' => 'delete'
                                      ]) !!}
                                      <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                      {!! Form::close() !!}
                                  </td>--}} 
                        </tr>
                        @php $count ++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
            {!! $carts->render() !!}
        @endif


    </div>
@stop