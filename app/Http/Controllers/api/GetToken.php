<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Str;

class GetToken extends Controller
{
    public function register(Request $register)
    {
        $username = $register->username;
        $password = $register->passwd;
        $checkpassword = $register->checkpasswd;
        $admin = Admin::where('admin', $username)->first();
        // dd($admin);
        // foreach ($admin as $value) {
        if (isset($admin)) {
            // return response('帳號已存在', 400);
            return response()->json(['message' =>'bad request' , 'reason'=>'This account already exists'], 400);
        }
        // if ($sameUsername == 0) {
        if ($checkpassword === $password) {
            if (preg_match("/[0-9a-zA-Z]{8}/", $password)) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $admin = Admin::create(['admin'=>$username,'password'=>$hash,'remember_token' => 'new user']);
                // return '註冊成功';
                // return redirect()->back()->with('success', 'Register successflly');
                // return response('Regisered successfully', 201);
                return response()->json(['message' =>'Register successflly'], 201);
            } else {
                // return response('密碼必須八位元以上', 400);
                return response()->json(['message' =>'bad request' , 'reason'=>'Password must be more than eight digits'], 400);
            }
        } else {
            // return response('密碼錯誤', 400);
            return response()->json(['message' =>'bad request' , 'reason'=>'Password check false'], 400);
        }
        // }
    }
    public function login(Request $login)
    {
        $password = $login->passwd;
        $username = $login->username;
        // $admin = Admin::select('admin', 'password')->get();
        $dbUser = Admin::where('admin', $username)->first();
        // dd($checkUser);
        if (!$dbUser) {
            // return response('login false', 400);
            return response()->json(['message' =>'bad request' , 'reason'=>'username false'], 400);
        } else {
            $dbPassword = $dbUser->password;
        }
        // foreach ($admin as $value) {
        // if ($value['admin'] == $username) {
        if (password_verify($password, $dbPassword)) {
            // dd('Hello');
            // dd($token);
            do {                                #避免token重複
                // $token = rand(1, 3);
                $token = Str::random(15);
                $tokenCheck = Admin::where('remember_token', $token)->first();
                if (isset($tokenCheck)) {
                    $sameToken = true;
                } else {
                    $sameToken = false;
                }
            } while ($sameToken) ;

            // dd($token);
            Admin::where('admin', $username)->update(['remember_token' => $token]);
            // return redirect('todolist')->withcookie('userToken', $token)->with('success', 'Login successfully');
            // return redirect('todolist')->with('success', 'Login successfully')->header('userToken', $token);
            // return response('login successfully', 201)->header('userToken', $token);
            return response()->json(['message' =>'login successfully'], 201)->header('userToken', $token);
        } else {
            // return response('login false', 400);
            return response()->json(['message' =>'bad request' , 'reason'=>'password false'], 400);
        }
        // } else {
        //     $UsernameErr = 1;
        // }
        // }
        // if ($UsernameErr == 1) {
        //     return response('login false', 400);
        // }
    }
    // public function tokenCheck($token)
    // {
    //     $tokenCheck = Admin::where('remember_token', $token);
    //     if (isset($tokenCheck)) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
