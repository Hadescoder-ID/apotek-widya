<?php

namespace App\Controllers;
use App\Models\obatModel;
use Myth\Auth\Models\usersModel;
use App\Models\keluarModel;
use App\Models\masukModel;
use App\Models\jenisModel;
use App\Models\distributorModel;
 
use App\Models\satuanModel;
 
class Dashboard extends BaseController
{
    public function __construct() 
    {
        $this->db     = \Config\Database::connect();
        $this->builder= $this->db->table('tb_obat');

    }

    public function index()
    {
     
        $jenis = new jenisModel();
        $data['jenis'] = $jenis->countAllResults();
        $obat = new obatModel();
        $data['obat'] = $obat->countAllResults();
        $masuk = new masukModel();
        $data['masuk'] = $masuk->countAllResults();
        $keluar = new keluarModel();
        $data['keluar'] = $keluar->countAllResults();
        $satuan = new satuanModel();
        $data['satuan'] = $satuan->countAllResults();
        $distributor = new distributorModel();
        $data['distributor'] = $distributor->countAllResults();
        $stok = new masukModel();
        $data['stok'] = $stok->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left')->where('tb_obat.stok <= 5')->countAllResults();
        $kadaluarsa = new masukModel();
        $data['kadaluarsa1'] = $kadaluarsa->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->countAllResults();
        
        
        
        // $obat4 = new obatModel();
        // $data['kadaluarsa1'] = $obat4->select('id_obat')->join('tb_obat_masuk', 'tb_obat_masuk.id_obat = tb_obat.id_obat')->where('tgl_expired <= curdate()')->countAllResults();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        return view('home/index', $data);
    }
}
