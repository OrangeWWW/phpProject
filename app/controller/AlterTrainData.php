<?php

namespace app\controller;

use app\BaseController;
use Exception;
use think\facade\Request;
use app\model\Cardiotoxicity1;
use think\facade\Cache;

class AlterTrainData extends BaseController
{
  public function index()
  {
    try {
      $id = trim(Request::post('id'));
      $SMIlES = trim(Request::post('SMILES'));
      $pIC50 = trim(Request::post('pIC50'));
      $Reference = trim(Request::post('Reference'));
      $name_id = trim(Request::post('name_id'));
      $DataSet = trim(Request::post('DataSet'));
      $herg_id = trim(Request::post('herg_id'));
      if (empty($SMIlES) || empty($pIC50) || empty($Reference) || empty($name_id) || empty($DataSet) || empty($herg_id)) {
        echo '<script type="text/javascript">
              alert("data can not be null");
              window.location.href = "javascript:history.back(-1)";
              </script>';
        exit();
      }
      $obj = new Cardiotoxicity1();
      $res = $obj->alterData($id, $SMIlES, $pIC50, $Reference, $name_id, $DataSet, $herg_id);
      if ($res) {
        if (Cache::get('traindata')) {
          Cache::delete('traindata');
          $obj = new IndexTrain($this->app);
          return $obj->index();
        } else {
          $obj = new IndexTrain($this->app);
          return $obj->index();
        }
      } else {
        echo '<script type="text/javascript">
              alert("none of data changed");
              window.location.href = "javascript:history.back(-1)";
              </script>';
        exit();
      }
    } catch (Exception $e) {
      echo '<script type="text/javascript">
            alert("alter data wrong");
            window.location.href = "indextrain";
            </script>';
      exit($e);
    }
  }
}
