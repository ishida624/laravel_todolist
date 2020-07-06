<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\T1;
use App\Admin;
use Illuminate\Support\Str;

class Todocontroller extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('tokenAuth')->except('readTable', 'login');
    // }
    public function readTable()
    {
        $data = T1::all();
        return  view('todo_index', ['data' =>$data]);
    }

    public function update(Request $update)
    {
        $userToken = $update->cookie('userToken');
        $user = Admin::where('remember_token', "$userToken")->first('admin')->admin;
        $id = $update->input('no');
        $item = $update->input('item');
        T1::find($id)->update(['item'=>"$item",'update_user'=>'admin','update_user'=>$user]);
        //return redirect()->back()->with('message', 'please login');
        //return 'please login';
        return redirect('todolist');
        // return $update;
    }
    public function delete(Request $delete)
    {
        $id = $delete->input('id');
        T1::find($id)->delete();
        return redirect('todolist');
        // return $delete;
    }
    public function create(Request $create)
    {
        $userToken = $create->cookie('userToken');
        $user = Admin::where('remember_token', "$userToken")->first('admin')->admin;
        $item = $create->input('item');
        T1::create(['item'=>"$item",'status'=>'未完成','update_user'=>'admin','update_user'=>$user]);
        return redirect('todolist');
    }
    public function complete(Request $complete)
    {
        $userToken = $complete->cookie('userToken');
        $user = Admin::where('remember_token', "$userToken")->first('admin')->admin;
        // dd($user->admin);
        // $user = Auth::user()->name;
        $id = $complete->input('id');
        $data = T1::find($id);
        $status = $data->status;
        if ($status == '未完成') {
            $data->update(['status'=>'已完成','update_user'=>$user]);
        } else {
            $data->update(['status'=>'未完成','update_user'=>$user]);
        }
        return redirect('todolist');

        // $value = $complete->cookie('userToken');
        // return $value;
    }
    public function login(Request $login)
    {
        $password = $login->input('passwd');
        $username = $login->input('username');
        $admin = Admin::select('admin', 'password')->get();
        // dd($username);
        foreach ($admin as $value) {
            if ($value['admin'] == $username) {
                if (password_verify($password, $value['password'])) {
                    $token = Str::random(15);
                    Admin::where('admin', $value['admin'])->update(['remember_token' => $token]);
                    return redirect('todolist')->withcookie('userToken', $token)->with('success', 'Login successfully');
                // return redirect()->back()->with('success', 'Register successflly');
                } else {
                    return '密碼錯誤';
                }
            } else {
                $UsernameErr = 1;
            }
        }
        if ($UsernameErr == 1) {
            return '帳號錯誤';
        }
    }
    public function register(Request $register)
    {
        $username = $register->input('username');
        $password = $register->input('passwd');
        $checkpassword = $register->input('checkpasswd');
        $admin = Admin::select('admin')->get();
        // dd($admin[1]);
        foreach ($admin as $value) {
            // echo $value;
            if ($username == $value->admin) {
                return '此帳號已存在';
            } else {
                $sameUsername = 0;
                // return 'hello';
            }
        }
        if ($sameUsername == 0) {
            if ($checkpassword == $password) {
                if (preg_match("/[0-9a-zA-Z]{8}/", $password)) {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $admin = Admin::create(['admin'=>$username,'password'=>$hash]);
                    // return '註冊成功';
                    return redirect()->back()->with('success', 'Register successflly');
                } else {
                    return '密碼至少八位元';
                }
            } else {
                return '密碼錯誤';
            }
        }
    }
}
