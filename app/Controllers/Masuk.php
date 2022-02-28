<?php

namespace App\Controllers;
use CodeIgniter\I18n\Time;
use App\Models\obatModel;
use Myth\Auth\Models\userModel;

use App\Models\masukModel;
use App\Models\distributorModel;
class Masuk extends BaseController
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
        $data['title' ] = 'Data Obat masuk';
        $bulan =  $this->request->getVar('bulan');
        $tahun =  $this->request->getVar('tahun');
        
        if($bulan && $tahun  ){
           
            $this->generatePDF($bulan, $tahun);
        }else {

        
        
         
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
                
        
        $this->builder->select('tb_obat_masuk.id_masuk, tb_obat.nama_obat, tb_obat.stok,tb_obat.harga_jual, tb_satuan.nama_satuan,tb_jenis.nama_jenis, users.nama_lengkap, tb_distributor.nama_distributor, tb_obat_masuk.jumlah_masuk, tb_obat_masuk.batch, tb_obat_masuk.tgl_pesan, tb_obat_masuk.tgl_expired, tb_obat_masuk.created_at, tb_obat_masuk.keterangan');
        $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat');
        $this->builder->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat. satuan_id');
        $this->builder->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id');
        $this->builder->join('users','users.id = tb_obat_masuk.id_user');
        $this->builder->join('tb_distributor','tb_distributor.id_distributor = tb_obat_masuk.id_distributor');
        $this->builder->orderby('nama_distributor', 'ASC');
        $this->builder->orderby('nama_obat', 'ASC');
        $query  = $this->builder->get();
        
        $data['masuk'] = $query->getResult();
        return view('masuk/index', $data);
    }
    }

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail Obat masuk';
      
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        $this->builder->select('tb_obat_masuk.id_masuk, tb_obat.nama_obat, users.nama_lengkap, tb_obat_masuk.id_distributor, tb_obat_masuk.jumlah_masuk,tb_obat_masuk.batch, tb_obat_masuk.tgl_pesan, tb_obat_masuk.tgl_expired, tb_obat_masuk.created_at, tb_obat_masuk.keterangan');
        $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat');
        $this->builder->join('users','users.id = tb_obat_masuk.id_user');
        $this->builder->join('tb_distributor','tb_distributor.id_distributor = tb_obat_masuk.id_distributor');
        $this->builder->where('tb_obat_masuk.id_masuk', $id );
        $query  = $this->builder->get();
       
        $data['masuk'] = $query->getRow();
        
       
        
        return view('masuk/detail', $data);
    } 

    public function create()
    {
        $data['title'] = "Tambah Obat masuk";
        $obat = new obatModel();
        $data['obat'] = $obat->select('*')
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan')
        ->orderby('nama_obat ASC')
        ->findAll();
        
        // $user = new userModel();
        // $data['user'] = $user->select('*')->findAll();
        $distributor = new distributorModel();
        $data['distributor'] = $distributor->select('*')->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
 
        $validation   = \Config\Services::validation();
        $validation->setRules([
                                'id_obat' => 'required',
                                'id_user' => 'required',
                                'id_distributor' => 'required',
                                'tgl_pesan' => 'required',
                                'tgl_expired' => 'required',
                                'batch' => 'required',
                                'keterangan' => 'required'
                            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
            
            

            $masuk = new masukModel();

            $data= [
               
                "id_obat" => $this->request->getVar('id_obat'),
                "id_user" => $this->request->getVar('id_user'),
                "id_distributor" => $this->request->getVar('id_distributor'),
                "jumlah_masuk" => $this->request->getVar('jumlah_masuk'),
                "tgl_pesan" => $this->request->getVar('tgl_pesan'),
                "batch" => $this->request->getVar('batch'),
                "tgl_expired" => $this->request->getVar('tgl_expired'),
                "keterangan" => $this->request->getVar('keterangan'),
                
            ];
            $masuk->insert($data);

           
            echo '<script>
                alert("Sukses edit obat masuk");
                window.location="'.base_url('masuk/index').'"
            </script>';
            // return redirect()->to('masuk/index');
        }
        
        echo view('masuk/create', $data);
    }

    public function edit($id)
    {
        $data['title'] = "Edit Obat masuk";
        $obat = new obatModel();
        $data['obat'] = $obat 
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan')
        ->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        // $user = new userModel();
        // $data['user'] = $user->select('*')->findAll();
        $distributor = new distributorModel();
        $data['distributor'] = $distributor->select('*')->findAll();
        $masuk = new masukModel();
        $data['masuk'] = $masuk->where('id_masuk', $id)->first();
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
                        'id_obat' => 'required',
                        'id_user' => 'required',
                        'id_distributor' => 'required',
                        'tgl_pesan' => 'required',
                        'tgl_expired' => 'required',
                        'batch' => 'required',
                        'keterangan' => 'required'
            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
         
        if($isDataValid){
            $masuk->update($id, [
                "id_obat" => $this->request->getVar('id_obat'),
                "id_user" => $this->request->getVar('id_user'),
                "id_distributor" => $this->request->getVar('id_distributor'),
                "jumlah_masuk" => $this->request->getVar('jumlah_masuk'),
                "tgl_pesan" => $this->request->getVar('tgl_pesan'),
                "batch" => $this->request->getVar('batch'),
                "tgl_expired" => $this->request->getVar('tgl_expired'),
                "keterangan" => $this->request->getVar('keterangan'),
            ]);

            echo '<script>
                alert("Sukses edit obat masuk");
                window.location="'.base_url('masuk/index').'"
            </script>';
            // return redirect()->to('masuk/index');
            
        }

        // tampilkan form edit
       echo view('masuk/edit', $data);
    }

    public function delete($id)
    {
        $masuk = new masukModel();
        $masuk->delete($id);
       

        //return redirect()->route('/obat/index');
        return redirect()->to('masuk/index');
    }

    public function filterdate( )
    {
        $bulan =  $this->request->getVar('bulan');
        $tahun =  $this->request->getVar('tahun');
         
        $this->generatePDF($bulan, $tahun);
        return view('masuk/filter');
        
    }

    public function generatePDF($bulan, $tahun)
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
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // Download pdf
        $dompdf->stream("laporan_data_Obat_Masuk"); 
        

  

        
       

    }



}


