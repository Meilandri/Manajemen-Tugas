<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $data = array(
           "title"            => "Dashboard",
           "menuDashboard"    => "active",
           "jumlahUser"       => User::count(),
           "jumlahAdmin"      => User::where('jabatan','Admin')->count(),
           "jumlahKaryawan"   => User::where('jabatan','Karyawan')->count(),
           "jumlahOnline"   => User::where('jabatan', 'karyawan')->where('is_tugas', True)->count(),
           "jumlahAfk"   => User::where('jabatan', 'karyawan')->where('is_tugas', False)->count(),
        );

        return view('dashboard',$data);
    }
}
