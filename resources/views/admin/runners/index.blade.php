@extends('admin.layouts.main',[
								'page_header'		=> 'المندوبين',
								'page_description'	=> 'موزعى الطلبات'
								])

@section('content')
    <div class="box box-primary">
        <div class="box-header">
        </div>
        <div class="box-body">
            @include('flash::message')
            @if(!empty($runners))
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <th>#</th>
                        <th>اسم العميل</th>
                        <th>الايميل</th>
                        <th>الهاتف</th>
                        <th>المدينة</th>
                        <th>العنوان</th>
                     

                        <th class="text-center">حذف</th>
                        </thead>
                        <tbody>
                        @php $count = 1; @endphp
                        @foreach($runners as $runner)
                            <tr id="removable{{$runner->id}}">
                                <td>{{$count}}</td>
                                <td>{{$runner->name}}</td>
                                <td>{{$runner->email}}</td>
                                <td>{{$runner->phone}}</td>
                                <td>
                                
                                    @if(!empty($runner->region))
                                        {{$runner->region->name_ar}}
                                        @if(!empty($runner->region->city))
                                            {{$runner->region->city->name}}
                                        @endif
                                    @endif
                                </td>
                                <td>{{$runner->address}}</td>
                          {{--     <td class="text-center">
                                    <button id="{{$runner->id}}" data-token="{{ csrf_token() }}"
                                            data-route="{{URL::route('runner.destroy',$runner->id)}}"
                                            type="button" class="destroy btn btn-danger btn-xs">
                                        <i class="fa fa-trash-o"></i></button>
                                </td>--}} 

                                <td class="text-center">
                                      {!! Form::open([
                                          'action' => ['RunnerController@destroy',$runner->id],
                                          'method' => 'delete'
                                      ]) !!}
                                      <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>
                                      {!! Form::close() !!}
                                  </td>

                            </tr>
                            @php $count ++; @endphp
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $runners->render() !!}
            @endif
        </div>
    </div>
    
@stop