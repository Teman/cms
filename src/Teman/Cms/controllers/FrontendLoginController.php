<?php namespace Teman\Cms\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class FrontendLoginController extends AuthController{


public function test(){
    dd($this->currentUser);
}


}