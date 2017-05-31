<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReadReceipt extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "read"
    ];

    /**
     * Get the message that owns the readreceipt.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function message()
    {
        return $this->belongsTo("App\Message");
    }

    /**
     * Get the user that owns the read receipt.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
