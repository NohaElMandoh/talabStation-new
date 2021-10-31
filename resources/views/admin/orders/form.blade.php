@include('admin.layouts.partials.validation-errors')
@include('flash::message')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">

                <div id="smartwizard" class="sw-main sw-theme-default">
                    <ul class="forms-wizard nav nav-tabs step-anchor">
                        <li class="nav-item active">
                            <a href="#step-1" class="nav-link">
                                <em>1</em><span>تعيين مندوب</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#step-2" class="nav-link">
                                <em>2</em><span>قبول المندوب</span>
                            </a>
                        </li>

                    </ul>
                    <!-- step-1 -->
                    <div class="form-wizard-content sw-container tab-content" style="min-height: 353px;">
                        <div id="step-1" class="tab-pane step-content" style="display: block;">
                            <div class="form-row">
                                <form id="add_form" action="{{ route('admin.addRunner') }}" method="POST">
                                   
                                    {{ csrf_field() }}
                                    <div class="form-row ">
                    <div class="col-md-12">
                        <div class="error hidden" style="text-align: right;">

                            <ul></ul>
                        </div>
                    </div>
                    </div>
                                    <input type="hidden" name="order_id" value="{{$order_id}}">
                                    <div class="col-md-6">
                                        <div class="position-relative form-group"><label for="exampleEmail55">Runner</label>
                                            <select class="mb-2 form-control" id="runner_id" name="runner_id">
                                                <option disabled selected>Select Runner</option>

                                                @if(!empty($runners))
                                                @foreach($runners as $runner)
                                                <option value="{{$runner->id}}">{{$runner->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>

                                        </div>
                                    </div>
                                    <button type="submit" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                        Assign
                                    </button>
                                </form>
                            </div>


                        </div>
                        <!-- step-2 -->
                        <div id="step-2" class="tab-pane step-content" style="display: none;">
                            <div id="accordion" class="accordion-wrapper mb-3">
                                <div class="card">
                                    <div id="headingOne" class="card-header">
                                        <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                            <span class="form-heading">Runner Information<p>Accept Or Refuse Order</p></span>
                                        </button>
                                    </div>
                                    <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                @if(!empty($runner))
                                                @if(Session::has('runner'))
                                                    <table dir="rtl" style="width: 100%;" id="example" class="table table-hover table-striped table-bordered dataTable dtr-inline" role="grid" aria-describedby="example_info">
                                                        <thead>
                                                            <tr role="row">
                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 187.2px;" aria-label="Order_Num: activate to sort column ascending">رقم الطلب</th>
                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 84.2px;" aria-label="Client: activate to sort column ascending">المندوب</th>

                                                                <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Details: activate to sort column ascending">الحاله</th>

                                                                <!--      <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1" style="width: 62.2px;" aria-label="Assign_Runner: activate to sort column ascending">اضافه مندوب</th> -->


                                                            </tr>
                                                        </thead>
                                                        <tbody>


                                                           
                                                            <tr id="removable{{$order_id}}">

                                                                <td>#{{$order_id}}</a></td>
                                                                <td>
                                                               
                                                                   
                                                                        
                                                                        {{ Session::get('runner')['name']}}
                                    
                                                                
                                                                </td>

                                                                <td>
                                                                 
                                                                    <form id="accept_form" action="{{ route('admin.acceptDeliverOrder') }}" method="POST">
                                                                         
                                                                        {{ csrf_field() }}
                                                                        <div class="form-row ">
                    <div class="col-md-12">
                        <div class="error hidden" style="text-align: right;">

                            <ul></ul>
                        </div>
                    </div>
                    </div>
                                                                        <input type="hidden" name="order_id" value="{{$order_id}}">
                                                                        @if(Session::has('runner'))
                                                                        
                                                                       
                                                                        <input type="hidden" name="runner_id" value=" {{ Session::get('runner')['id']}}">
@endif
                                                                        



                                                                        <button type="submit" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                                                                            Accept
                                                                        </button>
                                                                    </form>
                                                                    {{-- <a href="{{url('admin/order/'.$ord->id)}}" class="btn btn-success btn-block">عرض الطلب</a>
                                                                    @if($task->ticket_status_id==2) checked @endif class="form-check-input" data-id="{{$task->id}}" id="statusChecked
                                                                    --}}

                                                                </td>
                                                                {{-- <td>
                                                                    <a href="{{url('admin/assignRunner/'.$ord->id)}}" class="btn btn-success btn-block">تعين مندوب</a>
                                                                </td>
                                                                <td class="text-center">

                                                                    <a class="btn btn-primary float-right add_order_id" data-id="{{$ord->id}}" data-placement="left" title="Assign Order" data-target="#addOrder" data-toggle="modal" id="add_order_id">
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>--}}
                                                            </tr>


                                                        </tbody>
                                        
                                                    </table>
                                                    @endif
                                                    @endif


                                                </div>
                                            </div>


                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="step-3" class="tab-pane step-content" style="display: none;">
                    <div class="no-results">
                        <div class="swal2-icon swal2-success swal2-animate-success-icon">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                            <span class="swal2-success-line-tip"></span>
                            <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div>
                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                        </div>
                        <div class="results-subtitle mt-4">Finished!</div>
                        <div class="results-title">You arrived at the last form
                            wizard step!
                        </div>
                        <div class="mt-3 mb-3"></div>
                        <div class="text-center">
                            <button class="btn-shadow btn-wide btn btn-success btn-lg">
                                Finish
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="divider"></div>
        <div class="clearfix">
            <!-- <button type="button" id="reset-btn" class="btn-shadow float-left btn btn-link">Reset
            </button> -->
            <button type="button" id="next-btn" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">
                Next
            </button>
            <button type="button" id="prev-btn" class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-outline-secondary">
                Previous
            </button>
        </div>
    </div>
</div>
</div>
</div>