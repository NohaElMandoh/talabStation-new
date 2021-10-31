@include('admin.layouts.partials.validation-errors')
@include('flash::message')

<form>
<div class="error hidden">
						<ul></ul>
					</div>
    <input type="hidden" id="edit_id" name="edit_id" value="{{$order->id}}">

    {{ csrf_field() }}
    <div class="form-row ">
                    <div class="col-md-12">
                        <div class="error hidden" style="text-align: right;">

                            <ul></ul>
                        </div>
                    </div>
                    </div>
    <input type="hidden" name="_method" value="PUT">

    <div class="row" style="text-align: right;">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title"> :بيانات الطلب </h5>
                    <div class="row">
                        <div class="table-responsive col-12" style="text-align: right;">
                            <table class="table" dir="rtl" id="order-table">
                                <thead style="text-align: right;">
                                    <tr>
                                        <th>#</th>
                                        <th>المنتجات &amp; والوصف</th>
                                        <th class="text-right">نوع المنتج</th>
                                        <th class="text-right">الكمية</th>
                                        <th class="text-right">سعر الوحدة</th>
                                        <th class="text-right">ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php $count = 1; @endphp
                                    @foreach($items as $item)


                                    <tr class="item_id">
                                        <th scope="row">
                                            <input type="hidden" id="item_id" name="item_id" value="{{$item->id}}">

                                            {{$count}}</th>
                                        <td>
                                            <p>{{$item->item->name}}</p>
                                            <p class="text-muted">{{$item->item->description}}
                                            </p>

                                        </td>
                                        <td class="text-right">{{$item->item->type}}</td>
                                        <td class="text-right">
                                            <input type="number" class="form-control validate[required]" id="quantity" min="1" value="{{$item->quantity}}" name="quantity">
                                        </td>
                                        <td class="text-right">
                                           
                                            <input type="number" class="form-control validate[required]" id="price" step="0.01" min="1" value="{{$item->price}}" name="price">

                                        </td>
                                        <td class="text-right">{{$item->note}}</td>
                                    </tr>
                                    @php $count ++; @endphp
                                    @endforeach

                                </tbody>
                            </table>
                            <button class="mt-1 btn btn-primary" id="set-price"> حفظ التعديل</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</form>