<?php

namespace app\controller;

use app\BaseController;
use Exception;
use think\facade\View;
use think\facade\Request;
use app\model\Cardiotoxicity2;

class AlterTestDataShow extends BaseController
{
  public function index()
  {
    try {
      $id = Request::get('id');
      $obj = new Cardiotoxicity2();
      $data = $obj->showAlterData($id);
      View::assign([
        'data' => $data
      ]);
      return View::fetch('databaseshow/altertestdatashow');
    } catch (Exception $e) {
      echo '<script type="text/javascript">
            alert("database id wrong");
            window.location.href = "IndexTest";
            </script>';
      exit($e);
    }
  }
}
