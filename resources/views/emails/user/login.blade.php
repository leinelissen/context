@component('mail::message')
# Hi {{ $user->first_name }}!

It appears you are trying to login to Context. How wonderful! Click the button below to get authenticated. It's as simple as that.

@component('mail::button', ['url' => URL::to('/auth/token/' . $loginRequest->token)])
Login
@endcomponent

If you did not try to login, pretend we never bothered you.

@endcomponent
