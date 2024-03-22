<?php

namespace App\Http\Controllers\Mikrotik;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function show()
    {
        return view('admin/setting/ping');
    }
    public function ping(Request $request)
    {
        $request->validate([
            'dns' => 'required|string',
        ]);

        $dns = $request->input('dns');
        $nslookup_result = shell_exec("nslookup $dns");
        $ping_result = shell_exec("ping -c 4 $dns");
        return view('admin/setting/ping')->with([
            'ping_result' => $ping_result,
            'nslookup_result' => $nslookup_result,
        ]);
    }
    public function isolir()
    {
        return view('admin/setting/isolir');
    }
    public function reset()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug('false');

        if ($API->connect($ip, $user, $pass)) {
            $cacheKey = 'reset_' . $ip . '_' . $user;
            if (Cache::has($cacheKey)) {
                return redirect()->back()->with('error', 'Reset command has already been sent recently. Please wait before sending again.');
            }
            $resetCommand = '/system/reset-configuration';
            $resetResult = $API->comm($resetCommand);
            if ($resetResult) {
                Cache::put($cacheKey, true, now()->addMinutes(1));
                return redirect()->back()->with('success', 'Reboot command sent successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to send reboot command. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Failed to connect to MikroTik device. Please check your credentials and try again.');
        }
    }



    public function reboot()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug('false');

        if ($API->connect($ip, $user, $pass)) {
            $cacheKey = 'reboot_' . $ip . '_' . $user;
            if (Cache::has($cacheKey)) {
                return redirect()->back()->with('error', 'Reboot command has already been sent recently. Please wait before sending again.');
            }
            $rebootCommand = '/system/reboot';
            $rebootResult = $API->comm($rebootCommand);
            if ($rebootResult) {
                Cache::put($cacheKey, true, now()->addMinutes(1));
                return redirect()->back()->with('success', 'Reboot command sent successfully!');
            } else {
                return redirect()->back()->with('error', 'Failed to send reboot command. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Failed to connect to MikroTik device. Please check your credentials and try again.');
        }
    }
}
error_reporting(0);

