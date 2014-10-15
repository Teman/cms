<h1>{{ Lang::get('confide::confide.email.account_confirmation.subject') }}</h1>

<p>{{ Lang::get('confide::confide.email.account_confirmation.body') }}</p>
<a href='{{{ URL::route('cms.noauth.forgot.confirm',['code'=>$user['confirmation_code']]) }}}'>
    {{{ URL::route('cms.noauth.forgot.confirm',['code'=>$user['confirmation_code']]) }}}
</a>

<p>{{ Lang::get('confide::confide.email.account_confirmation.farewell') }}</p>
