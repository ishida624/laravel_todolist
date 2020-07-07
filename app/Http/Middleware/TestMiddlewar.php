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
        // $token = $request ->input('userToken');
        // dd($cookie);
        // $user = Auth::user()->name;
        // $data = Admin::select('remember_token')->get();
        $data = Admin::where('remember_token', "=", $cookie)->get();
        // dd($data[0]->remember_token);
        foreach ($data as  $value) {
            if (isset($value->remember_token)) {
                return $next($request);
            } else {
                return redirect('LoginPage');
            }
        }
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
