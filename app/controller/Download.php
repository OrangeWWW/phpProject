<?php

namespace app\controller;

use think\facade\View;

class Download
{
  public function index()
  {
    return View::fetch('download');
  }
}
