<?php namespace Teman\Cms\Controllers;


use Teman\Cms\Forms\ForgotForm;
use Teman\Cms\Forms\ResetPasswordForm;
use Laracasts\Validation\FormValidationException;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Password;
use Laracasts\Flash\Flash;

/**
 * ForgotController Class
 *
 * Implements actions regarding user password resetting
 */
class ForgotController extends BaseController
{

    protected $forgotForm;
    protected $resetPasswordForm;

    function __construct(ForgotForm $forgotForm, ResetPasswordForm $resetPasswordForm)
    {
        $this->forgotForm = $forgotForm;
        $this->resetPasswordForm = $resetPasswordForm;
    }

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        return View::make(Config::get('cms::auth.forgot_view'));
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        $input = Input::only('email');
        $this->forgotForm->validate($input);

        $response = Password::remind($input, function($message){
                        $message->subject(Lang::get('cms::forgot.remind_subject'));
                    });

        switch ($response){
            case Password::INVALID_USER:
                Flash::error(Lang::get($response));
                return Redirect::back();

            case Password::REMINDER_SENT:
                Flash::success(Lang::get($response));
                return Redirect::back();
        }
    }

    /**
     * Display the password reset view for the given token.
     *
     * @param  string  $token
     * @return Response
     */
    public function getReset($token = null)
    {
        if (is_null($token)) App::abort(404);

        return View::make(Config::get('cms::auth.reset_view'))->with('token', $token);
    }

    /**
     * Handle a POST request to reset a user's password.
     *
     * @return Response
     */
    public function postReset()
    {
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $this->resetPasswordForm->validate($credentials);

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = $password;
            //reset login attempts (if active)
            if(Config::get('cms::auth.lockout_after_attempts')) {
                $user->login_attempts = 0;
            }
            $user->forceSave();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                Flash::error(Lang::get($response));
                return Redirect::back();

            case Password::PASSWORD_RESET:
                Flash::success(Lang::get('cms::forgot.success'));
                return Redirect::route(Config::get('cms::auth.success_route'));
        }
    }
}
