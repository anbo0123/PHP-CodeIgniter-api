<?php
/**
 * Created by PhpStorm.
 * User: Ampaw
 * Date: 2017/1/7
 * Time: 上午11:13
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . "/libraries/REST_Controller.php";

class CookClass extends REST_Controller
{
    public function index_get()
    {
        if (empty($_GET['account']))
        {
            $this->response(array(
                'result' => Result::FAIL,
                'msg'    => "账号不能为空！"
            ));
        }
    }
}
