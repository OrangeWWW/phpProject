<?php

namespace app\controller;

use app\BaseController;
use think\facade\Request;
use think\facade\Cache;
use app\model\Cardiotoxicity1;

class DeleteTrainData extends BaseController
{
  public function index()
  {
    $id = Request::get('id');
    $obj = new Cardiotoxicity1();
    $res = $obj->deleteTrainData($id);
    if ($res) {
      if (Cache::get('train_data')) {
        Cache::delete('train_data');
        $obj = new IndexTrain($this->app);
        return $obj->index();
      } else {
        $obj = new IndexTrain($this->app);
        return $obj->index();
      }
    } else {
      echo '<script type="text/javascript">
            alert("data not exist");
            window.location.href = "IndexTrain";
            </script>';
      exit();
    }
  }
}
