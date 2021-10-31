@extends('management-merchant.layouts.master')
@section('style')
    <style>
        ul {
            list-style-type: none;
        }

    </style>
@endsection
@section('subTitle')
    تعديل بيانات المتجر
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body" style="text-align: right;">
                    <h5 class="card-title"> تعديل بيانات المتجر</h5>
                    {{-- <form method="POST" action="{{ route('merchant.updateProfile') }}" class=""> --}}
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
                            <input type="hidden" id="merchant_id" name="merchant_id" value="{{ Auth::user()->id }}">

                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="email" class="">البريد الاليكترونى
                                    </label>
                                    <input name="email" id="email" value="{{ Auth::user()->email }}" type="email" disabled
                                        class="form-control" tabindex="2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="name" class=""><span
                                            style="color:red">*</span>اسم المتجر</label><input name="password" id="name"
                                        value="{{ Auth::user()->name }}" type="text" class="form-control" tabindex="3">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                                                            <div class="position-relative form-group"><label for="examplePassword11" class="">Password</label><input name="password" id="examplePassword11" placeholder="password placeholder" type="password" class="form-control"></div>
                                                                        </div> -->
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="address" class="">

                                        <span style="color:red">*</span>العنوان</label>
                                    <input name="address" id="address" value="{{ Auth::user()->address }}" type="text"
                                        tabindex="3" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="address" class="">

                                        <span style="color:red">*</span>رقم التليفون</label>
                                    <input name="phone" id="phone" value="{{ Auth::user()->phone }}" type="text"
                                        tabindex="3" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="region_id" class=""><span
                                            style="color:red">*</span>المنطقة</label> <select class="form-control city"
                                        id='region_id' name='region_id' tabindex="5">

                                        <!-- <option disabled selected>Select Runner</option> -->

                                        @if (!empty($regions))
                                            @foreach ($regions as $region)



                                                <option value="{{ $region->id }}" @foreach (Auth::user()
            ->region()
            ->get()
        as $r)  @if ($r->id==$region->id) selected @endif
                                            @endforeach >{{ $region->name_ar }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="city_id" class=""><span
                                            style="color:red">*</span>المحافظة</label> <select class="form-control city"
                                        id='city_id' name='city_id' tabindex="4">

                                        <!-- <option disabled selected>Select Runner</option> -->

                                        @if (!empty($cities))
                                            @foreach ($cities as $city)



                                                <option value="{{ $city->id }}" @foreach (Auth::user()
            ->region()
            ->get()
        as $r)  @if ($r->city->id==$city->id) selected @endif
                                            @endforeach >{{ $city->name_ar }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-6">

                                <div class="position-relative form-group"><label for="availability" class="">حالة
                                        المتجر</label>
                                    <select class="form-control" id='availability' name='availability' tabindex="6">

                                        <option disabled selected>حدد حاله المتجر</option>
                                        <option value="open" @if (Auth::user()->availability == 'open') selected @endif>مفتوح</option>
                                        <option value="closed" @if (Auth::user()->availability == 'closed') selected @endif>مغلق</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                            <div class="position-relative form-group"><label for="type_id" class=""><span style="color:red">*</span> نوع المحل</label>
                                <select class="form-control type" id='type_id' name='type_id'>

                                    <option disabled selected> نوع المحل</option>

                                    @if (!empty($types))
                                    @foreach ($types as $type)

                                    <option value="{{$type->id}}" @if (Auth::user()->type_id == $type->id) selected @endif>{{$type->name_ar}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div> --}}
                            <div class="col-md-6">
                                <div class="position-relative form-group"><label for="type" class="">نوع
                                        المتجر</label><input name="type" id="type" disabled
                                        value="{{ Auth::user()->type->name_ar }}" type="text" class="form-control"
                                        tabindex="5"></div>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="position-relative form-group"><label for="categories" class=""><span
                                            style="color:red">*</span>تصنيفات المنتجات داخل المتجر</label>
                                    <select multiple class="form-control categories" id='categories' name='categories[]'
                                        tabindex="7">

                                        <option disabled>اختر تصنيف</option>
                                        @if (!empty($categories))
                                            @foreach ($categories as $category)
                                                <option data-name="{{ $category->name }}" value="{{ $category->id }}" @if (Auth::user()->categories)  @foreach (Auth::user()->categories as $cat)
                                                    @if ($cat->id == $category->id)
                                                        selected @endif
                                                    @endforeach
                                            @endif>{{ $category->name }}</option>
                                        @endforeach
                                        @endif
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
                                            @php $count = 1; @endphp
                                            @if (!empty(Auth::user()->categories))
                                                @foreach (Auth::user()->categories as $i)

                                                    <tr>
                                                        <td>{{ $count }}</td>
                                                        <td>{{ $i->name }}</td>

                                                    </tr>
                                                    @php $count ++; @endphp
                                                @endforeach
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">

                                <div class="position-relative form-group"><label for="photo" class=""><span
                                            style="color:red">*</span>صوره المتجر</label>
                                    <input name="photo" id="photo" type="file" class="form-control-file"
                                        onchange="changePreview(event, 'add','merchant_images');" tabindex="8">
                                    <!-- <small class="form-text text-muted">This is some
                                placeholder block-level help text for the above
                                input. It's a bit lighter and easily wraps to a new
                                line.
                            </small> -->

                                </div>
                                <div id="merchant_images">
                                    @if (!empty(Auth::user()->photo))
                                        <div class="img-prev">
                                            <img class="img-thumbnails" src="{{ url(Auth::user()->photo) }}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- <div class="position-relative form-check"><input name="check" id="exampleCheck" type="checkbox" class="form-check-input"><label for="exampleCheck" class="form-check-label">Check
                                me out</label></div> -->
                        <!-- <button class="mt-2 btn btn-primary">Sign in</button> -->
                        <button type='submit' class="btn btn-primary editProfile" tabindex="9">حفظ</button>

                    </form>
                </div>
            </div>
            <div class="main-card mb-3 card">
                <div class="card-body" style="text-align: right;">
                    <h5 class="card-title">تغير كلمه السر</h5>
                    <form class="">

                        {{ csrf_field() }}
                        <input type="hidden" id="merchant_id" name="merchant_id" value="{{ Auth::user()->id }}">

                        <div class="form-row">

                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="password-confirmation">تأكيد كلمة السر</label>
                                    <input name="password-confirmation" id="password_confirmation" class="form-control"
                                        type="password" tabindex="11">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="position-relative form-group">
                                    <label for="password">كلمة السر</label>
                                    <input name="password" id="password" class="form-control" type="password" tabindex="10">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary changePassword " tabindex="12">حفظ</button>

                    </form>


                </div>



            </div>
        </div>
    </div>

    </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('merchant-js/custom/js/profile.js') }}"></script>

@endsection
