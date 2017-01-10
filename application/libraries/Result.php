<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/4
 * Time: 下午8:26
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Result{
    const SUCCESS   = 200;   // 请求成功
    const FAIL      = 500;   // 请求失败
    const ACCOUNTORPWD_EMPTY = 1000;  // 账号或密码为空
    const ACCOUNTORPWD_FAIL  = 1001;  // 账号或密码错误
    const ACCOUNT_EXIST      = 1002;  // 用户已存在
    const REQUESTPARAM_EMPTY = 1003;  // 请求参数为空
    const REQUESTPARAM_FAIL  = 1004;  // 请求参数错误
}