<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/5
 * Time: 下午8:16
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "/libraries/REST_Controller.php";

class changeUserMsg extends REST_Controller
{
    public function index_get()
    {
        if (empty($_GET['account']) || empty($_GET['password']))
        {
            $this->response(array(
                'result' => Result::ACCOUNTORPWD_EMPTY,
                'msg'    => "账号密码不能为空！"
            ));
        }

        // 取出字段
        $account = $this->get('account',TRUE);
        $password = $this->get('password',TRUE);
        $icon = $this->get('icon',TRUE);
        $sex = $this->get('sex',TRUE);
        $birthday = $this->get('birthday',TRUE);
        $address =$this->get('address',TRUE);

        // 包装修改数据
        $data = array(
            'icon'      => $icon,
            'sex'       => $sex,
            'birthday'  => $birthday,
            'address'   => $address,
        );

        // 查询数据库
        $sql = "SELECT * FROM user WHERE account = ? AND  password = ?";  // 获取指定条件下的表数据
        $query = $this -> db -> query($sql,array($account,$password));
        foreach ($query->result_array() as $row) {

        }
        if ($account == $row['account'] && $password == $row['password'])
        {
            /*
             * 使用指定id来更新数据
             * 参数说明：
             *     第一个参数 'user'是"数据表"；
             *     第二个参数 $data 是"要更新的数据"；
             *     第三个参数 array 是"WHERE语句的键（条件）"。
             */
            $this->db->update('user',$data,array('id' => $row['id']));
            $this->response(array(
                'result' => Result::SUCCESS,
                'msg'    => "修改成功！"
            ));
        }
        else
        {
            $this->response(array(
                'result' => Result::FAIL,
                'msg'    => "修改失败！"
            ));
        }

    }
}