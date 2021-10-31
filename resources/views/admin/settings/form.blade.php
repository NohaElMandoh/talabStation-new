@include('admin.layouts.partials.validation-errors')
@include('flash::message')

<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :اعدادات التطبيق </h5>
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
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>فيس بوك</label>
                                <input name="facebook" id="facebook" value='{{$settings->facebook}}' placeholder="facebook url"  type="url" class="form-control"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>تويتر</label>
                                <input name="twitter" id="twitter" value='{{$settings->twitter}}' placeholder="twitter url" type="url" class="form-control"></div>

                        </div>


                    </div>
                    <div class="form-row">
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>انستجرام</label>
                                <input name="instagram" id="instagram" value='{{$settings->instagram}}' placeholder="instagram url" type="url" class="form-control"></div>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>تكلفة التوصيل</label>
                                <input name="delivery_cost" id="delivery_cost" value='{{$settings->delivery_cost}}' type="number" class="form-control"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>تكلفة الشراء</label>
                                <input name="shopping_cost" id="shopping_cost" value='{{$settings->shopping_cost}}' type="number" class="form-control"></div>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>عن التطبيق</label>
                                <textarea rows="20" class="form-control" id="about_app" name="about_app" value=''  placeholder="about app ......">{{$settings->about_app}}</textarea>

                            </div>
                        </div>
                    </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="position-relative form-group"><label for="exampleAddress" class=""><span style="color:red">*</span>الشروط والأحكام</label>

                                    <textarea rows="20" class="form-control" id="terms" name='terms'  placeholder="terms......">{{$settings->terms}}</textarea>
                                    </div>
                               
                            </div>
                        </div>
                            <div class="form-row">


                                <button class="mt-1 btn btn-primary updateSettings">حفظ</button>
                            </div>
                </form>
            </div>
        </div>
    </div>

</div>