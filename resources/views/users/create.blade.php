@extends('layouts.default')
@section('title','注册')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">注册</h3>
            </div>
            <div class="panel-body">
                @include('shared._errors')
                <form action="{{route('users.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">名称</label>
                        <input type="text" name="name"  class="form-control" placeholder="请输入用户名" value="{{old('name')}}">
                        <small id="helpId" class="text-muted">Help text</small>
                    </div>
                    <div class="form-group">
                        <label for="">邮箱</label>
                        <input type="email" class="form-control" name="email"  
                               placeholder="请输入邮箱" value="{{old('email')}}">
                        <small id="emailHelpId" class="form-text text-muted">Help text</small>
                    </div>
                    <div class="form-group">
                        <label for="">密码</label>
                        <input type="password" class="form-control" name="password"  placeholder="请输入密码">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">确认密码</label>
                        <input type="password" class="form-control" name="password_confirmation"  placeholder="再次输入密码">
                    </div>
                    <button type="submit" class="btn btn-primary">注册</button>
                </form>
            </div>
        </div>
    </div>
@stop