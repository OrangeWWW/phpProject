<?php

namespace app\model;

use think\Model;
use think\facade\Db;

class User extends Model
{
  public function searchUserData($userName)
  {
    $res = Db::table('herg_user')->where('userName', $userName)->select()->toArray();
    return $res;
  }
}
