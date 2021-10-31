@include('admin.layouts.partials.validation-errors')
@include('flash::message')

<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :معلومات المتجر </h5>
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

                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="type_id" class=""><span style="color:red">*</span>حدد نوع المحل</label>
                                <select class="form-control type" id='type_id' name='type_id'>

                                    <option disabled selected>حدد نوع المحل</option>

                                    @if(!empty($types))
                                    @foreach($types as $type)

                                    <option value="{{$type->id}}">{{$type->name_ar}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>اسم المتجر</label>
                                <input name="name" id="name" placeholder="رجاء اكتب اسم المتجر" type="text" class="form-control"></div>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="email" class=""> <span style="color:red">*</span>: البريد الاليكترونى</label><input name="email" id="email" placeholder="example@example.com" type="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="phone" class=""><span style="color:red">*</span>: الهاتف </label><input name="phone" id="phone" placeholder="01012345613" type="text" class="form-control"></div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="password_confirmation" class=""><span style="color:red">*</span>تأكيد كلمة السر</label><input name="password_confirmation" id="password_confirmation" type="password" class="form-control"></div>


                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="password" class=""><span style="color:red">*</span>كلمة السر</label><input name="password" id="password" type="password" class="form-control"></div>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="col-md-6">

                            <div class="position-relative form-group"><label for="availability" class=""><span style="color:red">*</span>حالة المتجر</label>
                                <select class="form-control" id='availability' name='availability'>

                                    <option disabled selected>حدد حاله المتجر</option>
                                    <option value="open">مفتوح</option>
                                    <option value="closed">مغلق</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="address" class="">العنوان</label><input name="address" id="address" placeholder="محافظة-مركز-شارع" type="text" class="form-control"></div>
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

                                    <option disabled selected>حدد المحافظه</option>

                                    @if(!empty($cities))
                                    @foreach($cities as $city)

                                    <option value="{{$city->id}}">@if(count($city->regions) >0){{$city->name_ar}}@endif </option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="categories" class="">اختر تصنيف</label>
                                <select multiple class="form-control categories" id="category_id" name='categories[]'>

                                   {{-- <option disabled>اختر تصنيف</option>
                                    @if(!empty($categories))
                                    @foreach($categories as $category)
                                    <option data-name="{{$category->name}}" value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    @endif--}}
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


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
<div class="form-row">  
<div class="col-md-12">
                    <div class="position-relative form-group"><label for="photo" class=""><span style="color:red">*</span>صوره كوفر المتجر</label>
                        <input name="photo" id="photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','merchant_images');">

                    </div>
                    <div id="merchant_images">

                    </div>
                    </div>
</div>
                    <div class="form-row">  
                    <div class="col-md-12">
                    <div class="position-relative form-group"><label for="personal_photo" class=""><span style="color:red">*</span>لوجو المتجر</label>
                        <input name="personal_photo" id="personal_photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','merchant_logo');">

                    </div>
                    <div id="merchant_logo">

                    </div>
                    </div>
                    </div>
                    <button class="mt-1 btn btn-primary addMerchant">حفظ</button>
                </form>
            </div>
        </div>
    </div>

</div>