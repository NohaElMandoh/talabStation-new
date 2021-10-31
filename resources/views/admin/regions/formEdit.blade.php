@include('admin.layouts.partials.validation-errors')
@include('flash::message')


<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :تعديل منطقة </h5>
                <form enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="form-row ">
                    <div class="col-md-12">
                        <div class="error hidden" style="text-align: right;">

                            <ul></ul>
                        </div>
                    </div>
                    </div>
                   <input type="hidden" id="region_id" name="region_id" value="{{$region->id}}">


                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">En-اسم المنطقة</label>
                                <input name="name_en" id="name_en" value='{{$region->name_ar}}' placeholder="ٌRegion Name" type="text" class="form-control"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم المنطقة</label>
                                <input name="name_ar" id="name_ar"  value='{{$region->name_en}}' placeholder="اسم المنطقة" type="text" class="form-control"></div>

                        </div>


                    </div>
                    <div class="form-row">
                  
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="city_id" class="">المحافظة</label>
                                <select class="form-control" id='city_id' name='city_id'>

                                    <option disabled selected>اختر محافظه</option>

                                    @if(!empty($cities))
                                    @foreach($cities as $city)

                                    <option value="{{$city->id}}" @if($region->city->id == $city->id) selected @endif>{{$city->name_ar}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                      </div>
                             <div class="form-row">
                        <button class="mt-1 btn btn-primary editRegion">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>