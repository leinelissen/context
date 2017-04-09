<?php

namespace App;

use App\Traits\OwnedByUser;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use OwnedByUser;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "properties"
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
}
