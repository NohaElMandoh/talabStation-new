@include('admin.layouts.partials.validation-errors')
@include('flash::message')


<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :إضافة نوع متجر جديد </h5>
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
                            <div class="position-relative form-group"><label for="exampleAddress" class="">En-اسم النوع</label>
                                <input name="name_en" id="name_en" placeholder=" Type Name " type="text" class="form-control"></div>

                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم النوع</label>
                                <input name="name_ar" id="name_ar" placeholder=" اسم النوع" type="text" class="form-control"></div>

                        </div>


                    </div>

                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class="">الصوره </label>
                                <input name="photo" id="photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','type_image');">

                            </div>
                        </div>
                        <div id="type_image"></div>

                    </div>


                    <div class="form-row">


                        <button class="mt-1 btn btn-primary addType">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>