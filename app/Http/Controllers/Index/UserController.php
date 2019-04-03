<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Tools\Captcha;
use App\Common;
class UserController extends Controller
{
    /*
    * @用户个人信息
    * */
    public function User()
    {
        return view("index.user");
    }
    /*
    * @登陆
    * */
    public function Login()
    {
        return view("user.login");
    }
    /*
    * @登陆执行
    * */
    public function Logindo(Request $request)
    {
        $user_tel=$request->user_tel;

        $user_pwd=$request->user_pwd;

        $code=$request->code;
//       // echo $code;
        $verifycode=session('verifycode');
//        echo $verifycode;die;
        $user_model=new User();
        $arr=$user_model->where('user_tel','=',$user_tel)->first();

        $pwd=decrypt($arr['user_pwd']);
        if(empty($arr)){
            //用户不存在
            echo 1;
        }else if($code!=$verifycode){
            echo 4;
        }else if($user_pwd==$pwd){
        session(['user_id'=>$arr['user_id']]);
              echo 2;
          }else{
              echo 3;
          }
        }

    /*
    * @注册
    * */
    public function Register(Request $request)
    {

      return view("user.register");
    }
    public function Registerdo(Request $request)
    {


        $data=$request->all();
        //print_r($data);die;
        if($data['code']!=123456){
            echo 4;die;
        }
        $model=new user;
        $arr=$model::where('user_tel',$data['user_tel'])->count();
       // print_r($arr);die;
        if($arr){
          return 3;
        }else{
          unset($data["_token"]);
          unset($data["code"]);
          
          $data['user_pwd']=encrypt($data['user_pwd']);
          $res=$model::insert($data);
          print_r($res);die;
          if($res){
            echo "1";

          }else{
            echo "2";
          }
          
        }
        
    }
    public function dlicode(Request $request)
    {
        $user_tel=$request->user_tel;
        session(['user_tel'=>$user_tel]);
        $mobile=$request->mobile;
        $res= $this->sendmobile($user_tel);
        echo $res;
    }
    /*
     * @content 生成随机验证码
     * @params $len  int   需要生成验证码的长度
     * @return  $code  string  生成的验证码
     * */


    /*
     * @content 发送手机验证码
     * @params  $mobile  要发送的手机号
     *
     * */
    private function sendmobile($mobile)
    {

        $host = env("MOBILE_HOST");
        $path = env("MOBILE_PATH");
        $code = Common::createcode(4);
        session(['mobilecode'=>$code]);
        $method = "POST";
        $appcode = env("MOBILE_APPCODE");
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "content=【创信】你的验证码是：".$code."，3分钟内有效！&mobile=".$mobile;
        $bodys = "";
        $url = $host . $path . "?" . $querys;
       // return $url;
       $curl = curl_init();
       curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
       curl_setopt($curl, CURLOPT_URL, $url);
       curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($curl, CURLOPT_FAILONERROR, false);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($curl, CURLOPT_HEADER, true);
       if (1 == strpos("$".$host, "https://"))
       {
           curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
           curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
       }
       return curl_exec($curl);
    }

    /*
    * @找回密码
    * */
    public function Findpwd()
    {
        return view("user.findpwd");
    }
    /*
    * @重置密码
    * */
    public function Resetpassword()
    {
        return view("user.resetpassword");
    }
    //登录验证码
    public function create()
    {
        $verify = new Captcha();
        $code = $verify->getCode();
        //var_dump($code);
        session(['verifycode'=>$code]);
        return $verify->doimg();
    }
}