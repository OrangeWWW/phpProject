<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Cache;
use app\model\Cardiotoxicity1;

class IndexTrain extends BaseController
{
  public function index()
  {
    if (Cache::get('train_data')) {
      $cache_data = Cache::get('train_data');
      View::assign([
        'data' => $cache_data,
        'size' => sizeof($cache_data)
      ]);
      return View::fetch('databaseshow/indextrain');
    } else {
      $obj = new Cardiotoxicity1();
      $data = $obj->showTrainData();
      $info = Cache::set('train_data', $data, 3600);
      if ($info) {
        View::assign([
          'data' => $data,
          'size' => sizeof($data)
        ]);
        return View::fetch('databaseshow/indextrain');
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
