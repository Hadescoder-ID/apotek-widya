<?php

namespace App\Controllers;
 
use App\Models\obatModel;
use Myth\Auth\Models\userModel;
use App\Models\masukModel;
use App\Models\keluarModel;
 
class Laporan extends BaseController
{
    protected $db, $builder ;

    public function __construct() 
    {
        $this->db           = \Config\Database::connect();
        $this->builder      = $this->db->table('tb_obat_masuk');
        //$this->validation   = \Config\Services::validation();
    }
    public function index()
    {
        $data['title' ] = 'Laporan Bulanan';
        $bulan =  $this->request->getVar('bulan');
        $tahun =  $this->request->getVar('tahun');
        
        if($bulan && $tahun  ){
           
            $this->generatePDF($bulan, $tahun);
        }else {

        
        
         
      
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
  
        return view('laporan/index', $data);
    }
    }

  

    public function generatePDF($bulan, $tahun)
    {

        $terjual = "terjual";
        $kadaluarsa = "kadaluarsa";
       
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->set_option('isHtml5ParserEnabled', true);

        $data2 = $this->db->table("tb_obat_keluar")
        ->distinct()
        ->select('MONTHNAME(tb_obat_keluar.created_at) as tgl') 
        ->where('MONTH(tb_obat_keluar.created_at) ',$bulan)
        ->get()->getResult();
        

        $data = $this->db->table("tb_obat_keluar")
        ->distinct()
        ->selectSum('(tb_obat.harga_jual*tb_obat_keluar.jumlah_keluar)','penjualan')
        ->join('tb_obat', 'tb_obat.id_obat = tb_obat_keluar.id_obat')
       
        ->where('MONTH(tb_obat_keluar.created_at) ',$bulan)
        ->where('YEAR(tb_obat_keluar.created_at) ',$tahun)
        ->where('tb_obat_keluar.keterangan =', $terjual)
        
        ->get()->getResult();

        $data3 = $this->db->table("tb_obat_masuk")
        ->distinct()
        ->selectSum('(tb_obat.harga_jual*tb_obat_masuk.jumlah_masuk)','pembelian')
        ->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')
   
     
        ->where('MONTH(tb_obat_masuk.created_at) ',$bulan)
        ->where('YEAR(tb_obat_masuk.created_at) ',$tahun)
         
        ->get()->getResult();
        
     
        $dompdf->loadHtml(view('/laporan/template-laporan', [  "keluar" => $data, "month" =>  $data2,"masuk" => $data3]));
        // setting paper to portrait, also we have landscape
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();
        // Download pdf
        $dompdf->stream("laporan bulanan"); 
        

  

        
       

    }



}


