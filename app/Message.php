<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'channel_id',
    ];

    /**
     * Get the user that owns the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("App\User");
    }

    /**
     * Get the channel that owns the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo("App\Channel");
    }

    /**
     * Get all the readreceipts associated with this message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function readReceipts()
    {
        return $this->hasMany("App\ReadReceipt");
    }
}
