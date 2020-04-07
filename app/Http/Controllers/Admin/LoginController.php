<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Org\code\Code;
use Illuminate\Support\Facades\Validator;

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

    }
    //3.验证是否由此用户（用户名 密码 验证码）




    //4.保存用户信息到session中




    //5.跳转到后台首页
}
