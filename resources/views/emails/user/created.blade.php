@component('mail::message')
# Hi there {{ $user->first_name }}!

Welcome to Context, and thank you for registering.

@component('mail::button', ['url' => URL::to('/')])
Check out Context
@endcomponent

@endcomponent
