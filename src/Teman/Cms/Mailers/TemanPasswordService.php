<?php namespace  Teman\Cms\Mailers;

use Illuminate\Auth\Reminders\RemindableInterface;
use Zizaco\Confide\EloquentPasswordService;
use Zizaco\Confide\PasswordServiceInterface;

/**
 * A service that abstracts all user password management related methods.
 *
 * @license MIT
 * @package Zizaco\Confide
 */
class TemanPasswordService extends EloquentPasswordService  implements PasswordServiceInterface
{

    /**
     * Sends an email containing the reset password link with the
     * given token to the user.
     *
     * @param RemindableInterface $user  An existent user.
     * @param string              $token Password reset token.
     *
     * @return void
     */
    protected function sendEmail($user, $token)
    {
        dd('lol');
        $config = $this->app['config'];
        $lang   = $this->app['translator'];

        $subject = $lang->get('confide::confide.email.password_reset.subject');
        $this->app['mailer']->queueOn(
            $config->get('confide::email_queue'),
            $config->get('confide::email_reset_password'),
            compact('user', 'token', $subject),
            function ($message) use ($user, $token, $subject) {
                $message
                    ->to($user->email, (isset($user->username) ? $user->username : null))
                    ->subject($subject);
                //->subject($lang->get('confide::confide.email.password_reset.subject'));
            }
        );
    }

}
