<h1>{{ Lang::get('cms::confirm.subject') }}</h1>

<p>{{ Lang::get('cms::confirm.intro', array( 'name' => $username)) }},</p>

<p>{{ Lang::get('cms::confirm.body') }}</p>
<a href='{{ URL::route('cms.noauth.password.form',['token'=>$token]) }}'>
    {{ URL::route('cms.noauth.password.form',['token'=>$token])  }}
</a>
