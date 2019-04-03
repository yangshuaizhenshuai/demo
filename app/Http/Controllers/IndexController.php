<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Category;

class IndexController extends Controller
{
    //首页
    public function index()
    {
        $data=Goods::get();
        $cateInfo=Category::get();

        $cateInfo=$this->cateInfo($cateInfo);
        return view("index",['data'=>$data,'cateInfo'=>$cateInfo]);
    }

    //获取分类
    public function cateInfo($cateInfo,$pid=0){
        static $arr=[];
        foreach($cateInfo as $k=>$v){
            if($v['pid']==$pid){
                $arr[]=$v;
            }
        }
        return $arr;
    }
}
