<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Cache;
use app\model\Cardiotoxicity2;

class IndexTest extends BaseController
{
  public function index()
  {
    if (Cache::get('test_data')) {
      $cache_data = Cache::get('test_data');
      View::assign([
        'data' => $cache_data,
        'size' => sizeof($cache_data)
      ]);
      return View::fetch('databaseshow/indextest');
    } else {
      $obj = new Cardiotoxicity2();
      $data = $obj->showTestData();
      $info = Cache::set('test_data', $data, 3600);
      if ($info) {
        View::assign([
          'data' => $data,
          'size' => sizeof($data)
        ]);
        return View::fetch('databaseshow/indextest');
      } else {
        echo '<script type="text/javascript">
              alert("cache wrong");
              window.location.href = "Login";
              </script>';
        exit();
      }
    }
  }
}
