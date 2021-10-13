<?php

namespace app\controller;

use app\BaseController;
use Exception;
use think\facade\Request;
use app\model\Cardiotoxicity2;
use think\facade\Cache;

class AddTestData extends BaseController
{
  public function index()
  {
    try {
      $smiles = trim(Request::post('smiles'));
      $pic50 = trim(Request::post('pic50'));
      $reference = trim(Request::post('reference'));
      $name_id = trim(Request::post('name_id'));
      $data_set = trim(Request::post('data_set'));
      $herg_id = trim(Request::post('herg_id'));
      if (empty($smiles) || empty($pic50) || empty($reference) || empty($name_id) || empty($data_set) || empty($herg_id)) {
        echo '<script type="text/javascript">
              alert("data can not be null");
              window.location.href = "AddTestDataShow";
              </script>';
        exit();
      }
      $obj = new Cardiotoxicity2();
      $res = $obj->addData($smiles, $pic50, $reference, $name_id, $data_set, $herg_id);
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
              alert("none of data added");
              window.location.href = "AddTestDataShow";
              </script>';
        exit();
      }
    } catch (Exception $e) {
      echo '<script type="text/javascript">
            alert("alter data wrong");
            window.location.href = "IndexTest";
            </script>';
      exit($e);
    }
  }
}
