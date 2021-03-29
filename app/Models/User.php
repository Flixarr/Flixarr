<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function createNewUser($plexData, $password)
    {
        $this->email = $plexData['user']['email'];
        $this->password = bcrypt($password);
        $this->plex_id = $plexData['user']['id'];
        $this->plex_uuid = $plexData['user']['uuid'];
        $this->plex_joined_at = $plexData['user']['joined_at'];
        $this->plex_username = $plexData['user']['username'];
        $this->plex_title = $plexData['user']['title'];
        $this->plex_thumb = $plexData['user']['thumb'];

        // plex is weird, so I want to ensure token is always available
        if (isset($plexData['authToken'])) {
            $this->plex_token = $plexData['authToken'];
        } elseif (isset($plexData['authentication_token'])) {
            $this->plex_token = $plexData['authentication_token'];
        } else {
            $this->plex_token = "0";
        }

        $this->save();

        return $this;

    }
}
