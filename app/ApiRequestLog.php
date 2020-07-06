<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ApiRequestLog extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requester', 'url', 'method', 'ip_address', 'status_code'
    ];

    protected $table = 'api_request_log';

    /**
     * Get the user that owns the post.
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'requester');
    }

}
