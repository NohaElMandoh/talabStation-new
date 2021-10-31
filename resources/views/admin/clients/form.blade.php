@include('admin.layouts.partials.validation-errors')
@include('flash::message')


<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :إضافة العميل </h5>
                <form enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="form-row ">
                    <div class="col-md-12">
                        <div class="error hidden" style="text-align: right;">

                            <ul></ul>
                        </div>
                    </div>
                    </div>
                    <div class="form-row">
                       
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleName" class="">اسم العميل</label>
                                <input name="name" id="name" type="text" class="form-control"></div>

                        </div>
                    </div>
                    <div class="form-row">
                        
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">التليفون</label>
                                <input name="home_phone" id="home_phone"   type="text" class="form-control"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">الموبايل</label>
                                <input name="phone" id="phone"  type="text" class="form-control"></div>

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">البريد الالكترونى</label>
                                <input type="email" name="email" id="email" type="text" class="form-control"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">العنوان</label>
                                <input name="address" id="address" type="text" class="form-control"></div>

                        </div>
                       

                    </div>
                    <div class="form-row">
                    
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="region_id" class="">المنطقة</label>
                                <select class="form-control" id='region_id' name='region_id'>

                                    <option disabled selected>اختر محافظه</option>

                                    @if(!empty($regions))
                                    @foreach($regions as $region)

                                    <option value="{{$region->id}}"  >{{$region->name_ar}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        
                    <div class="col-md-6">
                            <div class="position-relative form-group"><label for="type_id" class="">المحافظة</label>
                                <select class="form-control" id='city_id' name='city_id'>

                                    <option disabled selected>اختر محافظه</option>

                                    @if(!empty($cities))
                                    @foreach($cities as $city)

                                    <option value="{{$city->id}}" >{{$city->name_ar}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">lat</label>
                                <input  name="lat" id="lat" type="text" class="form-control"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">lang</label>
                                <input name="lang" id="lang" type="text" class="form-control"></div>

                        </div>
                       

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">password</label>
                                <input type='password' name="password" id="password" type="text" class="form-control"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">confirm password</label>
                                <input type='password' name="confirm-password" id="confirm-password" type="text" class="form-control"></div>

                        </div>
                       

                    </div>
                    
                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class="">الصورة الشخصية</label>
                                <input name="photo" id="photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','client_image');">

                            </div>
                        </div>
                        <div id="client_image">
                          
                        </div>

                    </div>

                    <div class="form-row">


                        <button class="mt-1 btn btn-primary addClient">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

