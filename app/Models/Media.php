<?php

namespace App\Models;

use App\Mail\MediaDownloadCompletedMailer;
use App\Models\API\Radarr;
use App\Models\API\Sonarr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'genre_ids' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function refreshDownloadStatus()
    {
        // Get all incomplete requests
        $allIncompleteMedia = self::where('status', '!=', 'completed')->get(); // response is a collection

        foreach ($allIncompleteMedia as $media) {

            if ($media->media_type == 'movie') {

                $status = 'requested';

                if ($media->status == 'downloading') {
                    $status = 'failed';
                }

                // get the movie
                $movie = (new Radarr)->getMovieById($media->downloader_id);

                // check if movie is in queue
                if ($queueItem = (new Radarr)->isMovieInQueue($movie['id'])) {
                    if ($queueItem['status'] == 'paused') {
                        $status = 'processing';
                    } elseif ($queueItem['status'] == 'completed' && $queueItem['trackedDownloadState'] == 'importPending') {
                        $status = 'importing';
                    } else {
                        $status = 'downloading';
                    }
                }

                if ($movie['hasFile']) {
                    $status = 'completed';

                    if ($media->user->settings->notification_download_completed) {
                        Mail::to($media->user->email)->send(new MediaDownloadCompletedMailer($media));
                    }
                }

                $media->status = $status;
                $media->save();

                /**
                 * ADD FEATURE TO REPORT FAILED DOWNLOADS HERE
                 *
                 * IF FAILED_DOWNLOAD_COUNT > 3 THEN ADD TO DATABASE
                 */

            } elseif ($media->media_type == 'tv') {

                $status = 'requested';

                if ($media->status == 'downloading') {
                    $status = 'failed';
                }

                $series = (new Sonarr)->getSeriesById($media->downloader_id);

                dd($series);
            }
        }
    }
}
