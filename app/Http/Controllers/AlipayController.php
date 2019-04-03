<?php

namespace App\Http\Controllers;
use App\Tools\alipay\wappay\service\AlipayTradeService;
use App\Tools\alipay\wappay\buildermodel\AlipayTradeWapPayContentBuilder;
use Illuminate\Http\Request;

class AlipayController extends Controller
{
    public function phonepay()
    {
    	header("Content-type: text/html; charset=utf-8");
    	$config=config('alipay');

    //商户订单号，商户网站订单系统中唯一订单号，必填
    $out_trade_no = date('Ymdhis').mt_rand(11111,99999);

    //订单名称，必填
    $subject = "王东豹";

    //付款金额，必填
    $total_amount = 0.01;

    //商品描述，可空
    $body = "赔钱都没人要";

    //超时时间
    $timeout_express="1m";

    $payRequestBuilder = new AlipayTradeWapPayContentBuilder();
    $payRequestBuilder->setBody($body);
    $payRequestBuilder->setSubject($subject);
    $payRequestBuilder->setOutTradeNo($out_trade_no);
    $payRequestBuilder->setTotalAmount($total_amount);
    $payRequestBuilder->setTimeExpress($timeout_express);

    $payResponse = new AlipayTradeService($config);
    $result=$payResponse->wapPay($payRequestBuilder,$config['return_url'],$config['notify_url']);

   
    	return ;
    }
    //同步回调
    public function re()
    {
    	echo 1;
    }
    //异步回调
    public function notify()
    {
    	echo 2;
    }
}
