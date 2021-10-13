<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Session;

class Logout extends BaseController
{
  public function index()
  {
    if (Session::has('user_data')) {
      Session::delete('user_data');
      return View::fetch('login/login');
    } else {
      return View::fetch('login/login');
    }
  }
}
