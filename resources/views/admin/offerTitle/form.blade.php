@include('admin.layouts.partials.validation-errors')
@include('flash::message')

<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :اضافة عرض </h5>
                <form  enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="form-row ">
                    <div class="col-md-12">
                        <div class="error hidden" style="text-align: right;">

                            <ul></ul>
                        </div>
                    </div>
                    </div>
                    <div class="form-row">  
                        
                    <div class="col-md-6">
                            <div class="position-relative form-group"><label for="type_id" class="">التاجر</label>
                                <select class="form-control" id='merchant_id' name='merchant_id'>

                                    <option disabled selected>اختر تاجر</option>

                                    @if(!empty($merchants))
                                    @foreach($merchants as $merchant)

                                    <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم العرض</label>
                                <input name="name" id="name" placeholder="رجاء اكتب اسم العرض" type="text" class="form-control"></div>

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="price" class="">السعر</label>

                                <input type="number" class="form-control validate[required]" id="price" min="1" name="price">

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="offer_title_id" class=""> : تصنيف العرض </label>
                                <select class="form-control" id='offer_title_id' name='offer_title_id'>

                                    <option disabled selected> تصنيف العرض </option>

                                    @if(!empty($offerTitles))
                                    @foreach($offerTitles as $offerTitle)

                                    <option value="{{$offerTitle->id}}">{{$offerTitle->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="description" class=""> : وصف العرض</label><input name="description" id="description" placeholder="ادخل وصف" type="text" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="col-md-6">
                            <label for="ending_at" class=""> :نهاية العرض</label>

                            <input type="date" name="ending_at" class="form-control validate[required]" id="ending_at" formate="yyyy-mm-dd" value="{{old('ending_at')}}">

                        </div>
                        <div class="col-md-6">
                            <label for="starting_at" class=""> :بداية العرض</label>
                            <input type="date" name="starting_at" class="form-control validate[required]" id="starting_at" formate="yyyy-mm-dd" value="{{old('starting_at')}}">

                        </div>

                    </div>

                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class="">صوره العرض</label>
                                <input name="photo" id="photo" type="file" class="form-control-file"   onchange="changePreview(event, 'add','project_images');">

                            </div>
                        </div>
                        <div id="project_images"></div>

                    </div>
                  
                        <div class="form-row">
                            <div class="col-md-12">

                                <div class="position-relative form-group"><label for="items" class=""> : اضف اصناف الى العرض  </label>
                              <select multiple class="form-control " id='items' name='items[]'>

                            
                                    </select>
                                </div>

                            </div>
                        </div>
                  
                    <div class="form-row">
                        <div class="col-md-12">

                            <div class="card-body item_table" dir='rtl' style="text-align: right;">
                                <table class="mb-0 table table-hover" id="itemstable" style="text-align: right;">
                                    <thead style="text-align: right;">
                                        <tr>
                                            <th>#</th>
                                            <th >الصنف</th>
                                            <!-- <th>الكمية</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">


                        <button class="mt-1 btn btn-primary addOffer">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>