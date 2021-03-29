<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MediaRequestedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $tmdbId;
    public $mediaType;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($tmdbId, $mediaType)
    {
        $this->tmdbId = $tmdbId;
        $this->mediaType = $mediaType;
    }
}
