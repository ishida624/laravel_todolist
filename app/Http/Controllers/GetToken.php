<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Str;

class GetToken extends Controller
{
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
                    // return redirect()->back()->with('success', 'Register successflly');
                    return 'Regisered successfully';
                } else {
                    return '密碼至少八位元';
                }
            } else {
                return '密碼錯誤';
            }
        }
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
                    // return redirect('todolist')->withcookie('userToken', $token)->with('success', 'Login successfully');
                    // return redirect('todolist')->with('success', 'Login successfully')->header('userToken', $token);
                    return response('login successfully', 200)->header('userToken', $token);
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
}
