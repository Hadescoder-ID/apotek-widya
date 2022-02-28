<?php

namespace App\Controllers;
use App\Models\obatModel;
use App\Models\jenisModel;
use App\Models\satuanModel;
use App\Models\masukModel;
use App\Models\distributorModel;
use App\Models\prekursorModel;
class Prekursor extends BaseController
{
    protected $db, $builder;

    public function __construct() 
    {
        $this->db           = \Config\Database::connect();
        $this->builder      = $this->db->table('tb_pesan');
        //$this->validation   = \Config\Services::validation();
    }

    public function index()
    {
        $data['title'] = "Form Pemesanan obat dan alat kesehatan";
        $this->builder->select('tb_pesan.id_pesan, tb_distributor.nama_distributor, tb_obat.nama_obat,tb_pesan.zat_aktif_prekursor, tb_pesan.bentuk, tb_pesan.satuan,tb_pesan.jumlah,tb_pesan.keterangan');
        $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_pesan.id_obat');
        $this->builder->join('tb_distributor','tb_distributor.id_distributor = tb_pesan.id_distributor');
      
        $query  = $this->builder->get();
        $data['prekursor'] = $query->getResult(); 
         
        $obat = new obatModel();
        $data['obat'] = $obat->select('*')->findAll();
        $obat1 = new obatModel();
        $data['dataobat'] = $obat1->select('*')->where('stok <= 5')->findAll();
        $obat2 = new obatModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat_masuk', 'tb_obat_masuk.id_obat = tb_obat.id_obat')->where('tgl_expired = curdate()')->findAll();

     
        // $data['obat'] = $query->getResult();
        return view('prekursor/index', $data);
    }

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail Obat';

        $this->builder->select('tb_obat.id_obat as obatid, tb_obat.nama_obat, tb_jenis.nama_jenis, tb_satuan.nama_satuan, tb_obat.stok, tb_obat.harga_jual, tb_obat.harga_beli');
        $this->builder->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id');
        $this->builder->join('tb_satuan','tb_satuan.id_satuan = tb_obat.satuan_id');
        $this->builder->where('tb_obat.id_obat', $id );
        $obat1 = new obatModel();
        $data['dataobat'] = $obat1->select('*')->where('stok <= 5')->findAll();
        $obat2 = new obatModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat_masuk', 'tb_obat_masuk.id_obat = tb_obat.id_obat')->where('tgl_expired = curdate()')->findAll();

        $query  = $this->builder->get();
        $data['obat'] = $query->getRow();

        return view('obat/detail', $data);
    } 
    public function create()
    {
        $obat = new obatModel();
        $data['obat'] = $obat->select('*')->findAll();
       
              
        $obat1 = new obatModel();
        $data['dataobat'] = $obat1->select('*')->where('stok <= 5')->findAll();
        $obat2 = new obatModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat_masuk', 'tb_obat_masuk.id_obat = tb_obat.id_obat')->where('tgl_expired <= curdate()')->findAll();
        $prekursor = new prekursorModel();
        $data['prekursor'] = $prekursor->select('*')->findAll();

        $data['title'] = "Form Pemesanan obat dan alat kesehatan";

        $this->builder->select('tb_pesan.id_pesan,  , tb_obat.nama_obat,tb_pesan.zat_aktif_prekursor, tb_pesan.bentuk, tb_pesan.satuan,tb_pesan.jumlah,tb_pesan.keterangan');
        $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_pesan.id_obat');
       
        $query  = $this->builder->get();
        $data['prekursor'] = $query->getResult(); 

        // if($this->request->isAJAX()){
        //     $msg = [
        //         'data' =>view('')
        //     ]

        //     echo json_encode($msg);
        // }
        
        
        // $data['obat'] = $query->getResult();
        return view('prekursor/create', $data);
    }

    public function simpandata()
    {
        $id_obat = $this->request->getVar('id_obat');
        $zat_aktif_prekursor = $this->request->getVar('zat_aktif_prekursor');
        $bentuk = $this->request->getVar('bentuk');
        $satuan = $this->request->getVar('satuan');
        $jumlah = $this->request->getVar('jumlah');
        $keterangan = $this->request->getVar('keterangan');
        
        if ($this->request->isAJAX()) {
            
           

         
         

        for ($i=0; $i < 4; $i++){
            $this->builder->insert( [
                    
              
                'id_obat' => $id_obat[$i],
                'zat_aktif_prekursor' => $zat_aktif_prekursor[$i],
                'bentuk' => $bentuk[$i],
                'satuan' => $satuan[$i],
                'jumlah' => $jumlah[$i],
                'keterangan' => $keterangan[$i],
            ]);
        }
       

        
 
            
           

        }
    }


    
public function generatePDF()
{
    $dompdf = new \Dompdf\Dompdf(); 
    $dompdf->set_option('isHtml5ParserEnabled', true);
    //$dompdf->set_option('isRemoteEnabled', TRUE);
    // $data['obat'] = $obat->where('id_obat', $id)->first();
    // $obat1 = new obatModel();
    // $data['dataobat'] = $obat1->select('*')->where('stok <= 5')->findAll();
    $data = $this->db->table("tb_obat")->select('tb_obat.id_obat, tb_obat.nama_obat, tb_jenis.nama_jenis, tb_satuan.nama_satuan, tb_obat.stok, tb_obat.harga_jual, tb_obat.harga_beli')->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')->join('tb_satuan','tb_satuan.id_satuan = tb_obat.satuan_id')->get()->getResult();
    // Sending data to view file
  
     
    $dompdf->loadHtml(view('/prekursor/template-prekursor', ["prekursor" => $data]));
    // setting paper to portrait, also we have landscape
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    // Download pdf
    $dompdf->stream(); 
    // to give pdf file name
    $dompdf->stream("laporan_data_prekursor");

    return redirect()->to('prekursor/index');
}

 


}


