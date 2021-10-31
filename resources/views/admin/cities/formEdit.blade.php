@include('admin.layouts.partials.validation-errors')
@include('flash::message')


<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :تعديل محافظة </h5>
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
                      
                        <input type="hidden" id="city_id" name="city_id" value="{{$city->id}}">

                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم المحافظة بالانجليزية</label>
                                <input name="name_en" id="name_en" value='{{$city->name_en}}' placeholder="please,,,,insert city name" type="text" class="form-control"></div>

                        </div>


                     
                    </div>
<div class="form-row">
<div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم المحافظة بالعربى</label>
                                <input name="name_ar" id="name_ar"  value='{{$city->name_ar}}'  placeholder="رجاء اكتب اسم المحافظة" type="text" class="form-control"></div>

                        </div>

</div>


                    <div class="form-row">


                        <button class="mt-1 btn btn-primary editCity">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>