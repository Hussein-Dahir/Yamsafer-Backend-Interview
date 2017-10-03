<?php

namespace App\Listeners;

use App\Event;
use App\Events\SubscriptionEvent;
use App\Subscriber;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscriptionEventListener
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
     * @param  SubscriptionEvent $event
     * @return void
     */
    public function handle(SubscriptionEvent $subscriptionEvent)
    {
        //var_dump($event->eventObject['name'] . ' event triggered !');

        $eventArray = $subscriptionEvent->event;

        $eventId = $eventArray['id'];
        $event = \App\Event::find($eventId);

        $urls = $event->subscribers()->pluck('url');

        //dd($urls);

        foreach ($urls as $url) {

            // send notification
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "eventId=" . $eventId);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $response = curl_exec ($ch);
            curl_close ($ch);

        }
    }
}
