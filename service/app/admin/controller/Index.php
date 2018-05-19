<?php

namespace app\admin\controller;
use think\Db;

class Index
{

    /**
     * @return string
     */
    public function index()
    {
        return "admin";
    }

    //进入网站统计ip
    public function logIp()
    {
        $ip = $this->get_client_ip($type = 0, $adv = true);
        $data = ['ip_address' => $ip, 'time'=> date("Y-m-d H:i:s", time())];
        $res = Db::table('login')->insert($data);
        $return = ['status'=> $res, 'message' => $res?'success':'error'];
        return $return;
    }


    //返回网站总访问人数和总IP数

    /**
     * @return array
     */
    public function getVisitorNumbers()
    {
        $total = Db::table('login')->count();
        $totalIp = Db::table('login')->group('ip_address')->count();
        $return = ['status' => 1, 'data' => ['total' => $total, 'totalIp' => $totalIp]];
        return $return;
    }


    /**
     * 获取客户端IP地址
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    function get_client_ip($type = 0, $adv = false)
    {
        $type = $type ? 1 : 0;
        static $ip = NULL;
        if ($ip !== NULL) return $ip[$type];
        if ($adv) {//高级模式获取(防止伪装)
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos = array_search('unknown', $arr);
                if (false !== $pos) unset($arr[$pos]);
                $ip = trim($arr[0]);
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u", ip2long($ip));
        $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}
