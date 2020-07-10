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
        if (!$token) {
            return response('token is null', 400);
        }
        // dd($token);
        // $user = Auth::user()->name;
        // $data = Admin::select('remember_token')->get();
        $data = Admin::where('remember_token', $token)->first();
        // dd($data->remember_token);
        // foreach ($data as  $value) {
        if (isset($data->remember_token)) {
            // dd('hello');
            return $next($request);
        } else {
            // return 'token false';
            // return redirect('/todolist');
            return response('token false', 403);
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
