<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //中间件控制只有登录才能操作的方法
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['show', 'create', 'store','index']
        ]);
        //只让未登录用户访问注册页面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        $users = User::paginate(5);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //用户注册
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:32',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        //注册成功，直接登录
        Auth::login($user);
        session()->flash('success', '欢迎,您将在这里开启新的旅程!');
        return redirect()->route('users.show', [$user]);
    }

    //编辑用户
    public function edit(User $user)
    {
        try {
            $this->authorize('update', $user);
        } catch (\Exception $e) {
            // return abort(403, '对不起，你无权访问此页面！');
            return redirect()->back();
        }

        return view('users.edit', compact('user'));
    }

    //更新用户
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:20',
            'password' => 'nullable|confirmed|min:6'
        ]);
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '资料更新成功');
        return redirect()->route('users.show', $user);
    }
    //删除用户
    public function destroy(User $user)
    {
        $this->authorize('destroy',$user);
        $user->delete();
        session()->flash('success','成功删除用户');
        return back();
    }
}
