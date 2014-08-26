<?php namespace Teman\Cms\Controllers;

use Teman\Cms\Libraries\Authentication;
use Teman\Cms\Forms\LoginForm;

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
        return \View::make(\Config::get('cms::auth.login_view'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        return Authentication::doLogin($this->loginForm);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy()
    {
        return Authentication::logout();
    }


}
