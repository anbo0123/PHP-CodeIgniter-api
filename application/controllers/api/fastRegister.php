<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/7
 * Time: 下午8:44
 */
defined('BASEPATH') OR exit('No direct script access allowed !');
require APPPATH . "/libraries/REST_Controller.php";
require APPPATH . "/libraries/Random.php";

class fastRegister extends REST_Controller
{
    public function index_get()
    {
        if (empty($_GET['appkey']))
        {
            $this->response(array(
                'result' => Result::REQUESTPARAM_EMPTY,
                'msg'    => "empty request param !",
                'data'   => array()
            ));
        }
        // 取出字段
        $appkey = $this->get('appkey',TRUE);

        // 验证appkey是否正确
        $sql_key = "SELECT * FROM init WHERE appkey = '$appkey'";
        $query_key = $this->db->query($sql_key);
        if ($query_key->row_array())
        {
            // 初始化数据表中有对应的appkey
            // 自动生成账号密码
            $random = new Random();
            $account = 'kby'.$random->random(9,'number');
            $password = md5('123456');
            // 查询数据库
            $sql = "SELECT * FROM user WHERE account = ? AND  appkey = ?";
            $query = $this->db->query($sql,array($account,$appkey));
            foreach ($query->result_array() as $row) {

            }

            if ($appkey == $row['appkey'] && $account == $row['account'])
            {
                $this->response(array(
                    'result' => Result::FAIL,
                    'msg'    =>'注册失败，请重新注册！',
                    'data'   => array()
                ));
            }
            else
            {
                // 包装数据
                $data = array(
                    'account'  => $account,
                    'password' => $password,
                    'appkey'   => $appkey,
                );

                // 添加数据到数据库
                if($this->db->insert('user',$data)) {
                    $this->response(array(
                        'result' => Result::SUCCESS,
                        'msg'    => '注册成功！',
                        'data'   => $data
                    ));
                }else {
                    $this->response(array(
                        'result' => Result::FAIL,
                        'msg'    =>'注册失败！',
                        'data'   => array()
                    ));
                }
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