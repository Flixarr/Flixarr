<?php

namespace App\Mail;

use App\Models\Media;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MediaDownloadCompletedMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $media;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Media $media)
    {
        $this->media = $media;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.media.download-completed')->subject('Your movie is ready to watch!');
    }
}
