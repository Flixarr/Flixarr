<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        // static::created(function ($media) {
        //     if ($media->media_type == 'movie') {
        //         event(new MovieRequested($media->toArray()));
        //     } elseif ($media->media_type == 'tv') {
        //         // add to sonarr
        //     }
        // });
    }
}
