<?php
namespace app\account\controller;
use think\Db;

class Index
{
    public function index()
    {
        var_dump(Db::name('user_info')->find()); //获取数据表中第一条数据
    }
}
