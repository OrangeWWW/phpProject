<?php

namespace app\controller;

use think\facade\View;

class Prediction
{
  public function index()
  {
    return View::fetch('prediction');
  }
}
