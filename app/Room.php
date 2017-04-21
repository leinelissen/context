<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name"
    ];

    /**
     * The attributes that should be cast to a certain type
     *
     * @var array
     */
    protected $casts = [
        "group" => "boolean"
    ];

    /**
     * Get the messages for the room.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany("App\Message");
    }

    /**
     * The users that belong to the room.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany("App\User");
    }
}
