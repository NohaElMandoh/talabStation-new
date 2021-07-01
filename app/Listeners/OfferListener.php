<?php

namespace App\Listeners;

use App\Events\OfferEvent;
use App\Events\SomeEvent;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OfferListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(OfferEvent $event)
    {
        // $user    = auth()->user();
        $offer = $event->offer;
        // if (!empty($ticket)) {

            $user = User::where('email','admin@admin.com')->first();
   
            if (!empty($user)) {
                // foreach ($users as $us) {
                    $noti = \App\Models\Notification::create([
                        'type'            => $event->className,
                        'notifiable_type' => get_class($user),
                        'notifiable_id'   => $user->id,
                        'user_id'         => $offer->merchant_id,//create offer
                        'offer_id'      => $offer->id,
                        'offer_url'     => 'admin/offer/'.$offer->id,

                        'title'         => $event->text,
                        'title_en'         => $event->text,
                        'content'         => $offer->name,
                        'content_en'         => $offer->name,

                    ]);
                   
                // }
            }
        // }
    }
}
