<?php
//
//namespace app\api\controller;
//
//use think\Config;
//use think\Request;
//
//
//class Index
//{
//
//    /**
//     * @return string
//     */
//    public function index()
//    {
//        return "api.index";
//    }
//
//    /**
//     * @param Request $request
//     * @return string
//     */
//    public function demo(Request $request)
//    {
//        //第一种获取request的方式
//        //$request = request();
//
//        //第二种
//        //$request = Request::instance();
//
//        //第三种
//        //dump($request);
//
//        //$request 对象
//
//        #获取浏览器输入的值
//        //dump($request->domain());   //string(16) "http://localhost"
//        //dump($request->pathinfo());    //string(15) "Index/demo.html"
//        //dump($request->path());        //string(10) "Index/demo"
//        //dump($request->url());        //string(39) "/api.php/Index/demo.html?id=10&name=zdx"
//        //dump($request->baseUrl());    //string(24) "/api.php/Index/demo.html"
//
//        #获取请求类型
//        // dump($request->method());        //string(3) "GET"
//        // dump($request->isGet());         //bool(true)
//        // dump($request->isPost());
//        // dump($request->isAjax());
//
//        // dump($request->get());              //array
//        dump($request->param()['id']);
//        // dump($request->post());
//
//        #session助手函数
//        // session('name', 'zdx');
//
//        // dump($request->session());
//        // dump($request->cookie());
//
//        //dump(cookie('zdx', 'zy'));
//        //dump(cookie('zdx'));
//
//        #获取模块 控制器  操作
//
//        // dump($request->module());
//        // dump($request->controller());
//        // dump($request->action());
//
//        return "api demo";
//    }
//
//
//    public function param($id)
//    {
//
//        #response对象
//
//        //动态配置
//        Config::set('default_return_type', 'json');
//        //Config::set('default_return_type', 'html');
//        $res = ['status' => 1, 'data' => [
//            'label' => '价格',
//            'price' => 20
//        ]];
//        //用这种方式可以返回以html表示的json
//        //return dump($res);
//
//
//        dump(config('database'));
//    }
//}