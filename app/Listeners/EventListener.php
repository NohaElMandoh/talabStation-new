<?php

namespace App\Listeners;

use App\Events\SomeEvent;
use App\Models\Client;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListener
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
    public function handle(SomeEvent $event)
    {
        // $user    = auth()->user();
        $order = $event->order;
        $merged = $event->merged;
        // if (!empty($ticket)) {
          
        // $user = User::where('email', 'admin@admin.com')->first();
        // $collection1=collect($user);
        // $current_user = Client::where('id', $client_id)->first();
        // // $current=Client::where('id',$client_id)->first();
        // $users = $collection1->merge($current_user);
        // array_push($users,$current);
        // $result = $users->all();
       


        if (!empty($merged)) {

            foreach ($merged as $use) {
                $noti = \App\Models\Notification::create([
                    'type'            => $event->className,
                    'notifiable_type' => get_class($use),
                    'notifiable_id'   => $use->id,
                    'user_id'         => $order->client_id, //create order
                    'order_id'      => $order->id,
                    'order_url'     => 'admin/order/' . $order->id,

                    'title'         => $event->text,
                    'title_en'         => $event->text,
                    'content'         => $event->text,
                    'content_en'         => $event->text,

                ]);
            }
        }
        // }
    }
}
