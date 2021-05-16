<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Contact;
use App\Models\DeliveryMethod;
use App\Models\DeliveryTime;
use App\Models\Item;
use App\Models\Merchant;
use App\Models\OBDMaster;
use App\Models\Offer;
use App\Models\OfferTitle;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Section;
use App\Models\Token;
use App\Models\Unit;
use App\Models\Type;

use DB;
use Illuminate\Http\Request;
use Log;

class FuelController extends Controller
{
    public function newOPD(Request $request)
    {
        $item = OBDMaster::create($request->all());

        return responseJson(1, 'تم الاضافة بنجاح', $item);
    } 
}