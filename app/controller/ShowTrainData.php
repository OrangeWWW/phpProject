<?php

namespace app\controller;

use think\facade\View;
use think\facade\Cache;
use app\model\Cardiotoxicity1;

class ShowTrainData
{
  public function index()
  {
    if (Cache::get('showtraindata')) {
      $cache_data = Cache::get('showtraindata');
      View::assign([
        'data' => $cache_data,
        'size' => sizeof($cache_data)
      ]);
      return View::fetch('download/showtraindata');
    } else {
      $obj = new Cardiotoxicity1();
      $data = $obj->showTrainData();
      $info = Cache::set('showtraindata', $data, 3600);
      if ($info) {
        View::assign([
          'data' => $data,
          'size' => sizeof($data)
        ]);
        return View::fetch('download/showtraindata');
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
