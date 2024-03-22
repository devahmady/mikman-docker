<?php

namespace App\Http\Controllers\Mikrotik;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InterfaceController extends Controller
{
    public function graf($interfaceName)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug('false');
        if ($API->connect($ip, $user, $pass)) {
            $monitoring = $API->comm('/interface/monitor-traffic', array(
                'interface' => $interfaceName,
                'once' => '',
            ));
        }
        $rows = array();
        $rows2 = array();
        $rx = $monitoring[0]['rx-bits-per-second'];
        $tx = $monitoring[0]['tx-bits-per-second'];
        $rows['name'] = 'Tx';
        $rows['data'][] = $tx;
        $rows2['name'] = 'Rx';
        $rows2['data'][] = $rx;

        $API->disconnect();

        $result = array();

        array_push($result, $rows);
        array_push($result, $rows2);

        return $result;
    }
    
    
}
error_reporting(0);

