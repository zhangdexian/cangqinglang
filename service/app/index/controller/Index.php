<?php
namespace app\index\controller;
use app\common\controller\Index as commonIndex;
use think\Config;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;

class Index
{


	public function __construct() 
	{

		//动态配置
		//config('before', 'beforeAction');
	}


    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://service.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="ad_bd568ce7058a1091"></think>';
    }


    public function common() 
    {

    	//return 123;
    	$common = new commonIndex;
    	//var_dump($common->index());
    	return $common->index();
    }


    public function config() 
    {
    	dump(config());
    }

    public function merge()
    {
    	$a = ['name' => 'zdx'];
    	$b = ['name' => 'zy'];
    	$c = array_merge($a, $b);
    	dump($a);
    	dump($b);
    	dump($c);
    }


    public function c1()
    {
    	//dump(Config::get());

        dump(config('database'));
    }

    public function useDatabase()

    {
//        $res = Db::query('select * from login where status=?',[1]);
//        $res = Db::execute('insert into courses set cno=?,cname=?,tno=?',['4-212','大学英语',201]);
//        $res = Db::table('courses')->select();
//        try {
//
//            //返回一条记录
//            $res = Db::table('courses')->where([
//                'cno' => '9-881'
//            ])->find('');
//        } catch (DataNotFoundException $e) {
//        } catch (ModelNotFoundException $e) {
//        } catch (DbException $e) {
//        }      //NULL     $res = Db::table('courses')->select()执行where则返回空数组

        //返回一条某字段的记录 带where条件查询结果不存在返回NULL
//        $res = Db::table('courses')->value('cname');

        //返回某一字段名的所有数据
        //$res = Db::table('courses')->column('cname');

        //返回键值对，如果结果不存在，返回空数组
        //$res = Db::table('courses')->column('cno','cname');

        //查询谋个值
        //$res = Db::table('courses')->find('高等数学');

        //自动将前缀添加到表名中
        $res = Db::name('courses')->select();


        dump($res);
    }


    //数据库操作
    public function databaseOperate()
    {
        $db = Db::name('courses');
        $res = $db->insert([
            'cno'=>'1-234',
            'cname'=>'概率论',
            'tno'=>'310'
        ]);

        //$db->insertAll();  可以一次插入多条数据

          //返回自增id
//        $res = $db->insertGetId([
//            'cno'=>'1-234',
//            'cname'=>'概率论',
//            'tno'=>'310'
//        ]);

        //返回影响条数
        dump($res);
    }


    //条件构造器
    public function condition()
    {
        $db = Db::name('courses');
        $sql = $db->where([
            'tno'=> '100'
        ])->buildSql();

        dump($sql);
    }
}
