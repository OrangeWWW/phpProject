<?php

namespace app\model;

use Exception;
use think\Model;
use think\facade\Db;

class Cardiotoxicity1 extends Model
{
  public function search($db, $name_id)
  {
    $res = Db::table($db)->where('name_id', $name_id)->select()->toArray();
    return $res;
  }
  public function showTrainData()
  {
    $res = Db::table('herg_cardiotoxicity1')->select()->toArray();
    return $res;
  }
  public function showTestData()
  {
    $res = Db::table('herg_cardiotoxicity2')->select()->toArray();
    return $res;
  }
  public function deleteTestData($id)
  {
    try {
      $res = Db::table('herg_cardiotoxicity2')->where('id', $id)->delete();
      return $res;
    } catch (Exception $e) {
      echo ($e);
    }
  }
  public function deleteTrainData($id)
  {
    try {
      $res = Db::table('herg_cardiotoxicity1')->where('id', $id)->delete();
      return $res;
    } catch (Exception $e) {
      echo ($e);
    }
  }
}
