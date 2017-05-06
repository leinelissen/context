<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LoginRequest extends Model
{
    /**
     * Time in minutes that a login request is valid.
     *
     * @var int
     */
    public $expires = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'token',
    ];

    /**
     * Create a login request for a particular user.
     *
     * @param User $user
     *
     * @return LoginRequest
     */
    public static function createForUser(User $user)
    {
        return self::create([
            'user_id' => $user->id,
            'token'   => bin2hex(random_bytes(32)),
        ]);
    }

    /**
     * Check if the LoginRequest has not expired yet.
     *
     * @return bool
     */
    public function isValid()
    {
        $now = Carbon::now();
        $created = Carbon::parse($this->created_at);

        return $created->diffInMinutes($now) < $this->expires;
    }

    /**
     * Get the user that owns the login request.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
