<?php

namespace App\Listeners;

use Redis;
use Response;
use App\Events\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListener
{

    CONST EVENT = 'event-channel';
    CONST CHANNEL = 'event-channel';
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
     * @param  Event  $event
     * @return void
     */
    public function handle(Event $event)
    {
      $redis = Redis::connection();
      $redis->publish(self::CHANNEL, json_encode($event));
      return $event;
    }
}
