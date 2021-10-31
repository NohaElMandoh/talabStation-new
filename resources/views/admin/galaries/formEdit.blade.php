@include('admin.layouts.partials.validation-errors')
@include('flash::message')

<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :تعديل صورة </h5>
                <form  enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="form-row ">
                    <div class="col-md-12">
                        <div class="error hidden" style="text-align: right;">

                            <ul></ul>
                        </div>
                    </div>
                    </div>
                    <div class="form-row">
                    <input type="hidden" id="image_id" name="image_id" value="{{$image->id}}">

                     
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم الصورة</label>
                                <input name="name" id="name" value='{{$image->name}}'placeholder="رجاء اكتب اسم الصورة" type="text" class="form-control"></div>

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="price" class="">مكان العرض</label>

                                <input type="text" class="form-control validate[required]" value='{{$image->position}}' id="position"  name="position">

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="display" class=""> : حالة الصورة </label>
                                <select class="form-control" id='display' name='display'>

                                    <option disabled selected> حالة الصورة </option>

                                    <option value="1" @if($image->display ==1) selected @endif>عرض</option>
                                    <option value="0" @if($image->display ==0) selected @endif>عدم عرض</option>
                                 
                                </select>
                            </div>
                        </div>

                    </div>
                 
                    

                    <div class="form-row">


                        <!-- <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class="">الصوره </label>
                                <input name="photo" id="photo" type="file" class="form-control-file"   onchange="changePreview(event, 'add','galary_images');">

                            </div>
                        </div> -->
                        <div id="galary_images"></div>
                        @if(!empty($image->photo))
                        <div class="img-prev">
                            <img class="img-thumbnails" src="{{url("public/".$image->photo)}}"></div>
                        @endif
                    </div>
                  
                  
                                   <div class="form-row">


                        <button class="mt-1 btn btn-primary editImage">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>