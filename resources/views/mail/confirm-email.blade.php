@component('mail::message')
# One more thing...

We just need you to confirm your human-side to prevent spammers and the like in. All good, right?

@component('mail::button', ['url' => url('/register/confirm?token=' . $user->confirmation_token)])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
