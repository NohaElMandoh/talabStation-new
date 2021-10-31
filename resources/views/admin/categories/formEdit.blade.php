@include('admin.layouts.partials.validation-errors')
@include('flash::message')


<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :اضافة تصنيف </h5>
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
                      
                        <input type="hidden" id="category_id" name="category_id" value="{{$category->id}}">

                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم التصنيف</label>
                                <input name="name" id="name" placeholder="رجاء اكتب اسم التصنيف" value='{{$category->name}}' type="text" class="form-control"></div>

                        </div>

                    </div>


                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class="">الصوره </label>
                                <input name="photo" id="photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','category_image');">

                            </div>
                        </div>
                        <div id="category_image"></div>
                        @if(!empty($category->photo))
                        <div class="img-prev">
                            <img class="img-thumbnails" src="{{url("public/".$category->photo)}}"></div>
                        @endif
                    </div>


                    <div class="form-row">


                        <button class="mt-1 btn btn-primary editCategory">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>