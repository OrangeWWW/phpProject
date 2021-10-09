<?php

namespace app\model;

use Exception;
use think\Model;
use think\facade\Db;

class Cardiotoxicity2 extends Model
{
  public function search($db, $name_id)
  {
    $res = Db::table($db)->where('name_id', $name_id)->select()->toArray();
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
  public function showAlterData($id)
  {
    $res = Db::table('herg_cardiotoxicity2')->where('id', $id)->select()->toArray();
    return $res;
  }
  public function alterData($id, $SMIlES, $pIC50, $Reference, $name_id, $DataSet)
  {
    try {
      $res = Db::name('cardiotoxicity2')
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
  public function addData($SMIlES, $pIC50, $Reference, $name_id, $DataSet)
  {
    try {
      $res1 = Db::table('herg_cardiotoxicity2')->where('SMILES', $SMIlES)->find();
      $res2 = Db::table('herg_cardiotoxicity2')->where('name_id', $name_id)->find();
      if ($res1 || $res2) {
        echo '<script type="text/javascript">
              alert("data can not be same");
              window.location.href = "addtestdatashow";
              </script>';
        exit();
      } else {
        $data = [
          'SMILES' => $SMIlES,
          'pIC50' => $pIC50,
          'Reference' => $Reference,
          'name_id' => $name_id,
          'Data_set' => $DataSet
        ];
        $res = Db::name('cardiotoxicity2')->insert($data);
        return $res;
      }
    } catch (Exception $e) {
      echo ($e);
    }
  }
}
