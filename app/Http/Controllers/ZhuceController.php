<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Hash;
use Mail;
use App\Http\Controllers\HttpController;

class ZhuceController extends Controller
{
    //注册页面
    public function getAdd()
    {
        return view('zhuce');
    }
    //邮箱注册保存
    public function postInsert(Request $request)
    {
        //自动验证
        $this -> validate($request,[
                //必填
                'email'=>'required|email',
                'password'=>'required',
                'repassword'=>'required|same:password',
            ],[
                //判断并返回信息
                'email.required'=>'邮箱必填',
                'password.required'=>'密码必填',
                'repassword.required'=>'确认密码必填',
                'repassword.same'=>'密码不一致必填',
                'email.email'=>'邮箱格式不正确'
            ]);

        //接受用户注册的值
        $data = $request -> except('_token','repassword');
        $data['password'] = hash::make($data['password']);
        $data['ctime'] = time();
        $data['token'] = str_random(50);
        // dd($data);
        //执行保存
        $id = DB::table('users') -> insertGetId($data);
        if($id){
             self::mailto($data['email'],$id,$data['token']);
             return view('email');
        }
    }

    //邮箱的执行
    public static function mailto($email,$id,$token)
    {
        Mail::send('index',['id'=>$id,'token'=>$token,'email'=>$email],function($m)
            use ($email){
                $m ->to($email)->subject('账号激活邮件');
            });
    }

     //账号激活
    public function getJihuo(Request $request)
    {
        
        //接受数据
        $arr = $request -> all();
        //token
        $token = DB::table('users')->where('id',$arr['id'])->select('token')->first();
        //判断 token
        if($arr['token'] == $token['token'] ){
            $res = DB::table('users')->where('id',$arr['id'])->update(['status'=>1,'token'=>str_random(50)]);
            if($res){
                echo '激活成功';
                return redirect('/')->with('assuc','激活成功');
            }else{
                echo '激活失败';
            }
        }else{
            return redirect('/zhuce/add')->with('error','验证失败,请注册');
        }

     }

     //手机注册
     public function postInsert2(Request $request)
     {
         //自动验证
        $this -> validate($request,[
                //必填
                'phone'=>'required',
                'phone'=>'regex:/^1[34578][0-9]{9}$/',
                'password'=>'required',
                'repassword'=>'required|same:password',
            ],[
                //判断并返回信息
                'phone.required'=>'手机号必填',
                'phone.regex'=>'手机号格式不正确',
                'password.required'=>'密码必填',
                'repassword.required'=>'确认密码必填',
                'repassword.same'=>'密码不一致必填',
            ]);
        //接受验证码
        $phone_code = $request -> input('phone_code');

        //判断验证码
        if($phone_code != session('phone_code')){
            return redirect('/zhuce/add')->with('error','验证码错误');
        }

        //接受数据
        $data = $request -> except('_token','phone_code','repassword');
        $data['password'] = Hash::make($data['password']);
        $data['ctime'] = time();
        $data['token'] = str_random(50);

        //执行保存
        $id = DB::table('users') -> insert($data);
        if($id){
            return redirect('/')->with('assuc','注册成功');
        }else{
            return redirect('/zhuce/add')->with('error','注册失败');
        }
       
     }

     //使用ajax获取验证码
     public function getPhone(Request $request)
     {  
        $phone = $request -> input('phone');
        $res = self::phoneto($phone);
        echo $res;
     }

      //手机验证码
    public static function phoneto($phone)
    {   
        // echo $phone;die;

        //验证码的随机数
        $phone_code = rand(1000,9999);
        // echo $phone_code;die;
        //存入session
        session(['phone_code'=>$phone_code]);
        //执行发送
        $str = 'http://106.ihuyi.com/webservice/sms.php?method=Submit&account=C59933801&password=0808facc111416683d2ea903f063ef5a&format=json&mobile='.$phone.'&content=您的验证码是：'.$phone_code.'。请不要把验证码泄露给其他人。';
        //返回值
        $res = HttpController::get($str);
        return $res;
    } 
}
