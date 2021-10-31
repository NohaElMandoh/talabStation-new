@include('admin.layouts.partials.validation-errors')
@include('flash::message')
<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :تعديل منتج </h5>
                <form enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" id="item_id" name="item_id" value="{{$item->id}}">
                    <div class="form-row">
                        <div class="error hidden">
                            <ul></ul>
                        </div>

                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class="">اسم المنتج</label>
                                <input name="name" id="name" value='{{$item->name}}' placeholder="رجاء اكتب اسم المنتج" type="text" class="form-control"></div>

                        </div>


                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="unit_id" class=""> :الوحدة </label>
                                <select class="form-control" id='unit_id' name='unit_id' >

                                    <option disabled selected> الوحدة </option>

                                    @if(!empty($units))
                                    @foreach($units as $unit)

                                    <option value="{{$unit->id}}" @if($item->unit_id == $unit->id) selected @endif>{{$unit->name_ar}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="price" class="">السعر</label>

                                <input type="number" class="form-control validate[required]" id="price" min="1" value='{{$item->price}}' name="price">

                            </div>


                        </div>


                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="discount"   class="">الخصم</label>

                                <input type="number" class="form-control validate[required]" value='{{$item->discount}}' id="discount" min="1" name="discount">

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="category_id" class=""> : تصنيف المنتج </label>
                                <select class="form-control" id='category_id' name='category_id'>

                                    <option disabled selected> تصنيف المنتج </option>

                                    @if(!empty($categories))
                                    @foreach($categories as $category)

                                    <option value="{{$category->id}}" @if($item->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="description" class=""> : وصف العرض</label><input name="description" id="description" value='{{$item->description}}' placeholder="ادخل وصف" type="text" class="form-control">
                            </div>
                        </div>

                    </div>


                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class="">صوره المنتج</label>
                                <input name="photo" id="photo" type="file" class="form-control-file" onchange="changePreview(event, 'add','item_images');">

                            </div>
                        </div>
                        <div id="item_images"></div>
                        @if(!empty($item->photo))
                        <div class="img-prev">
                            <img class="img-thumbnails" src="{{url($item->photo)}}"></div>
                        @endif
                    </div>


                    <div class="form-row">


                        <button class="mt-1 btn btn-primary editItem">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>