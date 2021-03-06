<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\LoginRequest;
use App\Mail\UserLoginRequest;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Override default login routine with email magic links.
     *
     * @param Request $request
     *
     * @return View
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users',
        ]);

        $user = User::where('email', $request->email)->first();

        $loginRequest = LoginRequest::createForUser($user);

        Mail::to($user)->send(new UserLoginRequest($loginRequest));

        return view('auth.token', ['loginRequest' => $loginRequest]);
    }

    /**
     * Verify a token link and login user.
     *
     * @param string $token
     *
     * @return Response
     */
    public function authenticateToken($token)
    {
        $loginRequest = LoginRequest::where('token', $token)->firstOrFail();

        if (!$loginRequest->isValid()) {
            return view('auth.link-expired');
        }

        Auth::login($loginRequest->user, true);

        return redirect($this->redirectTo);
    }
}
