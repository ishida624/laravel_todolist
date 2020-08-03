<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class TokenMiddlewar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd($request->method());
        // dd($request->ip());
        // if ($request->method() === 'DELETE') {
        //     return response("Get out here with delete method", 405);
        // }
        // $response = $next($request);
        // $response->cookie('visited-our-site', true);
        // return $response;
        //$token = $request->input('_token');
        // $cookie = $request->cookie('userToken');
        // $token = $request->input('userToken');
        $token = $request->header('userToken');
        // if (!$token) {
        //     // return response('token is null', 401);
        //     return response()->json(['message' =>'Unauthorized' , 'reason'=>'token false' ], 401);
        // }
        // dd($token);
        // $user = Auth::user()->name;
        // $data = Admin::select('remember_token')->get();
        $data = Admin::where('remember_token', $token)->first();
        // dd(strtotime($data->login_time), time());
        $tokenTime = date('Y-m-d H:i:s', strtotime('+1 day', strtotime($data->login_time)));
        // $tokenTime = date('Y-m-d H:i:s', strtotime('+1 day', $tokenTime));
        // dd($tokenTime, date('Y-m-d H:i:s'));
        if ($tokenTime < date('Y-m-d H:i:s')) {
            return response()->json(['message' =>'Unauthorized' , 'reason'=>'token out time' ], 401);
        }
        // dd($data->remember_token);
        // foreach ($data as  $value) {
        if (isset($data->remember_token)) {
            // dd('hello');
            return $next($request);
        } else {
            // return 'token false';
            // return redirect('/todolist');
            // return response('token false', 403);
            return response()->json(['message' =>'Unauthorized' , 'reason'=>'token false' ], 401);
        }
        // }
        // foreach ($data as $value) {
        //     // echo "$value";
        //     if ($value->remember_token == $cookie) {
        //         // echo "Hello";
        //         return $next($request);
        //     } else {
        //         $tokenAuth = 0;
        //     }
        // }
        // if ($tokenAuth == 0) {
        //     return redirect('LoginPage');
        // }
    }
}
