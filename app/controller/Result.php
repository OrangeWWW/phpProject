<?php

namespace app\controller;

use think\facade\View;

class Result
{
  public function index()
  {
    return View::fetch('result');
  }
}
