<?php

namespace App\Routers;

use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Pppoe
{
    public static function show()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $interface = $API->comm('/interface/print');
            $pprofile = $API->comm('/ppp/profile/print');
            $server = $API->comm('/interface/pppoe-server/server/print');
            $data = [
                'interface' => $interface,
                'server' => $server,
                'pprofile' => $pprofile,
            ];
        } else {
            return 'koneksi gagal';
        }

        return $data;
    }

    public static function addserver(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $service = $request->input('service');
            $name = $request->input('name');
            $mikid = $request->input('mikid');
            if (empty($mikid)) {
                $API->comm('/interface/pppoe-server/server/add', [
                    'service-name' =>  $service,
                    'interface' =>  $name,
                    "disabled" => "no",
                    "keepalive-timeout" => 10,
                    "default-profile" => "default",
                ]);
            } else {
                $API->comm('/interface/pppoe-server/server/set', [
                    '.id' => $mikid,
                    'service-name' =>  $service,
                    'interface' =>  $name,
                    "disabled" => "no",
                    "keepalive-timeout" => 10,
                    "default-profile" => "default",
                ]);
            }
            Alert::success('Hore!', 'Add Server Pppoe Sucsess')->persistent(true);
        } else {
            Alert::error('Oops!', 'Error.')->persistent(true);
            return 'koneksi gagal';
        }
        return redirect()->route('pppoe.server');
    }

    public static function delserver($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/interface/pppoe-server/server/remove', [
                '.id' => $id, // Menggunakan ID profil sebagai parameter untuk menghapus
            ]);
        }
        Alert::success('Yes!', 'delete sever sucsess')->persistent(true);

        $API->disconnect();
    }

    public static function profile()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $pprofile = $API->comm('/ppp/profile/print');
            $pool = $API->comm('/ip/pool/print');
            $parent = $API->comm('/queue/simple/print');
            // $filteredProfiles = array_filter($pprofile, function ($profile) {
            //     return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            // });
            $profileDetails = [];
            foreach ($pprofile as $prof) {
                $uprofname = $prof['name'];
                $getprofile = $API->comm("/ppp/profile/print", array("?name" => "$uprofname"));
                if (!empty($getprofile)) {
                    $profiledetalis = $getprofile[0];
                    $profileDetails[] = [
                        'validity' => explode(",", $profiledetalis['on-up'])[2],
                        'isolirmode' => explode(",", $profiledetalis['on-up'])[1],
                    ];
                }
            }
            $data = [
                'pool' => $pool,
                'parent' => $parent,
                'profile' => $pprofile,
                'detail' => $profileDetails
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function addProfile($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $name = $request->input('name');
            $local = $request->input('local');
            $remote = $request->input('remote');
            $parentqq = $request->input('parentqq');
            $ratelimit = $request->input('ratelimit');
            $isolirmode = $request->input('isolirmode');
            $validity = $request->input('validity');
            $randstarttime = now()->setTime(rand(1, 5), rand(10, 59), rand(10, 59))->format('H:i:s');
            $randinterval = now()->setTime(0, 1, rand(10, 59))->format('H:i:s');


            $onlogin = ':put (",' . $isolirmode . ',' . $validity . ',");{:local date [ /system clock get date ];:local year [ :pick $date 7 11 ];:local month [ :pick $date 0 3 ];:local comment [ /ppp secret get [ /ppp secret find where name="$user" ] comment]; :local ucode [:pick $comment 0 5]; :local komen [:pick $comment 6 100];:if ($ucode = "lunas") do={ /sys scheduler add name="$user" disabled=no start-date=$date interval="' . $validity . '"; :delay 2s; :local exp [ /sys scheduler get [ /sys scheduler find where name="$user" ] next-run]; :local getxp [len $exp]; :if ($getxp = 15) do={ :local d [:pick $exp 0 6]; :local t [:pick $exp 7 16]; :local s "/"; :local exp ("$d$s$year $t"); /ppp secret set comment="$exp | $komen" [find where name="$user"];}; :if ($getxp = 8) do={ /ppp secret set comment="$date $exp | $komen" [find where name="$user"];}; :if ($getxp > 15) do={ /ppp secret set comment="$exp | $komen" [find where name="$user"];}; /sys scheduler remove [find where name="$user"]; }}';

            if ($isolirmode == "isolir") {
                $onlogin = $onlogin . "}}";
            } elseif ($isolirmode == "downgrade") {
                $onlogin = $onlogin . "}}";
            } else {
                $onlogin = "";
            }

            if ($isolirmode == "isolir") {
                $onup = ':local dateint do={ :local montharray ( "jan","feb","mar","apr","may","jun","jul","aug","sep","oct","nov","dec" );:local days [ :pick $d 4 6 ];:local month [ :pick $d 0 3 ];:local year [ :pick $d 7 11 ];:local monthint ([ :find $montharray $month]);:local month ($monthint + 1);:if ( [len $month] = 1) do={:local zero ("0");:return [:tonum ("$year$zero$month$days")];} else={:return [:tonum ("$year$month$days")];}}; :local timeint do={ :local hours [ :pick $t 0 2 ]; :local minutes [ :pick $t 3 5 ]; :return ($hours * 60 + $minutes);}; :local date [ /system clock get date ]; :local time [ /system clock get time ]; :local today [$dateint d=$date]; :local curtime [$timeint t=$time]; :foreach i in=[/ppp secret find where disabled=no] do={ delay delay-time=10ms; :local comment [/ppp secret get $i comment]; :local nama [/ppp secret get $i name]; :local gettime [:pic $comment 12 20];:local ipisolir "0"; :set ipisolir [/ppp secret get $i remote-address]; :local profiles [/ppp secret get $i profile];:if ( [len $ipisolir] > 3) do={:if ([:pic $comment 0 6] = "isolir") do={  :if ( [/ip firewall address-list find where address=$ipisolir list=clientisolir] = "") do={ /ip firewall address-list add list=clientisolir address=$ipisolir; }; /ppp secret set $i comment="BELUM BAYAR | pelanggan: $profiles "; }; :if ([:pic $comment 0 5]~"lunas") do={ /ip firewall address-list remove [find where address=$ipisolir]; /ip proxy access remove [find where src-address="$ipisolir"]; /ppp active remove [find where name=$nama]; }; :if ([:pic $comment 3] = "/" and [:pic $comment 6] = "/") do={ do { :local expd [$dateint d=$comment]; :local expt [$timeint t=$gettime];  :if (($expd < $today and $expt < $curtime) or ($expd < $today and $expt > $curtime) or ($expd = $today and $expt < $curtime)) do={  /ip firewall address-list add list=clientisolir address=$ipisolir; /ppp secret set $i comment="BELUM BAYAR | pelanggan: $profiles ";}} }} else={ :if ([:pic $comment 0 6] = "isolir") do={ /ppp secret set $i profile=isolir ;/ppp active remove [find where name=$nama] ;   /ppp secret set $i comment="BELUM BAYAR | pelanggan: $profiles " ;}; :if ([:pic $comment 0 5] = "lunas") do={ /ppp active remove [find where name=$nama] ; };:if ([:pic $comment 3] = "/" and [:pic $comment 6] = "/") do={ do {:local expd [$dateint d=$comment]; :local expt [$timeint t=$gettime]; :if (($expd < $today and $expt < $curtime) or ($expd < $today and $expt > $curtime) or ($expd = $today and $expt < $curtime)) do={ /ppp secret set $i profile=isolir ; /ppp active remove [find where name=$nama] ;  /ppp secret set $i comment="BELUM BAYAR | pelanggan: $profiles " ; }} }}}';
            } elseif ($isolirmode == "downgrade") {
                $onup = ':local day [:pick [/system clock get date] 4 6]; :if (day = "' . $validity . '") do={:local userppp; foreach v in=[/ppp secret find comment="DOWNGRADE"] do={:set userppp ( userppp [/ppp secret get $v name]);/ppp active remove [find name=$userppp];/ppp secret set profile="PAKET DOWNGRADE" [find name=$userppp]; }}';
            } else {
                $onup = "";
            }

            $API->comm('/ppp/profile/add', [
                'name' =>  $name,
                "local-address" => $local,
                "remote-address" => $remote,
                "parent-queue" => $parentqq,
                "rate-limit" => $ratelimit,
                "on-up" => $onlogin,
                "only-one" => "yes",
            ]);

            $mikid = $request->input('mikid');

            if ($isolirmode != "0") {
                if (empty($mikid)) {
                    $API->comm("/system/scheduler/add", [
                        "name" => $name,
                        "start-time" => $randstarttime,
                        "interval" => $randinterval,
                        "on-event" => $onup,
                        "disabled" => "no",
                        "comment" => "Monitoring Pelanggan PPPoE $name",
                    ]);
                } else {
                    $API->comm("/system/scheduler/set", [
                        ".id" => $mikid,
                        "name" => $name,
                        "start-time" => $randstarttime,
                        "interval" => $randinterval,
                        "on-event" => $onup,
                        "disabled" => "no",
                        "comment" => "Monitoring Pelanggan PPPoE $name",
                    ]);
                }
            }

            $API->disconnect();
            Alert::success('Hore!', 'Add Profile Pppoe Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }

    public static function dellprofile($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ppp/profile/remove', [
                '.id' => $id, // Menggunakan ID profil sebagai parameter untuk menghapus
            ]);
            $API->disconnect();
            Alert::success('Hore!', 'Delete Profile Pppoe Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }

    public static function secret()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            // Ambil informasi secret PPP
            $secret = $API->comm('/ppp/secret/print');
            // Filter secret PPPoE untuk pengguna yang bukan menggunakan profil "ISOLIR"
            $filteredSecrets = array_filter($secret, function ($s) {
                return $s['profile'] !== 'isolir' && $s['profile'] !== 'PAKET DOWNGRADE';
            });
            $pprofile = $API->comm('/ppp/profile/print');
            // $filteredProfiles = array_filter($pprofile, function ($profile) {
            //     return $profile['name'] !== 'default' && $profile['name'] !== 'default-encryption';
            // });

            // Data yang diperoleh
            $data = [
                'secret' => $filteredSecrets,
                'profile' => $pprofile,
            ];
        } else {
            $data = 'Koneksi gagal';
        }

        $API->disconnect();
        return $data;
    }

    public static function isolir()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $secret = $API->comm('/ppp/secret/print');
            $profile = $API->comm('/ppp/profile/print');
            $isolirSecrets = array_filter($secret, function ($s) {
                return $s['profile'] === 'isolir' || $s['profile'] === 'PAKET DOWNGRADE';
            });

            // Data yang diperoleh
            $data = [
                'secret' => $isolirSecrets,
                'profile' => $profile,
            ];
        } else {
            $data = 'Koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }
    public static function addsecret($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $comment = $request->input('comment');
            $name = $request->input('name');
            $pass = $request->input('pass');
            $profile = $request->input('profilee');
            $service = $request->input('servicee');
            $data = [];
            if ($request->filled('local')) {
                $data["local-address"] = $request->input('local');
            }
            if ($request->filled('remote')) {
                $data["remote-address"] = $request->input('remote');
            }
            $API->comm('/ppp/secret/add', [
                'name' =>  $name,
                'password' =>  $pass,
                'profile' => $profile,
                'service' => $service,
                'comment' => $comment,
            ] + $data);
            $API->disconnect();
            Alert::success('Hore!', 'add Secret Pppoe Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }

    public static function showUpdate($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $getuser = $API->comm('/ppp/secret/print', [
				"?.id" => '*' . $id,
			]);
            $secret = $API->comm('/ppp/secret/print');
			$profile = $API->comm('/ppp/profile/print');
            $data = [
				'user' => $getuser[0],
				'secret' => $secret,
				'profile' => $profile,
			];
        } else {
            $data = 'Koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function updateSecret(Request $request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $id = $request->input('id');
            $comment = $request->input('comment');
            $name = $request->input('name');
            $pass = $request->input('pass');
            $profile = $request->input('profilee');
            $service = $request->input('servicee');
            $data = [];
            if ($request->filled('local')) {
                $data["local-address"] = $request->input('local');
            }
            if ($request->filled('remote')) {
                $data["remote-address"] = $request->input('remote');
            }
            $API->comm("/ppp/secret/set", [
                ".id" => $id,
                'name' =>  $name,
                'password' =>  $pass,
                'profile' => $profile,
                'service' => $service,
                'comment' => $comment,
            ] +$data);
            $API->disconnect();
            Alert::success('Hore!', 'Update Secret Pppoe Success')->persistent(true);
            return true;
        } else {
            return false;
        }
    }

    public static function dellsecret($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ppp/secret/remove', [
                '.id' => $id,
            ]);
            $API->disconnect();
            Alert::success('Hore!', 'Delete Secret Pppoe Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }

    public static function active()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $active = $API->comm('/ppp/active/print');
            $data = [
                'active' => $active,
            ];
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    public static function dellactive($id)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            $API->comm('/ppp/active/remove', [
                '.id' => $id,
            ]);
            $API->disconnect();
            Alert::success('Hore!', 'Delete User Pppoe Sucsess')->persistent(true);
            return true;
        } else {
            return false;
        }
    }
    public static function toggleSecret($request)
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;

        if ($API->connect($ip, $user, $password)) {
            foreach ($request->input('secret_ids', []) as $id) {
                $action = $request->input('action');
                if ($action === 'enable') {
                    $API->comm("/ppp/secret/enable", [
                        ".id" => $id,
                    ]);
                    // Ambil status baru dan kirimkan kembali ke view
                    $status = $API->comm("/ppp/secret/print", ["?id" => $id])[0]['disabled'] == 'false' ? 'active' : 'inactive';
                } elseif ($action === 'disable') {
                    $API->comm("/ppp/secret/disable", [
                        ".id" => $id,
                    ]);
                    // Ambil status baru dan kirimkan kembali ke view
                    $status = $API->comm("/ppp/secret/print", ["?id" => $id])[0]['disabled'] == 'false' ? 'active' : 'inactive';
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public static function list()
    {
        $ip = session()->get('ip');
        $user = session()->get('user');
        $password = session()->get('password');
        $API = new MikrotikApi();
        $API->debug = false;
        if ($API->connect($ip, $user, $password)) {
            $list = $API->comm('/ip/firewall/address-list/print');
            $filteredProfiles = array_filter($list, function ($profile) {
                return $profile['list'] === 'portal' || $profile['list'] === 'pelanggan';
            });

            $data = [
                'list' => $filteredProfiles,
            ];
            // dd($data);
        } else {
            $data = 'koneksi gagal';
        }
        $API->disconnect();
        return $data;
    }

    // public static function listadd(Request $request)
    // {
    //     $ip = session()->get('ip');
    //     $user = session()->get('user');
    //     $password = session()->get('password');
    //     $API = new MikrotikApi();
    //     $API->debug = false;
    //     if ($API->connect($ip, $user, $password)) {
    //         $lis = $request->input('lis');
    //         $adr = $request->input('adr');
    //         $creationTime = now()->format('M/d/Y H:i:s'); 
    //         $monid = $request->input('monid');
    //         if (empty($monid)) {
    //             $API->comm('/ip/firewall/address-list/add', [
    //                 'list' =>  $lis,
    //                 'address' =>  $adr,
    //                 "disabled" => "no",
    //                 "creation-time" => $creationTime,
    //             ]);
    //         } else {
    //             $API->comm('/ip/firewall/address-list/set', [
    //                 '.id' => $monid,
    //                 'list' =>  $lis,
    //                 'address' =>  $adr,
    //                 "dynamic" => "false",
    //                 "disabled" => "no",
    //                 "creation-time" => $creationTime,
    //             ]);
    //         }
    //         Alert::success('Hore!', 'Add Server client static Sucsess')->persistent(true);
    //     } else {
    //         Alert::error('Oops!', 'Error.')->persistent(true);
    //         return 'koneksi gagal';
    //     }
    //     return redirect()->route('list.address');
    // }
}
error_reporting(0);
