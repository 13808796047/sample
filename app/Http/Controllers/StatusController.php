<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //当前登录用户创建微博
    public function store(Request $request)
    {

        $this->validate($request, [
            'content' => 'required|max:140'
        ]);
        Auth::user()->statuses()->create([
            'content' => $request['content']
        ]);
        return redirect()->back();

    }

    //当前登录用户删除自己微博
    public function destroy(Status $status)
    {
        $this->authorize('destroy', $status);
        $status->delete();
        session()->flash('success', '微博删除成功');
        return redirect()->back();
    }
}
