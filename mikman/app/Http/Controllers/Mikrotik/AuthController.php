<?php

namespace App\Http\Controllers\Mikrotik;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function login(Request $request)
    {
       
        $ip = $request->post('ip');
        $user = $request->post('user');
        $password = $request->post('password');
        $cacheKey = 'login_' . $ip . '_' . $user;
        if (Cache::has($cacheKey)) {
            return redirect('dashboard');
        }
        $data = [
            'ip' => $ip,
            'user' => $user,
            'password' => $password,
        ];

        $request->session()->put($data);
        Cache::put($cacheKey, true, now()->addMinutes(1)); 

        return redirect('dashboard');
    }

    public function logout()
    {
        session()->flush();
        $ip = session('ip');
        $user = session('user');
        $cacheKey = 'login_' . $ip . '_' . $user;
        Cache::forget($cacheKey);

        return redirect('/')->with('logout', true);
    }
}
error_reporting(0);
