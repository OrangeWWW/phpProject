<?php

namespace app\controller;

use think\facade\View;
use think\facade\Request;
use app\model\Cardiotoxicity1;
use Exception;

class SearchData
{
  public function index()
  {
    try {
      // 接受post数据
      $db = Request::post('db');
      $herg_id = Request::post('herg_id');
      // 调用模型查找数据
      $obj = new Cardiotoxicity1();
      $data = $obj->search($db, $herg_id);
      // 数据验证
      if (sizeof($data) == 0) {
        echo '<script type="text/javascript">
              alert("string does not exist");
              window.location.href = "prediction";
              </script>';
        exit();
      } else {
        // 保存smiles字符串
        $SMILES = array_values($data[0])[1];
        // 调用控制器执行python脚本画分子图
        $pictute = new RdkitPicture();
        $pictute->index($SMILES);
        View::assign([
          'data' => $data
        ]);
        return View::fetch('result/result_show');
      }
    } catch (Exception $e) {
      echo '<script type="text/javascript">
            alert("illegal access");
            window.location.href = "index";
            </script>';
      exit($e);
    }
  }
}
