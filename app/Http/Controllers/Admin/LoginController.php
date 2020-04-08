<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Org\code\Code;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Model\User;

class LoginController extends Controller
{
    //后台登录页
    public function login(){
        return view('admin.login');
    }

    public function code(){
        $code = new Code();
        return $code->make();
    }

    public function doLogin(Request $request){
        //1.接收表单提交的数据
        $input = $request->except('_token');
        //2.进行表单验证
        $rule = [
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18|alpha_dash',

        ];
        $validator = Validator::make($input,$rule);
        if ($validator->fails()) {
            return redirect('admin/login')
                ->withErrors($validator)
                ->withInput();
        }


         //3.验证是否由此用户（用户名 密码 验证码）
        if ($input['code'] != session()->get('code')){
            return redirect('admin/login')->with('errors','验证码错误');
        }
        $user = User::where('user_name',$input['username'])->first();
        if (!$user){
            return redirect('admin/login')->with('errors','用户名不存在');
        }

        if ($input['password'] != Crypt::decrypt($user->user_pass)){
            return redirect('admin/login')->with('errors','密码不正确');
        }



        //4.保存用户信息到session中
        session()->put('user',$user);

        //5.跳转到后台首页
        return redirect('admin/index');
    }

    //加密算法
    public function jiami()
    {
//        1.md5加密算法
//        $str = 'salt'.'123456';
//        return md5($str);
//        2.哈希加密
//        $str = '123456';
//        $hash = Hash::make($str);
//        if (Hash::check($str,$hash)){
//            return '密码正确';
//        }else{
//            return '密码错误';
//    }
//        3.crypt加密
        $str = '123456';
        $crypt_str = 'eyJpdiI6IjZBdUwySFV2N0tvNmlnUDZoa1d3MWc9PSIsInZhbHVlIjoidUU0TEE1aDR1QktHTExock54a0VlQT09IiwibWFjIjoiMTBiY2RiMTA3MThlNWNjM2IwODVkZjQ4MTY5ZTY3N2QxZDQ1ZGJhNDA0NWNiYzFiYTBiZTE4N2I4ODk5ZDRmYyJ9';
//        $crypt_str = 'Crypt::encrypt($str)';
//        return $crypt_str;
        if (Crypt::decrypt($crypt_str) == $str){
            return '密码正确';
        }
    }
}
