<?php

namespace App\Http\Controllers\Pay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use App\Model\Goods;

class PayController extends Controller
{
    //跳转
    public function pay(Request $request){
        $cart_id=$request->cart_id;
        echo $cart_id;
    }
	//结算
    public function payment($id){
    	
    	//echo $cart_id;
    	$cart_id=explode(',',rtrim($id,','));
    	$data=Cart::whereIn('cart_id',$cart_id)->get();
    	//print_r($data);die;
    	$goods_id=[]; 
    	foreach($data as $k=>$v){
    		$goods_id[]=$v['goods_id'];
    	}
    	$goodsinfo=Goods::join('cart', 'goods.goods_id', '=', 'cart.goods_id')
                    ->whereIn('cart.goods_id',$goods_id)
                    ->get();

    	//print_r($goodsinfo);die;
    	return view('pay.payment',['goodsinfo'=>$goodsinfo]);
    } 
}
