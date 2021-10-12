<?php

namespace app\model;

use Exception;
use think\Model;
use think\facade\Db;

class Cardiotoxicity1 extends Model
{
  public function search($db, $herg_id)
  {
    $res = Db::table($db)->where('Herg_id', $herg_id)->select()->toArray();
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
  public function alterData($id, $SMIlES, $pIC50, $Reference, $name_id, $DataSet, $herg_id)
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
            'Data_set' => $DataSet,
            'Herg_id' => $herg_id
          ]
        );
      return $res;
    } catch (Exception $e) {
      echo ($e);
    }
  }
  public function addData($SMIlES, $pIC50, $Reference, $name_id, $DataSet, $herg_id)
  {
    try {
      $res1 = Db::table('herg_cardiotoxicity1')->where('SMILES', $SMIlES)->find();
      $res2 = Db::table('herg_cardiotoxicity1')->where('name_id', $name_id)->find();
      $res3 = Db::table('herg_cardiotoxicity1')->where('Herg_id', $herg_id)->find();
      if ($res1 || $res2 || $res3) {
        echo '<script type="text/javascript">
              alert("smiles or name&id can not be same");
              window.location.href = "addtraindatashow";
              </script>';
        exit();
      } else {
        $data = [
          'SMILES' => $SMIlES,
          'pIC50' => $pIC50,
          'Reference' => $Reference,
          'name_id' => $name_id,
          'Data_set' => $DataSet,
          'Herg_id' => $herg_id
        ];
        $res = Db::name('cardiotoxicity1')->insert($data);
        return $res;
      }
    } catch (Exception $e) {
      echo ($e);
    }
  }
}
