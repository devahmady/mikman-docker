<?php

namespace App\Http\Controllers\Mikrotik;

use App\Routers\Pppoe;
use App\Models\MikrotikApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PPPoEController extends Controller
{
  public function show()
  {
    $data = Pppoe::show();
    return view('admin/pppoe/addserv', $data);
  }

  public function addServer(Request $request)
  {
    if (Pppoe::addServer($request)) {
      return redirect()->route('pppoe.server');
    } else {
      return 'Gagal menambahkan server PPPoE.';
    }
  }

  public function delserver($id)
  {
    Pppoe::delserver($id);
    return redirect()->route('pppoe.server');
  }

  public function profile()
  {
    $data = Pppoe::profile();
    if (is_string($data)) {
      return $data;
    } else {
      return view('admin/pppoe/profile', $data);
    }
  }

  public function addProfile(Request $request)
  {
    if (Pppoe::addProfile($request)) {
      return redirect()->route('pppoe.profile');
    } else {
      return 'Gagal menambahkan profil PPPoE.';
    }
  }

  public function dellprofile($id)
  {
    if (Pppoe::dellprofile($id)) {
      return redirect()->route('pppoe.profile');
    } else {
      return 'Gagal menghapus profil PPPoE.';
    }
  }
  public function secret()
  {
    $data = Pppoe::secret();
    if (is_string($data)) {
      return $data;
    } else {
      return view('admin/pppoe/secret', $data);
    }
  }
  public function addsecret(Request $request)
  {
    if (Pppoe::addsecret($request)) {
      return redirect()->route('secret.pppoe');
    } else {
      return 'Gagal menambahkan secret PPPoE.';
    }
  }
  public function updateSecret(Request $request)
  {
    if (Pppoe::updateSecret($request)) {
      return redirect()->route('secret.pppoe');
    } else {
      return 'Gagal menambahkan secret PPPoE.';
    }
  }

  public function dellsecret($id)
  {
    if (Pppoe::dellsecret($id)) {
      return redirect()->route('secret.pppoe');
    } else {
      return 'Gagal menghapus secret PPPoE.';
    }
  }

  public function active()
  {
    $data = Pppoe::active();
    if (is_string($data)) {
      return $data;
    } else {
      return view('admin/pppoe/active', $data);
    }
  }

  public function list()
  {
    $data = Pppoe::list();
    if (is_string($data)) {
      return $data;
    } else {
      return view('admin/pppoe/list', $data);
    }
  }
  // public function listadd(Request $request)
  // {
  //   if (Pppoe::listadd($request)) {
  //     return redirect()->route('list.address');
  //   } else {
  //     return 'Gagal menambahkan secret PPPoE.';
  //   }
  // }
  public function dellactive($id)
  {
    if (Pppoe::dellactive($id)) {
      return redirect()->route('active.pppoe');
    } else {
      return 'Gagal menghapus PPPoE active.';
    }
  }
  public function toggleSecret(Request $request)
  {
    // Panggil metode dari helper
    $success = Pppoe::toggleSecret($request);

    // Lakukan sesuatu berdasarkan hasilnya
    if ($success) {
      // Jika berhasil
      return redirect()->route('secret.pppoe');
    } else {
      // Jika gagal
      return 'Koneksi gagal';
    }
  }

  public function isolir()
  {
    $data = Pppoe::isolir();
    if (is_string($data)) {
      return $data;
    } else {
      return view('admin.pppoe.isolir', $data);
    }
  }

  public function showUpdate($id)
  {
    $data = Pppoe::showUpdate($id);
    if (is_string($data)) {
      return $data;
    } else {
      return view('admin.pppoe.edit', $data); // Memasukkan $data ke tampilan
    }
  }
}
error_reporting(0);
