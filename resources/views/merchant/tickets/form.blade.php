@include('admin.layouts.partials.validation-errors')
@include('flash::message')
<div class="row" style="text-align: right;">
    <div class="col-md-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"> :رسالة جديدة </h5>
                <form enctype="multipart/form-data">

                    {{ csrf_field() }}
                    <div class="form-row">

                        <div class="error hidden">
                            <ul></ul>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative form-group"><label for="type" class=""> <span style="color:red">*</span>:نوع الرسالة </label>
                                <select class="form-control" id='type' name='type'>
                                    <option disabled selected> نوع الرسالة </option>
                                    <option value="complaint">شكوى</option>
                                    <option value="suggestion">اقتراح</option>
                                    <option value="inquiry">استفسار</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="col-md-12">
                            <div class="position-relative form-group">
                                <label for="exampleText" class=""><span style="color:red">*</span>محتوى الرسالة</label>
                                <textarea name="content" id="content" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <button class="mt-1 btn btn-primary addTicket">إرسال</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>