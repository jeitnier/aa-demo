<?php

namespace App\Events;

use App\Models\CrawledUrl;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * An event that dispatches a notification to a `results` channel
 * Had this been fully implemented, it would allow a subscriber like Echo
 * to know when the calling job completes.
 * Then you could do something like load the stats from the job in real-time
 */
class CrawlProcessed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private CrawledUrl $crawled_url;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(CrawledUrl $crawled_url)
    {
        $this->crawled_url = $crawled_url;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('results.' . $this->crawled_url->id);
    }
}
