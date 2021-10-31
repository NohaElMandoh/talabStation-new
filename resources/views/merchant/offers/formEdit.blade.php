@include('admin.layouts.partials.validation-errors')
@include('flash::message')

<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :تعديل العرض </h5>
                <form enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" id="offer_id" name="offer_id" value="{{$offer->id}}">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="error hidden">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color: red;">*</span>اسم العرض</label>
                                <input name="name" id="name" value="{{$offer->name}}" placeholder="رجاء اكتب اسم العرض" type="text" class="form-control" tabindex="1"></div>

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="price" class=""><span style="color: red;">*</span>السعر</label>

                                <input type="number" value="{{$offer->price}}" class="form-control validate[required]" id="price" min="1" name="price" tabindex="3">

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="offer_title_id" class=""><span style="color: red;">*</span> : تصنيف العرض </label>
                                <select class="form-control" id='offer_title_id' name='offer_title_id' tabindex="2">

                                    <option disabled selected> تصنيف العرض </option>

                                    @if(!empty($offerTitles))
                                    @foreach($offerTitles as $offerTitle)

                                    <option value="{{$offerTitle->id}}" @if($offer->offer_title_id == $offerTitle->id) selected @endif>{{$offerTitle->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="description" class=""> <span style="color: red;">*</span>: وصف العرض</label><input name="description" value="{{$offer->description}}" id="description" placeholder="ادخل وصف" type="text" class="form-control" tabindex="4">
                            </div>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="col-md-6">
                            <label for="ending_at" class=""><span style="color: red;">*</span> :نهاية العرض</label>

                            <input type="date" name="ending_at" class="form-control validate[required]" id="ending_at" formate="yyyy-mm-dd" value="{{$offer->ending_at->format('Y-m-d')}}" tabindex="6">

                        </div>
                        <div class="col-md-6">
                            <label for="starting_at" class=""><span style="color: red;">*</span> :بداية العرض</label>
                            <input type="date" name="starting_at" class="form-control validate[required]" id="starting_at" formate="yyyy-mm-dd" value="{{$offer->starting_at->format('Y-m-d')}}" tabindex="5">

                        </div>

                    </div>

                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class="">صوره العرض</label>
                                <input name="photo" id="photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','offer_images');" tabindex="7">

                            </div>
                        </div>
                        <div id="offer_images">
                            @if(!empty($offer->photo_url))
                            <div class="img-prev">
                                <img class="img-thumbnails" src="{{url($offer->photo)}}"></div>
                            @endif
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-12">

                            <div class="position-relative form-group"><label for="items" class=""> <span style="color: red;">*</span>: اضف اصناف الى العرض </label>
                                <select multiple class="form-control " id='items' name='items[]' required tabindex="8">
                                    @if(!empty($merch_items))
                                    @foreach($merch_items as $item)
                                    @if(count($offerItems )>0)
                                    @foreach($offerItems as $i)

                                    <option data-name="{{$item->name}}" data-itemID="{{$item->id}}" data-price="{{$item->price}}" value="{{$item->id}}" @if($item->id ==$i->id) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                    @else
                                    <option data-name="{{$item->name}}" data-itemID="{{$item->id}}" data-price="{{$item->price}}" value="{{$item->id}}">{{$item->name}}</option>

                                    @endif
                                    @endforeach
                                    @endif

                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">

                            <div class="card-body item_table" dir='rtl'>
                                <table class="mb-0 table table-hover" id="itemstable" style="text-align: right;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="text-align: right;">الصنف</th>
                                            <!-- <th>الكمية</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @if(!empty($offerItems ))
                                        @foreach($offerItems as $i)

                                        <tr>
                                            <td>{{$count}}</td>
                                            <td>{{$i->name}}</td>

                                        </tr>
                                        @php $count ++; @endphp
                                        @endforeach
                                        @endif
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
                                    @php $befor_offer_price = 0.00; @endphp

                                    <tbody>
                                        <tr>
                                            <th style="width:50%">سعر البيع:</th>
                                            <td id="total_price">{{$offer->price}}</td>
                                        </tr>
                                        <tr>
                                            <th>السعر قبل العرض:</th>
                                            <td id="befor_offer">
                                                @if(count($offerItems )>0)
                                                @foreach($offerItems as $i)
                                                @php$befor= $befor_offer_price += $i->price; 
                                                
                                               
                                                @endphp

                                                @endforeach
                                                @php echo $befor_offer_price @endphp 
                                                @else 0.00
                                                @endif


                                            </td>
                                        </tr>
                                        <tr>
                                            <th>الخصم:</th>
                                            <td id="discount">
                                                @if($befor_offer_price-$offer->price >0)
                                                {{$befor_offer_price-$offer->price}}

                                                @else 0.00
                                                @endif

                                            </td>
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
                    <div class="form-row">


                        <button class="mt-1 btn btn-primary editOffer">تعديل</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>