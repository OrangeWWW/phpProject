<?php

namespace app\controller;

use app\BaseController;
use Exception;
use think\facade\Request;
use app\model\User;
use think\facade\Session;

class AlterUserPassword extends BaseController
{
  public function index()
  {
    try {
      $old_password = Request::post('old_password');
      $new_password = Request::post('new_password');
      $confirm_new_password = Request::post('confirm_new_password');
      if (!hash_equals($new_password, $confirm_new_password)) {
        echo '<script type="text/javascript">
              alert("twice inputed new passwords are not equal");
              window.location.href = "javascript:history.back(-1)";
              </script>';
        exit();
      }
      if (Session::has('userData')) {
        $session_data = Session::get('userData');
        $current_user_name = $session_data['userName'];
        $current_user_password = $session_data['passWord'];
        if (hash_equals($current_user_password, $new_password)) {
          echo '<script type="text/javascript">
                alert("old password and new password can not be same");
                window.location.href = "javascript:history.back(-1)";
                </script>';
          exit();
        }
        if (!hash_equals($current_user_password, $old_password)) {
          echo '<script type="text/javascript">
                alert("old password wrong");
                window.location.href = "javascript:history.back(-1)";
                </script>';
          exit();
        } else {
          $obj = new User();
          $res = $obj->alterUserPassword($current_user_name, $new_password);
          if ($res) {
            $obj = new Logout($this->app);
            return $obj->index();
          } else {
            echo '<script type="text/javascript">
                  alert("alter password fail");
                  window.location.href = "javascript:history.back(-1)";
                  </script>';
            exit();
          }
        }
      } else {
        echo '<script type="text/javascript">
              alert("please login");
              window.location.href = "login";
              </script>';
        exit();
      }
      $obj = new User();
    } catch (Exception $e) {
      echo '<script type="text/javascript">
            alert("alter password wrong");
            window.location.href = "alteruserdata";
            </script>';
      exit($e);
    }
  }
}
