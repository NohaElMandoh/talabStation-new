@include('admin.layouts.partials.validation-errors')
<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :اضافة منتج </h5>
                <form enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <input type="hidden" id="merchant_id" name="merchant_id" value="{{ Auth::user()->id }}">
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="error hidden" style="text-align: right">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="exampleAddress" class=""><span
                                        style="color:red">*</span>اسم المنتج</label>
                                <input name="name" id="name" placeholder="رجاء اكتب اسم المنتج" type="text"
                                    class="form-control" required tabindex="1">
                            </div>

                        </div>


                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="unit_id" class=""> <span
                                        style="color:red">*</span>:الوحدة </label>
                                <select class="form-control" id='unit_id' name='unit_id' required tabindex="3">

                                    <option disabled selected> الوحدة </option>

                                    @if (!empty($units))
                                        @foreach ($units as $unit)

                                            <option value="{{ $unit->id }}">{{ $unit->name_ar }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="price" class=""><span
                                        style="color:red">*</span>السعر</label>

                                <input type="number" class="form-control validate[required]" id="price" min="1"
                                    name="price" required tabindex="2">

                            </div>


                        </div>


                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="discount" class="">الخصم</label>

                                <input type="number" class="form-control validate[required]" id="discount" min="1"
                                    name="discount" required tabindex="5">

                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="category_id" class=""><span
                                        style="color:red">*</span> : تصنيف المنتج </label>
                                <select class="form-control" id='category_id' name='category_id' required tabindex="4">

                                    <option disabled selected> تصنيف المنتج </option>

                                    @if (!empty($categories))
                                        @foreach ($categories as $category)

                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="description" class=""><span
                                        style="color:red">*</span> : وصف المنتج</label><input name="description"
                                    id="description" placeholder="ادخل وصف" type="text" class="form-control" required
                                    tabindex="6">
                            </div>
                        </div>

                    </div>


                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="photo" class=""><span
                                        style="color:red">*</span> صوره المنتج الرئيسية</label>
                                <input name="photo" id="photo" type="file" class="form-control-file"
                                    onchange="changePreview(event, 'add','item_main_image');" required tabindex="7">

                            </div>
                        </div>
                        <div id="item_main_image"></div>

                    </div>
                    <div class="form-row">


                        <div class="col-md-12">
                            <div class="position-relative form-group"><label for="images" class=""><span
                                        style="color:red">*</span> صور المنتج </label>
                                <input name="images[]" id="images" type="file" class="form-control-file"
                                    onchange="changePreview2(event, 'add','item_images');" multiple="multiple" required tabindex="8">

                            </div>
                        </div>
                        <div id="item_images"></div>

                    </div>


                    <div class="form-row">


                        <button class="mt-1 btn btn-primary addItem">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
