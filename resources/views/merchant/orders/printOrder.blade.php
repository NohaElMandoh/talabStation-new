<!DOCTYPE html>
<head>
<meta charset="utf-8">
    <title>Talab Station</title>
    <style type="text/css" media="print">
@page {
    size: auto;   /* auto is the initial value */
    margin:0;  /* this affects the margin in the printer settings */
}
</style>
    <style>
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
@include('management-merchant.partials.style')
</head>
<body>

    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title" >
                                <img src="{{asset('Dashboard-UI/images/talab-station-logo.png')}}" style="margin-left:25%" >
                            </td>
                            
                            <td>
                                {{$order->id}}: فاتورة رقم <br>
                                {{$order->created_at}} : تاريخ الفاتورة <br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
            <td style="text-align: center;">
                            Talab Station Company<br>
                                شركة طلب ستيشن<br>
                               شمال سيناء -العريش -شارع القاهرة
                            </td>
                <td colspan="2">
                
                    <table >
                        <tr>
                        @if(!empty($order->client))
                            <td>
                            <p class="lead" style="text-align: right;"> بيانات العميل</p>
                     
                        <div class="table-responsive">
                            <table  style="text-align: right;">
                                <tbody>
                                    <tr>
                                    <td style="text-align:right;padding-bottom:0px"> {{$order->client->name}}</td>
                            <td style="text-align:right;padding-bottom:0px">: اسم العميل</td>

                                    </tr>
                                    <tr>
                                    <td style="text-align:right;padding-bottom:0px" > {{$order->client->email}}</td>
                            <td style="text-align:right;padding-bottom:0px">: ايميل العميل</td>

                                    </tr>
                                    <tr>
                                    <td style="text-align:right;padding-bottom:0px" > {{$order->client->address}}</td>
                            <td style="text-align:right;padding-bottom:0px">: عنوان العميل</td>
                            
                                    </tr>
                                    <tr>
                                    <td style="text-align:right;padding-bottom:0px">  {{$order->client->phone}} </td>
                            <td style="text-align:right;padding-bottom:0px"> : رقم التليفون </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                   
                           
                            </td>
                            
                          
                            @endif
                        </tr>
                    </table>
                </td>
            </tr>
            
        </table>

         <!-- Invoice Items Details -->
         <div id="invoice-items-details" class="pt-2">
                <div class="row">
                    <div class="table-responsive col-12" style="text-align: right;">
                        <table class="table" dir="rtl">
                            <thead style="text-align: right;">
                                <tr>
                                    <th>#</th>
                                    <th>المنتجات &amp; والوصف</th>
                                    <!-- <th  class="text-right">نوع المنتج</th> -->
                                    <th class="text-right">الكمية</th>
                                    <th class="text-right">سعر الوحدة</th>
                                    <th class="text-right">ملاحظات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $count = 1; @endphp
                                @foreach($items as $item)
                                
                                <tr>
                                    <th scope="row">{{$count}}</th>
                                   <td>
                                        <p>{{$item->item->name}}</p>
                                        <p class="text-muted">{{$item->item->description}}
                                        </p>
                                       
                                    </td>
                                    {{--<td class="text-right">{{$item->item->type}}</td>--}}
                                    <td class="text-right">{{$item->quantity}}</td>
                                    <td class="text-right">{{$item->price}}</td>
                                    <td class="text-right">{{$item->note}}</td>
                                </tr>
                                @php $count ++; @endphp
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                   
                    <div class="col-sm-5 col-12">
                        <p class="lead" style="text-align: right;">إجمالى الفاتورة</p>
                        <div class="table-responsive">
                            <table class="table" style="text-align: right;">
                                <tbody>
                                    <tr>
                                        <td class="text-left">{{$order->cost}}</td>

                                        <td>التكلفة</td>

                                    </tr>
                                    <tr>
                                        <td class="text-left">{{$order->delivery_cost}}</td>
                                        <td>تكلفة التوصيل</td>

                                    </tr>
                                    <tr>
                                        <td class="text-bold-800 text-left">{{$order->shopping_cost}}</td>

                                        <td class="text-bold-800">تكلفه المشتريات</td>
                                    </tr>
                                    <tr>
                                        <td class="pink text-left">{{$order->total}}</td>

                                        <td>الاجمالى</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                   
                    </div>
                </div>
            </div>


    </div>
<!-- 
© 2021 GitHub, Inc.
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About -->


</body>
</html>