<?php namespace Teman\Cms\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller{

    public $currentUser;

    function __construct()
    {
        //set the current logged in user
        $this->currentUser = Auth::user();
    }

}