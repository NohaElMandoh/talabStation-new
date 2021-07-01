<?php

namespace App\Listeners;

use App\Events\OfferEvent;
use App\Events\SomeEvent;
use App\Events\TicketEvent;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketListener
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
    public function handle(TicketEvent $event)
    {
        // $user    = auth()->user();
        $ticket = $event->ticket;
        // if (!empty($ticket)) {

            $user = User::where('email','admin@admin.com')->first();
   
            if (!empty($user)) {
                // foreach ($users as $us) {
                    $noti = \App\Models\Notification::create([
                        'type'            => $event->className,
                        'notifiable_type' => get_class($user),
                        'notifiable_id'   => $user->id,
                        'user_id'         => $ticket->merchant_id,//create offer
                        'offer_id'      => $ticket->id,
                        'offer_url'     => 'merchant/ticket/'.$ticket->id,

                        'title'         => 'تواصل معنا من التاجر',
                        'title_en'         => 'Ticket From Merchant',
                        'content'         => $ticket->content,
                        'content_en'         => $ticket->content,

                    ]);
                   
                // }
            }
        // }
    }
}
