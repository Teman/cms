<h1>{{ Lang::get('cms::forgot.remind_subject') }}</h1>

<p>{{ Lang::get('cms::forgot.remind_greeting', array( 'name' => $user['username'])) }},</p>

<p>{{ Lang::get('cms::forgot.remind_body') }}</p>
<a href='{{ URL::route('cms.noauth.forgot.token',['token'=>$token]) }}'>
    {{ URL::route('cms.noauth.forgot.token',['token'=>$token])  }}
</a>

<p>{{ Lang::get('cms::forgot.remind_farewell', ['minutes' => Config::get('auth.reminder.expire', 60)]) }}</p>
