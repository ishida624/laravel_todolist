<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Admin;
use Illuminate\Support\Facades\Auth;

class TestMiddlewar
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
        $cookie = $request->cookie('userToken');
        // dd($cookie);
        // $user = Auth::user()->name;
        $data = Admin::select('remember_token')->get();
        // dd($data[1]->remember_token);
        foreach ($data as $value) {
            if ($value->remember_token == $cookie) {
                // $tokenAuth = 1;
                // echo  $tokenAuth;
                return $next($request);
            // return 'hello';
            }
            // abort(403);
            else {
                // echo "hello";
                // return route('LoginPage');
                $tokenAuth = 0;
                // return redirect('LoginPage');
            }
            // return 'world';
        }
        // dd($tokenAuth);
        if ($tokenAuth == 0) {
            return redirect('LoginPage');
        }
        // if ($token == $remember_token) {
        //     return $next($request);
        // } else {
        //     return response("token false", 405);
        // }
    }
}
