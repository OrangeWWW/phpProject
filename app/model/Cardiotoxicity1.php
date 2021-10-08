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
  public function deleteTrainData($id)
  {
    try {
      $res = Db::table('herg_cardiotoxicity1')->where('id', $id)->delete();
      return $res;
    } catch (Exception $e) {
      echo ($e);
    }
  }
  public function showAlterData($id)
  {
    $res = Db::table('herg_cardiotoxicity1')->where('id', $id)->select()->toArray();
    return $res;
  }
  public function alterData($id, $SMIlES, $pIC50, $Reference, $name_id, $DataSet)
  {
    try {
      $res = Db::name('cardiotoxicity1')
        ->where('id', $id)
        ->update(
          [
            'SMILES' => $SMIlES,
            'pIC50' => $pIC50,
            'Reference' => $Reference,
            'name_id' => $name_id,
            'Data_set' => $DataSet
          ]
        );
      return $res;
    } catch (Exception $e) {
      echo ($e);
    }
  }
}
