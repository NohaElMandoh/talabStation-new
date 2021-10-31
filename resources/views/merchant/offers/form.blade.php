@include('admin.layouts.partials.validation-errors')
@include('flash::message')

<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> : اضافة عرض </h5>
                <form enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="error hidden" style="text-align: right;"> 
                                <ul></ul>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color: red;">*</span>اسم العرض</label>
                                <input name="name" id="name" placeholder="رجاء اكتب اسم العرض" type="text" class="form-control" tabindex="1"></div>

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="price" class=""><span style="color: red;">*</span>سعر البيع</label>

                                <input type="number" class="form-control validate[required]" id="price" min="1" name="price" tabindex="3">

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="offer_title_id" class=""><span style="color: red;" tabindex="2">*</span> : تصنيف العرض </label>
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
                            <div class="position-relative form-group"><label for="description" class=""><span style="color: red;">*</span> : وصف العرض</label><input name="description" id="description" placeholder="ادخل وصف" required type="text" class="form-control" tabindex="4">
                            </div>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="col-md-6">
                            <label for="ending_at" class=""> <span style="color: red;">*</span>:نهاية العرض</label>

                            <input type="date" name="ending_at" class="form-control validate[required]" id="ending_at" formate="yyyy-mm-dd" value="{{old('ending_at')}}" tabindex="6">

                        </div>
                        <div class="col-md-6">
                            <label for="starting_at" class=""> <span style="color: red;">*</span>:بداية العرض</label>
                            <input type="date" name="starting_at" class="form-control validate[required]" id="starting_at" formate="yyyy-mm-dd" value="{{old('starting_at')}}" tabindex="5">

                        </div>

                    </div>

                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class=""><span style="color: red;">*</span>صوره العرض</label>
                                <input name="photo" id="photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','project_images');" tabindex="7">

                            </div>
                        </div>
                        <div id="project_images"></div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-12">

                            <div class="position-relative form-group"><label for="items" class=""><span style="color: red;">*</span> : اضف اصناف الى العرض </label>
                                <select multiple class="form-control " id='items' name='items[]' required tabindex="8">

                                    @if(!empty(Auth::user()->items))
                                    @foreach(Auth::user()->items as $item)

                                    <option value="{{$item->id}}" data-price="{{$item->price}}" name="{{$item->name}}">{{$item->name}}</option>
                                    @endforeach
                                    @endif

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
                                            <th>الصنف</th>
                                            <th>السعر</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- --------------- -->
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-md-6">
                            <!-- <p class="lead">Amount Due 2/22/2014</p> -->

                            <div class="table-responsive">
                                <table dir="rtl" style="text-align: right;" class="table">
                                    <tbody>
                                        <tr>
                                            <th style="width:50%">سعر العرض:</th>
                                            <td id="total_price">0.00</td>
                                        </tr>
                                        <tr>
                                            <th>السعر قبل العرض:</th>
                                            <td id="befor_offer">0.00</td>
                                        </tr>
                                        <tr>
                                            <th>الخصم:</th>
                                            <td id="discount">0.00</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <label id='msg' style="color: red;"></label>
                    </div>
                    <!-- ------------ -->
                    <div class="form-row">


                        <button class="mt-1 btn btn-primary addOffer">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>