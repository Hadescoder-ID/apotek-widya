<?php

namespace App\Controllers;
use App\Models\obatModel;
use App\Models\jenisModel;
use App\Models\satuanModel;
use App\Models\masukModel;
use App\Models\pesanModel;
use App\Models\distributorModel;
class Alkes extends BaseController
{
    protected $db, $builder;

    public function __construct() 
    {
        $this->db           = \Config\Database::connect();
        $this->builder      = $this->db->table('tb_obat_masuk');
        //$this->validation   = \Config\Services::validation();
    }

    public function index()
    {
        $data['title'] = 'Form Pesan Obat Alat Kesehatan';
        
        $distributor1 = new distributorModel();
        $data['distributor'] = $distributor1->select('*')->findAll();
        $distributor =  $this->request->getVar('id_distributor');
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left')->where('tb_obat.stok <= 5')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
 
        
        
        if($distributor ){
           
        $this->builder->distinct();
        $this->builder->select('tb_obat_masuk.id_masuk, tb_obat.nama_obat,  tb_satuan.nama_satuan , tb_obat.stok, tb_obat_masuk.batch');
        $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left');
        $this->builder->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id');
        $this->builder->orderby('nama_obat', 'ASC');
        $this->builder->where('tb_obat.stok <= 5 ');
        $this->builder->where('tb_obat_masuk.id_distributor',$distributor);
        $query  = $this->builder->get();
       

       
        $data['stok'] = $query->getResult();
        return view('alkes/index', $data);
         
        $this->generatePDF($distributor);
        }else {

            $this->builder->distinct();
            $this->builder->select('tb_obat_masuk.id_masuk, tb_obat.nama_obat,  tb_satuan.nama_satuan , tb_obat.stok, tb_obat_masuk.batch');
            $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left');
            $this->builder->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id');
            $this->builder->orderby('nama_obat', 'ASC');
            $this->builder->where('tb_obat.stok <= 5 ');
            $query  = $this->builder->get();
           
    
           
            $data['stok'] = $query->getResult();
            return view('alkes/index', $data);
            
        }
        
    }

    public function tambah( ){

        
        $data['title'] = "Tambah Pesan Obat";
         // lakukan validasi
        $obat = new obatModel();
        $data['obat'] = $obat->select('*')
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan')
        ->findAll();
        
        // $user = new userModel();
        // $data['user'] = $user->select('*')->findAll();
        $distributor = new distributorModel();
        $data['distributor'] = $distributor->select('*')->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left')->where('tb_obat.stok <= 5')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
  
         
        $pesan = new pesanModel();

        $validation   = \Config\Services::validation();
        $validation->setRules([
                                
                            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
            
            
        $pesan->insert([
            "id_obat" => $this->request->getVar('nama_jenis'),
            "jumlah" => $this->request->getVar('jumlah'),
            "keterangan" => $this->request->getVar('keterangan'),
            
            
        ]);

        // $data['pesan'] = $pesan->select('*')->findAll();
        return redirect()->to('alkes/index');
        
        
     
    }
    
    return view('alkes/tambah', $data);

    }
    public function generatePDF($distributor)
    {
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->set_option('isHtml5ParserEnabled', true);
   
        
        $data = $this->db->table("tb_obat_masuk")
        ->select('tb_obat_masuk.id_masuk, tb_obat.nama_obat, tb_obat.stok,tb_obat.harga_jual, tb_satuan.nama_satuan,tb_jenis.nama_jenis, users.nama_lengkap, tb_distributor.nama_distributor, tb_obat_masuk.jumlah_masuk, tb_obat_masuk.batch, tb_obat_masuk.tgl_pesan, tb_obat_masuk.tgl_expired, tb_obat_masuk.created_at, tb_obat_masuk.keterangan')
        ->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat. satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('users','users.id = tb_obat_masuk.id_user')
        ->join('tb_distributor','tb_distributor.id_distributor = tb_obat_masuk.id_distributor')
        ->where('MONTH(tb_obat_masuk.created_at) =',$bulan)
        ->where('YEAR(tb_obat_masuk.created_at) =',$tahun)
        ->orderby('nama_distributor', 'ASC')
        ->orderby('nama_obat', 'ASC')
        ->get()->getResult();
        // Sending data to view file
         
        $dompdf->loadHtml(view('/masuk/template-obat-masuk', ["masuk" => $data]));
        // setting paper to portrait, also we have landscape
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Download pdf
        $dompdf->stream("laporan_data_Obat_Masuk"); 
        

  

        
       

    }
    

//     public function create()
//     {
//         $data['title'] = "Tambah Obat";
//         $jenis = new jenisModel();
        
//         $data['jenis'] = $jenis->select('*')->findAll();
//         $satuan = new satuanModel();
//         $data['satuan'] = $satuan->select('*')->findAll();
        
//         $obat1 = new obatModel();
//         $data['dataobat'] = $obat1->select('*')->where('stok <= 5')->findAll();
//         $obat2 = new obatModel();
//         $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat_masuk', 'tb_obat_masuk.id_obat = tb_obat.id_obat')->where('tgl_expired = curdate()')->findAll();

//         $validation   = \Config\Services::validation();
//         //INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `id_jenis`, `id_satuan`, `stok`, `harga_jual`, `harga_beli`) VALUES ('1', 'dexametasone', '3', '1', '10', '30000', '280000');
//         $validation->setRules([
//                                 'nama_obat' => 'required',
//                                 'jenis_id' => 'required',
//                                 'satuan_id' => 'required',
//                                 'stok' => 'required',
//                                 'harga_jual' => 'required',
//                                 'harga_beli' => 'required'
                            
//         ]);
//         $isDataValid = $validation->withRequest($this->request)->run();
//         if($isDataValid){

//             $obat = new obatModel();
//             $obat->insert([
//                 "nama_obat" => $this->request->getVar('nama_obat'),
//                 "jenis_id" => $this->request->getVar('jenis_id'),
//                 "satuan_id" => $this->request->getVar('satuan_id'),
//                 "stok" => $this->request->getVar('stok'),
//                 "harga_jual" => $this->request->getVar('harga_jual'),
//                 "harga_beli" => $this->request->getVar('harga_beli'),
                
//             ]);
//             $data['obat'] = $obat;
      
//             return redirect()->to('obat/index');
//         }
        
//         echo view('obat/create', $data);
//     }



}


