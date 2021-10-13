<?php

namespace app\model;

use Exception;
use think\Model;
use think\facade\Db;

class Cardiotoxicity1 extends Model
{
  public function search($db, $herg_id)
  {
    $res = Db::table($db)->where('herg_id', $herg_id)->select()->toArray();
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
  public function alterData($id, $smiles, $pic50, $reference, $name_id, $data_set, $herg_id)
  {
    try {
      $res = Db::name('cardiotoxicity1')
        ->where('id', $id)
        ->update(
          [
            'smiles' => $smiles,
            'pic50' => $pic50,
            'reference' => $reference,
            'name_id' => $name_id,
            'data_set' => $data_set,
            'herg_id' => $herg_id
          ]
        );
      return $res;
    } catch (Exception $e) {
      echo ($e);
    }
  }
  public function addData($smiles, $pic50, $reference, $name_id, $data_set, $herg_id)
  {
    try {
      $res1 = Db::table('herg_cardiotoxicity1')->where('smiles', $smiles)->find();
      $res2 = Db::table('herg_cardiotoxicity1')->where('name_id', $name_id)->find();
      $res3 = Db::table('herg_cardiotoxicity1')->where('herg_id', $herg_id)->find();
      if ($res1 || $res2 || $res3) {
        echo '<script type="text/javascript">
              alert("smiles or id can not be same");
              window.location.href = "AddTrainDataShow";
              </script>';
        exit();
      } else {
        $data = [
          'smiles' => $smiles,
          'pic50' => $pic50,
          'reference' => $reference,
          'name_id' => $name_id,
          'data_set' => $data_set,
          'herg_id' => $herg_id
        ];
        $res = Db::name('cardiotoxicity1')->insert($data);
        return $res;
      }
    } catch (Exception $e) {
      echo ($e);
    }
  }
}
