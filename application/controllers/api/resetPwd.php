<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/6
 * Time: 上午11:18
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "/libraries/REST_Controller.php";

class resetPwd extends REST_Controller
{
    public function index_get()
    {
        if (empty($_GET['appkey'])|| empty($_GET['account']))
        {
            $this->response(array(
                'result' => Result::ACCOUNTORPWD_EMPTY,
                'msg'    => "empty request param ！"
            ));
        }

        // 取出字段
        $account  = $this->input->get('account',TRUE);
        $password = $this->input->get('password',TRUE);
        $appkey   = $this->input->get('appkey',TRUE);

        // 查询数据库
        $sql = "SELECT * FROM user WHERE account = ? AND appkey = ?";
        $query = $this->db->query($sql,array($account,$appkey));
        foreach ($query->result_array() as $row)
        {
            // 获取该账号在数据库的主键值
            $id = $row['id'];
        }

        if ($appkey == $row['appkey'] && $account == $row['account'])
        {
            /*
             *  重置数据库中主键和账号对应的密码
             *  注意：在使用update更新数据库时，一定要指明主键。否则会更新对应字段的所有数据。
             */
            $this->db->update('user',array('password' => $password),array('id' => $id));
            $this->response(array(
                'result' => Result::SUCCESS,
                'msg'    => "重置成功！"
            ));
        }
        else
        {
            $this->response(array(
                'result' => Result::FAIL,
                'msg'    => "重置失败！"
            ));
        }
    }
}