<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/7
 * Time: 下午5:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Random
{
//    /*
//     * 构造函数
//     * （可以传入参数进行实例化对象）
//     */
//    public function __construct(){
//        echo "对象生成";
//    }
//    /*
//     * 销毁函数
//     */
//    public function __destruct(){
//        echo "对象销毁";
//    }

    /*
     *  方法一： 获取随机字符串
     *  @param int $randLength      长度
     *  @param int $addTime         是否加入当前时间戳
     *  @param int $includeNumber   是否包含数字
     *  @return string              返回随机字符串
     */
    public function rand_str($randLength = 6, $addTime = 1, $includeNumber = 0)
    {
        if ($includeNumber)
        {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST123456789';
        }
        else
        {
            $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHJKLMNPQEST';
        }

        $len = strlen($chars);
        $randStr = '';

        for ($i = 0; $i < $randLength; $i++)
        {
            $randStr .= $chars[rand(0, $len - 1)];
        }
        $tokenValue = $randStr;

        if ($addTime)
        {
            $tokenValue = $randStr . time();
        }
        return $tokenValue;
    }

    /*
     *  方法一： 获取随机字符串
     *  @param number $length   长度
     *  @param string $type     类型
     *  @param number $convert  转换大小写
     *  @return string          返回随机字符串
     */
    public function random($length = 6, $type = 'string', $convert = 0)
    {
        $config = array(
            'number' => "1234567890",
            'letter' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'string' => 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789',
            'all'    => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'
        );
        if (!isset($config[$type])) $type = 'string';

        $string = $config[$type];

        $code = '';
        $strlen = strlen($string) - 1;
        for ($i = 0; $i < $length; $i++)
        {
            $code .= $string{mt_rand(0,$strlen)};
        }
        if (!empty($convert))
        {
            $code = ($convert > 0) ? strtoupper($code) : strtolower($code);
        }
        return $code;
    }
}
