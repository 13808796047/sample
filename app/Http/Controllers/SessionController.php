<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //登录视图
    public function create()
    {
        return view('sessions.create');
    }
    //登录
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'email'=>'required|email|max:32',
            'password'=>'required',
        ]);
        if(Auth::attempt($data,$request->has('remember'))){
            //登录成功后的相关操作
            session()->flash('success','登录成功,欢迎回来!');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            //登录失败后的相关操作
            session()->flash('danger','你的邮箱或密码错误!');
            return redirect()->back();
        }
    }
    //退出登录
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','你已成功退出');
        return redirect('login');
    }
}
