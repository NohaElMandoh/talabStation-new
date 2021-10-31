@include('admin.layouts.partials.validation-errors')
@include('flash::message')


<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">

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
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم المحافظة بالانجليزية</label>
                                <input name="name_en" id="name_en" placeholder="type city name" type="text" class="form-control"></div>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم المحافظة بالعربى</label>
                                <input name="name_ar" id="name_ar" placeholder="ادخل اسم المحافظة" type="text" style="text-align: right;" class="form-control"></div>

                        </div>
                    </div>
                    <div class="form-row">
                        <button class="mt-1 btn btn-primary addCity">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>