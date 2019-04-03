<?php

namespace App\Http\Controllers\Index;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Goods;
use App\Model\Cart;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    protected static $arrCate;
    /*
     * @微商城前台Index
     * */
    public function Index()
    {
        $model=new Goods();
        $data=$model::get();
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        return view("index.index",['data'=>$data],['cate'=>$cate]);
    }
    /*
     * @商品列表加条件
     * */
    public function IndexShopId($id)
    {
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        //print_r($cate);die;
        $this->get($id);
        $arr=self::$arrCate;
        //print_r($arr);die;
        $data=DB::table("goods")->whereIn('cate_id',$arr)->get();
        return view("index.indexshop",['data'=>$data],['cate'=>$cate]);
    }

    /*
     * @商品列表
     * */
    public function IndexShop()
    {
        $model=new Goods();
        $data=$model::get();
        $cate_model=new Category();
        $cate=$cate_model->where('p_id','=','0')->get();
        //print_r($cate);die;
        return view("index.indexshop",['data'=>$data],['cate'=>$cate]);
    }
    /*
     * @商品列表ajax
     * */
    public function IndexShopAjax(Request $request)
    {
        $cate_id=$request->cate_id;
        //print_r($cate);die;
        $this->get($cate_id);
        $arr=self::$arrCate;
        //print_r($arr);die;
        $data=DB::table("goods")->whereIn('cate_id',$arr)->get();
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     * @商品列表is_new
     * */
    public function IsNew()
    {
        $data=DB::table("goods")->where("is_new","=","1")->get();
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     * @商品搜索
     * */
    public function search(Request $request)
    {
        return view("index.search");
        
    }
    /*
     * @商品搜索
     * */
    public function searchdo(Request $request)
    {
        $search=$request->search;
        //echo $search;die;
        $data=DB::table("goods")->where("goods_name","like","%$search%")->get();
        
        //print_r($data);die;
        return view("index.searchdiv",['data'=>$data]);
    }
    /*
     * @商品列表price
     * */
    public function Price(Request $request)
    {

        $type=$request->type;
        if($type==1){
            $data=DB::table("goods")->orderBy("self_price","desc")->get();
        }else{
            $data=DB::table("goods")->orderBy("self_price","asc")->get();
        }
        //print_r($cate);die;
        return view("index.shopdiv",['data'=>$data]);
    }
    /*
     *
     * */
    public function get($id)
    {
        $arrIds=DB::table("category")->select("cate_id")->where("p_id",$id)->get();
        //print_r($arrIds);die;
        if(count($arrIds)!=0){
            foreach($arrIds as $k=>$v){
                $cateId=$v->cate_id;
                $Ids=$this->get($cateId);
                //print_r($Ids);die;
                self::$arrCate[]=$Ids;
            }


        }
        if(count($arrIds)==0){
            return $id;
        }
    }
    /*
     * @增加购物车
     * */
    public function addcart(Request $request)
    {
        $user_id=session('user_id');
        if($user_id==''){
            echo 1;die;
        }else{
            $data['goods_id']=$request->goods_id;
            $cart=new Cart;
            $data['user_id']=$user_id;
            $data['buy_number']=1;
            $arr=$cart::where('goods_id',$data['goods_id'])
                ->where('user_id',$data['user_id'])
                ->where('cart_status',1)
                ->first();
            if(empty($arr)){
                $res=$cart::insert($data);
                if($res){
                    echo 2;die;
                }else{
                    echo 3;die;
                }
            }else{
                $num=$arr['buy_number']+$data['buy_number'];
                $res=$cart::where('goods_id',$data['goods_id'])
                    ->where('user_id',$data['user_id'])
                    ->update(['buy_number'=>$num]);
                if($res){
                    echo 2;die;
                }else{
                    echo 3;die;
                }
            }
        }

        //print_r($data['goods_id']);die;

        //print_r($data['user_id']);die;

        //print_r($arr);die;


        
    }
    /*
     * @商品购物车
     * */
    public function IndexShopCar(Request $request)
    {
        $cart=new Cart;
        $user_id=session('user_id');
        $userwhere=[
            'user_id'=>$user_id,
            'cart_status'=>1
        ];
        $arr=$cart::where($userwhere)->get();
        $goods_id=[];
        foreach($arr as $k=>$v){
            $goods_id[]=$v->goods_id;
        }
        //print_r($goods_id);die;
        $goods=new Goods;
        $goodsinfo=$goods::join('cart', 'goods.goods_id', '=', 'cart.goods_id')
                    ->whereIn('cart.goods_id',$goods_id)
                    ->where('cart_status',1)
                    ->get();
        
        //print_r($goodsinfo);die;
        return view("index.indexshopcar",['goodsinfo'=>$goodsinfo]);
    }
    /*
     * @删除购物车
     * */
    public function cartdel(Request $request)
    {   
        $cart_id=$request->cart_id;
        //echo $cart_id;
        $cart_id=explode(',',rtrim($cart_id,','));
        //print_r($cart_id);die;
        $user_id=session('user_id');
        if(empty($cart_id)){
            $res=Cart::where('user_id',$user_id)->update(['cart_status'=>2]); 
        }else{
            $res=Cart::whereIn('cart_id',$cart_id)->update(['cart_status'=>2]);
        }
        
        //dd($res);
    }
     /*
     * @删除
     * */
    public function del(Request $request)
    {
        $cart_id=$request->cart_id;
        //echo $cart_id;
        $res=Cart::where('cart_id',$cart_id)->update(['cart_status'=>2]);
    }  
    /*
     * @直接改变数量
     * */
    public function changenum(Request $request)
    { 
        $buy_number=$request->buy_num;
        $cart_id=$request->cart_id;
        //echo $buy_number;
        $res=Cart::where('cart_id',$cart_id)->update(['buy_number'=>$buy_number]);
    }
    /*
     * @点击增加商品
     * */
    public function add(Request $request)
    { 
        $cart_id=$request->cart_id;
        $data=Cart::where('cart_id',$cart_id)->first();
        //print_r($data);die;
        $res=Cart::where('cart_id',$cart_id)->update(['buy_number'=>$data['buy_number']+1]);
        dd($res);
    }
    /*
     * @点击减少商品
     * */
    public function min(Request $request)
    { 
        $cart_id=$request->cart_id;
        $data=Cart::where('cart_id',$cart_id)->first();
        //print_r($data);die;
        $res=Cart::where('cart_id',$cart_id)->update(['buy_number'=>$data['buy_number']-1]);
        dd($res);
    }
    /*
     * @我的潮购
     * */
    public function IndexUser()
    {
        return view("index.indexuser");
    }
    /*
     * @商品详情页
     * */
    public function IndexContent($id)
    {
        $model=new Goods();
        $data=$model->where("goods_id",'=',$id)->get();
        return view("index.shopcontent",['data'=>$data]);
    }
    //检查是否超过库存
    /*
      $goods_id 为商品id
      $num 为已添加的商品数量
      $buy_num 为将要添加的商品数量
    */
    function checkgoodsnum($goods_id,$num,$buy_num,$type=1){
        $where=[
          'goods_id'=>['in',$goods_id]
        ];
        $goods_num=Goods::where($where)->value('goods_num');
        if($num+$buy_num>$goods_num){
          $n=$goods_num-$num;
          if($type==1){
            fail('您购买的数量超过库存，您还可以购买'.$n.'件');
          }else{
            return false;
          }
          
        }else{
          return true;
        }
      }
}
