<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/4
 * Time: 下午8:11
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Register extends REST_Controller
{

    public function index_get()
    {

        // 判断是否输入值
        if(empty($_GET['account']) || empty($_GET['password'])) {
            $this -> response(array(
                'result' => Result::ACCOUNTORPWD_EMPTY ,
                'msg'    => '账号密码不能为空！')
            );
        }

        // 取出数据
        $account  = $this -> get('account', TRUE);
        $password = $this -> get('password',TRUE);

        // 从数据库获取数据
        $sql = "SELECT * FROM user WHERE account = '$account'";
        $query = $this->db->query($sql);
        if ($query->row_array()){
            $this->response(array(
                'result' => Result::ACCOUNT_EXIST,
                'msg'    => '用户已存在！')
            );
        }else{
            // 包装数据
            $data = array(
                'account'  => $account,
                'password' => $password,
            );

            // 添加数据到数据库
            if($this->db->insert('user',$data)) {
                $this->response(array(
                    'result' => Result::SUCCESS,
                    'msg'    => '新建成功！')
                );
            }else {
                $this->response(array(
                    'result' => Result::FAIL,
                    'msg'    =>'新建失败！')
                );
            }
        }
    }
}