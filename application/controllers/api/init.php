<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/7
 * Time: 下午4:10
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "/libraries/REST_Controller.php";

class init extends REST_Controller
{
    public function index_get()
    {
        if (empty($_GET['appid']))
        {
            $this->response(array(
                'result' => Result::FAIL,
                'msg'    => "appid cannot be empty ！"
            ));
        }
        // 取出字段
        $appid = $this->input->get('appid',TRUE);


        // 查询数据库
        $sql = "SELECT * FROM init WHERE appid = '$appid'";
        $query = $this->db->query($sql,array($appid));
        // result_array()函数是返回一个纯粹的数组结果
        foreach ($query->result_array() as $row) {

        }
        $data = array(
            'id'     => $row['id'],
            'appkey' => $row['appkey']
        );

        if ($row['appid'] == $appid)
        {
            // 数据库有对应的appkey，可以初始化
            $this->response(array(
                'result' => Result::SUCCESS,
                'msg'    => "初始化成功！",
                'data'   => $data
            ));
        }
        else
        {
            // 数据库没有对应的appkey，无法初始化
            $this->response(array(
                'result' => Result::FAIL,
                'msg'    => "初始化失败！",
                'data'   => array()
            ));
        }
    }

}