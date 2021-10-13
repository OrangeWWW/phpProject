<?php

namespace app\controller;

use think\facade\View;
use think\facade\Cache;
use app\model\Cardiotoxicity2;

class ShowTestData
{
  public function index()
  {
    if (Cache::get('show_test_data')) {
      $cache_data = Cache::get('show_test_data');
      View::assign([
        'data' => $cache_data,
        'size' => sizeof($cache_data)
      ]);
      return View::fetch('download/showtestdata');
    } else {
      $obj = new Cardiotoxicity2();
      $data = $obj->showTestData();
      $info = Cache::set('show_test_data', $data, 3600);
      if ($info) {
        View::assign([
          'data' => $data,
          'size' => sizeof($data)
        ]);
        return View::fetch('download/showtestdata');
      } else {
        echo '<script type="text/javascript">
              alert("cache wrong");
              window.location.href = "DownLoad";
              </script>';
        exit();
      }
    }
  }
}
