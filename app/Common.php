<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Common extends Model{
    /*
     * @content 生成随机验证码
     * @params $len  int   需要生成验证码的长度
     * @return  $code  string  生成的验证码
     * */
    
    public static function createcode($len)
    {
        $code = '';
        for($i=1;$i<=$len;$i++){
            $code .=mt_rand(0,9);
        }

        return $code;
    }
}