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
     * Get all of the owning readreceiptable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function readReceiptable()
    {
        return $this->morphTo();
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
