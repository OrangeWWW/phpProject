<?php

namespace app\model;

use Exception;
use think\Model;
use think\facade\Db;

class User extends Model
{
  public function searchUserData($userName)
  {
    $res = Db::table('herg_user')->where('userName', $userName)->select()->toArray();
    return $res;
  }
  public function alterUserPassword($userName, $passWord)
  {
    try {
      $res = Db::name('user')->where('userName', $userName)->update(['passWord' => $passWord]);
      return $res;
    } catch (Exception $e) {
      echo ($e);
    }
  }
}
