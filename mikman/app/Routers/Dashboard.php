<?php

namespace App\Routers;
use App\Models\MikrotikApi;
class Dashboard
{
    public static function dashboard()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $pass = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $pass)) {
            $users = $API->comm('/user/print');
            $clock = $API->comm('/system/clock/print');
            $sys = $API->comm('/system/resource/print');
            $model = $API->comm('/system/routerboard/print');
            $ether1 = $API->comm("/interface/print");
            $ppp_active = $API->comm("/ppp/active/print");
            $ppp_user = $API->comm("/ppp/secret/print");
            $hotspot_user = $API->comm("/ip/hotspot/user/print");
            $hotspot_active = $API->comm("/ip/hotspot/active/print");
            $monitoring = $API->comm('/interface/monitor-traffic', array(
                'interface' => 'ether1',
                'once' => '',
            ));
            ini_set('max_execution_time', 120);

            $iphotspot = [];
            $loghs = $API->comm("/log/print", array(
                "?topics" => "hotspot,info,debug"
            ));

            // Check if logs were fetched successfully
            if ($loghs === false) {
                // Handle error (e.g., log error, display message)
                echo "Error fetching logs from API.";
                exit; // Exit script or handle error appropriately
            }

            // Process logs
            foreach ($loghs as &$log) {
                // Split log message into IP Address and message parts
                $messageParts = explode('(', $log['message'], 2);
                if (count($messageParts) === 2) {
                    $log['iphotspot'] = trim(str_replace(')', '', $messageParts[0]));
                    $log['message'] = trim($messageParts[1]);
                } else {
                    $log['iphotspot'] = '';
                    $log['message'] = trim($log['message']); // Ensure message is trimmed
                }
            }
            $userpppp = [];
            $logsppp = $API->comm("/log/print", array(
                "?topics" => "pppoe,ppp,info"
            ));
            foreach ($logsppp as &$ppp) {
                // Memisahkan pesan ppp menjadi IP Address dan pesan
                $messageParts = explode(':', $ppp['message'], 2);
                if (count($messageParts) === 2) {
                    $ppp['userpppp'] = trim($messageParts[0]);
                    $ppp['message'] = trim($messageParts[1]);
                } else {
                    $ppp['userpppp'] = '';
                    $ppp['message'] = $ppp['message'];
                }
            }

            // Membalikkan urutan log
            $logsppp = array_reverse($logsppp);
            // Reverse log array (if needed) - moved outside the loop
            $loghs = array_reverse($loghs);
            $data = [
                // monitor interface
                'rx' => $monitoring[0]['rx-bits-per-second'],
                'tx' => $monitoring[0]['tx-bits-per-second'],
                // users
                'name' => $users[0]['name'],
                'when' => $users[0]['last-logged-in'],
                // resource
                'cpu_load' => $sys[0]['cpu-load'],
                'uptime' => $sys[0]['uptime'],
                'platform' => $sys[0]['platform'],
                'version' => $sys[0]['version'],
                'free_memory' => $sys[0]['free-memory'],
                'free_hdd' => $sys[0]['free-hdd-space'],
                'total_hdd' => $sys[0]['total-hdd-space'],
                'frequency' => $sys[0]['cpu-frequency'],
                // routerboard
                'model' => $model[0]['model'],
                // clock
                'date' => $clock[0]['date'],
                'time' => $clock[0]['time'],
                'zone' => $clock[0]['time-zone-name'],
                // interface
                'ether1' => $ether1,
                // log hotspot
                'loghs' => $loghs,
                'iphotspot' => $iphotspot,
                // log pppoe
                'logppp' => $logsppp,
                // Active Users
                "ppp_active" => count($ppp_active),
                "ppp_user" => count($ppp_user),
                "hotspot_user" => count($hotspot_user),
                "hotspot_active" => count($hotspot_active),
            ];
            $API->disconnect();
            return $data;
        } else {
            return ['status' => 'error', 'message' => 'koneksi gagal'];
        }
    }
}
error_reporting(0);
