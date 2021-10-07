<?php

namespace app\controller;


class RdkitPicture
{
  public function index($SMILES)
  {
    //exec有三个参数:
    //exec($String,$out,$res)

    //第一个参数为一个字符串，包括三个子串，第一个子串为使用的当前系统的解释器，指定本地 python.exe 的路径。
    //第二个子串为所要执行的python脚本的位置。
    //第三个子串为所需传入的参数不限个数，中间用空格分隔，注意格式。子串间空格分割。

    //第二个参数是php接收的python脚本的返回值，
    //此处的$out中存放的并非python中return的值，并且所有return的值都不会进行保存，
    //$out中存放的是python脚本中输出的值，即为print（）函数所输出的所有数据，
    //每次print（）都会记录为一条字典数据，组合成array数组。

    //第三个参数为执行情况的状态码，如果执行成功，返回0，否则返回一个非0数。
    exec("C:/Python/python.exe C:/phpStudy/PHPTutorial/WWW/herg_database/app/python/test.py {$SMILES}");
  }
}
