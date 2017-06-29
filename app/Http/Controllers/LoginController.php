<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Hash;
use DB;
class LoginController extends Controller
{   
    //登录验证
    public function postLogin(Request $request)
    {
       
        //验证码 或去session 中的验证码
        $code = session('code');
        //获取表单提交的验证码
        $code2 = $request -> input('code');

        //判断
        if($code != $code2){
            return back() -> with('error','验证码错误');
            exit;
        }

        //接受登录用户信息
        $data = $request -> except('_token','code');
        // dd($data);
        //查询用户
        $res = DB::table('users') -> where('username',$data['uname'])
                ->orwhere('email',$data['uname'])
                ->orwhere('phone',$data['uname']) -> first();
        // dd($res);
        //判断
        if(!$res){
            return back() -> with('error','用户不存在');
        }else{
            //检测密码
            //Hash验证密码
            if(Hash::check($data['upwd'],$res['password'])){
                session(['user'=>$res]);
                return redirect('/login/index');
            }else{
                return back() -> with('error','用户名或密码错误');
            }
        }

    }

    public function getIndex()
    {
        echo '登录成功';
    }
}
