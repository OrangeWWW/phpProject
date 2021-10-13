<?php

namespace app\controller;

use app\BaseController;
use think\facade\Request;
use think\facade\Cache;
use app\model\Cardiotoxicity2;

class DeleteTestData extends BaseController
{
  public function index()
  {
    $id = Request::get('id');
    $obj = new Cardiotoxicity2();
    $res = $obj->deleteTestData($id);
    if ($res) {
      if (Cache::get('test_data')) {
        Cache::delete('test_data');
        $obj = new IndexTest($this->app);
        return $obj->index();
      } else {
        $obj = new IndexTest($this->app);
        return $obj->index();
      }
    } else {
      echo '<script type="text/javascript">
            alert("data not exist");
            window.location.href = "IndexTest";
            </script>';
      exit();
    }
  }
}
