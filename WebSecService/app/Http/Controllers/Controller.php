<?php

namespace App\Http\Controllers;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    //
    public function __construct()
    {
        $this->middleware('auth:web')->except(['index', 'login', 'doLogin', 'register', 'doRegister']);
    }
}
