<?php

namespace app\controller;

use app\BaseController;
use Exception;
use think\facade\View;
use think\facade\Request;
use app\model\Cardiotoxicity1;

class AlterTrainDataShow extends BaseController
{
  public function index()
  {
    try {
      $id = Request::get('id');
      $obj = new Cardiotoxicity1();
      $data = $obj->showAlterData($id);
      View::assign([
        'data' => $data
      ]);
      return View::fetch('databaseshow/altertraindatashow');
    } catch (Exception $e) {
      echo '<script type="text/javascript">
                alert("database id wrong");
                window.location.href = "indextrain";
                </script>';
      exit($e);
    }
  }
}
