<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;

class AddTrainDataShow extends BaseController
{
  public function index()
  {
    return View::fetch('databaseshow/addtraindata');
  }
}
