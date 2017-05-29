<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The relations that are eagerly loaded.
     *
     * @var array
     */
    protected $with = ['roles'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the messages for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany("App\Message");
    }

    /**
     * Get the channels for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function channels()
    {
        return $this->belongsToMany("App\Channel");
    }

    /**
     * Get the loginRequests for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loginRequests()
    {
        return $this->hasMany("App\LoginRequest");
    }

    /**
     * Get the roles for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->belongsToMany("App\Role");
    }
}
