<?php

namespace App\Mail;

use App\LoginRequest;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserLoginRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The supplied loginRequest.
     *
     * @var LoginRequest
     */
    public $loginRequest;

    /**
     * The associated user.
     *
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param LoginRequest $loginRequest
     *
     * @return void
     */
    public function __construct(LoginRequest $loginRequest)
    {
        $this->loginRequest = $loginRequest;
        $this->user = $loginRequest->user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.user.login');
    }
}
