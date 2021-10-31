@include('admin.layouts.partials.validation-errors')
@include('flash::message')




<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> تعديل معلومات المتجر </h5>
                <form enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" id="merchant_id" name="merchant_id" value="{{$merchant->id}}">
                    <div class="form-row">

                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="type_id" class=""><span style="color:red">*</span>حدد نوع المحل</label>
                                <select class="form-control" id='type_id' name='type_id'>

                                    <option disabled selected>حدد نوع المحل</option>

                                    @if(!empty($types))
                                    @foreach($types as $type)

                                    <option value="{{$type->id}}" @if($merchant->type_id==$type->id) selected @endif>{{$type->name_ar}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>اسم المتجر</label>
                                <input name="name" id="name" placeholder="رجاء اكتب اسم المتجر" value='{{$merchant->name}}' type="text" class="form-control"></div>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="email" class=""> : البريد الاليكترونى</label>
                                <input name="email" id="email" placeholder="example@example.com" disabled value='{{$merchant->email}}' type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="phone" class=""><span style="color:red">*</span>: الهاتف </label>
                                <input name="phone" id="phone" placeholder="01012345613" value='{{$merchant->phone}}' type="text" class="form-control"></div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col-md-6">

                            <div class="position-relative form-group"><label for="availability" class=""><span style="color:red">*</span>حالة المتجر</label>
                                <select class="form-control" id='availability' name='availability'>

                                    <option disabled selected>حدد حاله المتجر</option>
                                    <option value="open" @if($merchant->availability=='open') selected @endif>مفتوح</option>
                                    <option value="closed" @if($merchant->availability=='closed') selected @endif>مغلق</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="address" class="">Address</label>
                                <input name="address" id="address" placeholder="1234 Main St" value='{{$merchant->address}}' type="text" class="form-control"></div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="categories" class="">اختر تصنيف</label>
                                <select multiple class="form-control categories" id='categories' name='categories[]'>

                                    <option disabled>اختر تصنيف</option>
                                    @if(!empty($categories))
                                    @foreach($categories as $category)
                                    <option data-name="{{$category->name}}" value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">

                            <div class="card-body category_table" dir='rtl'>
                                <table class="mb-0 table table-hover" id="categoriestable" style="text-align: right;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>التصنيف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $count = 1; @endphp
                                        @if(!empty($merchant->categories ))
                                        @foreach($merchant->categories as $i)

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

                    <div class="form-row">
                       
                        <div class="col-md-6">

                            
                        <div class="position-relative form-group"><label for="exampleSelect" class=""><span style="color:red">*</span>اختر المنطقة</label>
                                <select class="form-control region" id='region_id' name='region_id'>

                                
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleSelect" class=""><span style="color:red">*</span>اختر المحافظة</label>
                                <select class="form-control city" id='city_id' name='city_id'>

                                    <!-- <option disabled selected>Select Runner</option> -->

                                    @if(!empty($cities))
                                    @foreach($cities as $city)

                                    <option value="{{$city->id}}">{{$city->name_ar}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        
                        </div>
                    </div>
                
                    <div class="position-relative form-group"><label for="photo" class="">صوره المتجر</label>
                        <input name="photo" id="photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','merchant_images');">
                    

                    </div>
                    <div id="merchant_images">
                        @if(!empty($merchant->photo))
                        <div class="img-prev">
                            <img class="img-thumbnails" src="{{url($merchant->photo)}}"></div>
                        @endif
                    </div>

                    <!-- ---------- -->
                    <div class="position-relative form-group"><label for="personal_photo" class="">لوجو المتجر</label>
                        <input name="personal_photo" id="personal_photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','merchant_logo');">
                    

                    </div>
                    <div id="merchant_logo">
                        @if(!empty($merchant->personal_photo))
                        <div class="img-prev">
                            <img class="img-thumbnails" src="{{url($merchant->personal_photo)}}"></div>
                        @endif
                    </div>
                    <button class="mt-1 btn btn-primary editMerchant">تعديل</button>
                </form>
            </div>
        </div>
    </div>

</div>


<div class="main-card mb-3 card">
            <div class="card-body" style="text-align: right;">
                <h5 class="card-title">تغير كلمه السر</h5>
                <form class="">
                    
                {{ csrf_field() }}
                <input type="hidden" id="merchant_id" name="merchant_id" value="{{$merchant->id}}">
               
                    <div class="form-row">

                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password-confirmation">تأكيد كلمة السر</label>
                                <input name="password_confirmation" id="password_confirmation" class="form-control" type="password"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group">
                                <label for="password">كلمة السر</label>
                                <input name="password" id="password" class="form-control" type="password"></div>
                        </div>
                    </div>
                
                    <button class="btn btn-primary changePassword ">تعديل</button>

                </form>


            </div>



        </div>