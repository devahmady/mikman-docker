<?php

namespace App\Http\Controllers\Mikrotik;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Routers\Dashboard;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function dashboard()
    {
        $data =  Dashboard::dashboard();
        if(isset($data['status']) && $data['status'] === 'error') {
            return response()->json($data, 201);
        } else {
            return view('admin.home', $data);
        }
    }

   

    
}
error_reporting(0);
