<?php namespace Teman\Cms\Controllers;

use Teman\Cms\Forms\LoginForm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Laracasts\Validation\FormValidationException;

class AuthController extends BaseController
{

    protected $loginForm;

    function __construct(LoginForm $loginForm)
    {
        $this->loginForm = $loginForm;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        return View::make('cms::auth.login');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->loginForm->validate($input = Input::only('email', 'password'));

        if (Auth::attempt($input)) {
            return Redirect::intended('admin');
        }



        return Redirect::back()->withInput()->withFlashMessage('Invalid credentials');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy()
    {
        Auth::logout();

        return Redirect::to('/');
    }


}
