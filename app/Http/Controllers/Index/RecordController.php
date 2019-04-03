<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    /** 
     * @潮沟详情
    */
    public function recorddetail(){
        return view('recorddetail');
    }
    /** 
     * @潮沟记录
    */
    public function buyrecord(){
        return view('buyrecord');
    }
}
