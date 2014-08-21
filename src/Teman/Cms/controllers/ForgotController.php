<?php namespace Teman\Cms\Controllers;


use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
//use \Laracasts\Flash\Flash;
use \Confide;

/**
 * ForgotController Class
 *
 * Implements actions regarding user password resetting
 */
class ForgotController extends BaseController
{

    /**
     * Displays the forgot password form
     *
     * @return  Illuminate\Http\Response
     */
    public function forgotPassword()
    {
        Flash::message('test');
        return View::make('cms::auth.forgot.forgot_password');
    }

    /**
     * Handle a POST request to remind a user of their password.
     *
     * @return Response
     */
    public function postRemind()
    {
        switch ($response = Password::remind(Input::only('email')))
        {
            case Password::INVALID_USER:
                //Flash::error(Lang::get($response));
                return Redirect::back();

            case Password::REMINDER_SENT:
                //Flash::success(Lang::get($response));
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

        return View::make('cms::auth.forgot.reset_password')->with('token', $token);
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

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                //Flash::error(Lang::get($response));
                return Redirect::back();

            case Password::PASSWORD_RESET:
                //Flash::success('Your password has been reset.');
                return Redirect::to('/');
        }
    }
}
