<?php

namespace app\controller;

use app\BaseController;
use think\facade\Session;
use think\facade\Request;
use app\model\User;

class DataBaseShow extends BaseController
{
  public function index()
  {
    if (!Request::post('userName')) {
      echo '<script type="text/javascript">
            alert("illegal access");
            window.location.href = "Index";
            </script>';
      exit();
    } else {
      // 接受post数据
      $userName = Request::post('userName');
      $passWord = Request::post('passWord');
      // 用模型查找用户数据
      $obj = new User();
      $res_userdata = $obj->searchUserData($userName);
      if (sizeof($res_userdata) == 0) {
        echo '<script type="text/javascript">
              alert("user does not exist");
              window.location.href = "Login";
              </script>';
        exit();
      } else {
        $user_password = $res_userdata[0]['passWord'];
        if (hash_equals($user_password, $passWord)) {
          Session::set('user_data', $res_userdata[0]);
          // 用户登录成功，调用数据库模型查找数据
          $obj = new IndexTrain($this->app);
          return $obj->index();
        } else {
          echo '<script type="text/javascript">
                alert("password wrong");
                window.location.href = "Login";
                </script>';
          exit();
        }
      }
    }
  }
}
