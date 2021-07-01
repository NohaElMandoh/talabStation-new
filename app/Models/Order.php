<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $dates = ['need_delivery_at'];


    protected $fillable = array(
        'note', 'address',  'cost', 'delivery_cost', 'total',   'shopping_cost',
        'state', 'client_id', 'delivery_confirmed_by_runner', 'delivery_confirmed_by_client', 'phone', 'home_phone', 'rejected_note','client_reject_reason','merchant_reject_reason'
    );
    protected $appends = ['runner_state', 'merchants_photos'];

    // public function delivery_time()
    // {
    //     return $this->belongsTo('App\Models\DeliveryTime');
    // }

    public function getRunnerStateAttribute()
    {
        // return $this->whereHas('runner', function ()  {
        //     return true;
        // });

        // return false;
        if (!empty($this->runners()->get()->count())) {
            $runner = $this->runners()->get();
            foreach ($runner as $run)
                return $run->pivot->state;
        } else return 'not assigned';
    }
    public function getMerchantsPhotosAttribute()
    {
        // return $this->items;
        $merchants_ids = [];
        $offers_ids = [];

        // $orders = $request->user()->orders()->get();
        // foreach ($orders as $order){
        $items = ItemOrder::where('order_id', $this->id)->with('item')->get();
        // return $items;

        if (count($items)) {
            foreach ($items as $item) {
                if ($item->item->type == 'item')
                    array_push($merchants_ids, $item->item->merchant_id);
                // $merchants_idst = $item->item->pluck('merchant_id');
                if ($item->item->type == 'offer')
                    array_push($merchants_ids, $item->item->merchant_id);
                if ($item->item->type == 'spacialItem')
                    array_push($merchants_ids, $item->item->merchant_id);
            }
        }


        $merchants_photos = Merchant::whereIn('id', $merchants_ids)->get()->toArray();
        // $offers_photos = Offer::whereIn('id', $offers_ids)->get()->toArray();

        // return array_merge($merchants_photos,$offers_photos);
        return $merchants_photos;
    }

    public function client()
    {
        return $this->belongsTo('App\Models\Client','client');
    }

    public function items()
    {
        return $this->belongsToMany('App\Models\Item')->withPivot('price', 'quantity', 'note');
    }
    public function item()
    {
        return $this->morphedTo();
    }
    public function products()
    {

        return $this->morphedByMany('App\Models\Item', 'item_order');
        // return $this->morphToMany('App\Models\Item', 'item');
    }


    public function merchant()
    {
        return $this->belongsTo('App\Models\Merchant');
    }

    public function runnerAccepted()
    {
        return $this->belongsToMany('App\Models\Runner')->wherePivot('state', 'accepted');
    }
    public function runners()
    {
        return $this->belongsToMany('App\Models\Runner', 'order_runner',  'order_id','runner_id')->withPivot('state', 'photo');
    }
   

  
    // public function oneRunner()
    // {
    //      return $this->runner->where( 'state','assigned')->first();
    //     // function ($query) {
    //     //     $query->first();
    //     // }
    // //     return $this->belongsToMany('App\Models\Runner');
    // }
    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    // public function getNeedDeliveryAtAttribute($value)
    // {
    //     $datetime = Carbon::parse($value);
    //     if (count($this->delivery_time))
    //     {
    //         return $datetime->format('Y-m-d').' '.$this->delivery_time->from;
    //     }
    //     return $datetime->format('Y-m-d');
    // }

    public function getStateTextAttribute($value)
    {

        $states = [
            'pending' => 'قيد التنفيذ',
            'accepted' => 'تم تأكيد الطلب',
            'rejected' => ' تم رفض الطلب',
        ];

        if (isset($states[$this->state])) {
            return $states[$this->state];
        }
        return "";
    }
}
