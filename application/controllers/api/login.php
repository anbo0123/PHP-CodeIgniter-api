<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/5
 * Time: 上午11:50
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller
{
    /**
     *
     */
    public function index_get()
    {

        // 判断是否已输入账号密码
        if (empty($_GET['account']) || empty($_GET['password']) || empty($_GET['appkey']))
        {
            $this -> response(array(
                'result' => Result::ACCOUNTORPWD_EMPTY,
                'msg'    => "empty request param ！"
            ));
        }

        // 取出字段
        $account  = $this -> input -> get('account',TRUE);
        $password = $this -> input -> get('password',TRUE);
        $appkey   = $this -> input -> get('appkey',TRUE);

        // 查询数据库
        /*
        // 方法一：缺陷是只能查询第一条数据
        $count = $this->db->count_all('user'); // 获取整张数据表的行数
        $query1 = $this -> db -> get('user');  // 获取整张表数据
        foreach ($query1 -> result() as $user) {

        }
        $data1 = array();
        if ($user->account == $account && $user->password == $password)
        {
            $data1 = $user;
            $this -> response(array(
                'result' => Result::SUCCESS,
                'msg'    => "登陆成功！",
                'data'   => $data1
            ));
        }
        elseif ($user->account != $account || $user->password != $password)
        {
            $this -> response(array(
                'result' => Result::ACCOUNTORPWD_FAIL,
                'msg'    => "账号或密码错误！",
                'data'   => $data1
            ));
        }
        else
        {
            $this -> response(array(
                'result' => Result::FAIL,
                'msg'    => "登陆失败！",
                'data'   => $data1
            ));
        }
        */


        // 方法二：
        $sql = "SELECT * FROM user WHERE account = ? AND  password = ? AND appkey = ?";  // 获取指定条件下的表数据
        // 查询绑定【查询语句中的"？"将会被第二参数位置的数组相应值替代】
        $query = $this -> db -> query($sql,array($account,$password,$appkey));
        /*
         * 注意：当在查询数据库时，以上两个条件中任意为假，得到的结果集都为空，不会进入foreach循环中
         */
        foreach ($query -> result_array() as $row) {

        }

        if ($appkey == $row['appkey'])
        {
            $data = array();
            if ($row['account'] == $account && $row['password'] == $password)
            {
                // 封装自定义返回数据
                $data = array(
                    'account' => $row['account'],
                    'password'=> $row['password'],
                    'birthday'=> $row['birthday'],
                    'sex'     => $row['sex'],
                    'icon'    => $row['icon'],
                    'address' => $row['address']
                );
                $data = $row;
                $this -> response(array(
                    'result' => Result::SUCCESS,
                    'msg'    => "登陆成功！",
                    'data'   => $data
                ));
            }
            elseif ($row['account'] != $account || $row['password'] != $password)
            {
                $this -> response(array(
                    'result' => Result::ACCOUNTORPWD_FAIL,
                    'msg'    => "账号或密码错误！",
                    'data'   => $data
                ));
            }
            else
            {
                $this -> response(array(
                    'result' => Result::FAIL,
                    'msg'    => "登陆失败！",
                    'data'   => $data
                ));
            }
        }
        else
        {
            $this->response(array(
                'result' => Result::FAIL,
                'msg'    => 'appkey param error !',
                'data'   => array()
            ));
        }


    }
}
