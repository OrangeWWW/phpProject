<?php

namespace app\controller;

use think\facade\View;

class About
{
  public function index()
  {
    return View::fetch('about');
  }
}
