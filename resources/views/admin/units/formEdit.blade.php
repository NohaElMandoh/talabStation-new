@include('admin.layouts.partials.validation-errors')
@include('flash::message')


<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :تعديل وحدة </h5>
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

                        <input type="hidden" id="unit_id" name="unit_id" value="{{$unit->id}}">

                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم الوحدة</label>
                                <input name="name_ar" id="name_ar" value='{{$unit->name_ar}}' placeholder="اسم الوحدة" type="text" class="form-control"></div>

                        </div>

                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">En-اسم الوحدة</label>
                                <input name="name_en" id="name_en" value='{{$unit->name_en}}' placeholder="Unit Name" type="text" class="form-control"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button class="mt-1 btn btn-primary editUnit">تعديل</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>