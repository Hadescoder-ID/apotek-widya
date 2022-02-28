<?php

namespace App\Controllers;
use App\Models\obatModel;
use Myth\Auth\Models\usersModel;
use App\Models\keluarModel;
use App\Models\masukModel;
use App\Models\jenisModel;
 
class Home extends BaseController
{



    public function index()
    {
        return view('auth/login');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function user()
    {
        return view('home/index');
    }

    // public function obat()
    // {
    //     $obat = new obatModel();
    //     $data['obat'] = $obat->select('*')->where('stok <= 5')->findAll();
    //     return view('home/index');
    // }

//     public function home()
//     {
     
//         $jenis = new jenisModel();
//         $data['jenis'] = $jenis->findAll();
//         // $obat = new obatModel();
//         // $data['dataobat'] = $obat->select('*')->where('stok <= 5')->findAll();
//         $obat = new obatModel();
//         $obat->selectCount('nama_obat');
//         // // $data['obat'] = $obat->getRow();
//         $data['obat'] = $obat->get();
//         // $keluar = new keluarModel();
//         // $data['keluar'] = $keluar->findAll();
//         // $masuk = new masukModel();
//         // $data['masuk'] = $masuk->findAll();
        
        
//         return view('home/index', $data);
//     }
}
