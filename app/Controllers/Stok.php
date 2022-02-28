<?php

namespace App\Controllers;
use App\Models\distributorModel;
use App\Models\obatModel;
use App\Models\masukModel;
use App\Models\jenisModel;
use App\Models\golonganModel;
use App\Models\satuanModel;
use App\Controllers\BaseController;

class Stok extends BaseController
{

    protected $db, $builder ;

    public function __construct() 
    {
        $this->db     = \Config\Database::connect();
        $this->builder= $this->db->table('tb_obat_masuk');
        
    }
 

    public function index()
    {
   
    $distributor =  $this->request->getVar('id_distributor');
       if($distributor ){
            $this->generatePDF($distributor);
        }else {
            $data['title'] = "Data Obat Habis";
            $obat1 = new masukModel();
            $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
            $obat2 = new masukModel();
            $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            $distributor = new distributorModel();
            $data['distributor'] = $distributor->select('*')->findAll();
            
            $this->builder->distinct();
            $this->builder->select('tb_obat_masuk.id_masuk, tb_obat.nama_obat,tb_distributor.nama_distributor,  tb_satuan.nama_satuan , tb_obat.stok, tb_obat_masuk.batch');
            $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left');
            $this->builder->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id');
            $this->builder->join('tb_distributor','tb_distributor.id_distributor = tb_obat_masuk.id_distributor');
            $this->builder->orderby('nama_obat', 'ASC');
            $this->builder->where('tb_obat.stok <= 5 ');
            $query  = $this->builder->get();
            $data['stok'] = $query->getResult();
        
            return view('stok/index', $data);
        }
        
    }
    
    public function edit($id)
    {
        $data['title'] = "Tambah Stok";
        $obat = new obatModel();
        $data['obat'] = $obat 
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan')
        ->findAll();
       
        // $user = new userModel();
        // $data['user'] = $user->select('*')->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
 
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
                       
                        'jumlah_masuk' => 'required',
                        'batch' => 'required',
                       
            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        $distributor = new distributorModel();
        $data['distributor'] = $distributor->select('*')->findAll();
        $masuk = new masukModel();
        $data['masuk1'] = $masuk->where('id_masuk', $id)->first();
        if($isDataValid){
            $masuk->insert( [
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
            alert("Sukses Tambah Obat/Barang");
            window.location="'.base_url('stok/index').'"
            </script>';
            // return redirect()->to('stok/index');
        }

        // tampilkan form edit
       echo view('stok/edit', $data);
    }

    public function delete($id)
    {
        $obat = new obatModel();
        $obat->delete($id);

        //return redirect()->route('/obat/index');
        return redirect()->to('stok/index');
    }

    public function generatePDF($distributor)
    {
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->set_option('isHtml5ParserEnabled', true);
       
        $data2 = $this->db->table("tb_distributor")->select('tb_distributor.nama_distributor,tb_distributor.alamat,tb_distributor.no_telp')->where('tb_distributor.id_distributor =',$distributor)->get()->getResult();

        $data = $this->db->table("tb_obat_masuk")
        ->select('tb_obat_masuk.id_masuk, tb_obat.nama_obat, tb_obat.stok,tb_obat.harga_jual, tb_satuan.nama_satuan,tb_jenis.nama_jenis, users.nama_lengkap, tb_distributor.nama_distributor,tb_distributor.alamat,tb_distributor.no_telp, tb_obat_masuk.jumlah_masuk, tb_obat_masuk.batch, tb_obat_masuk.tgl_pesan, tb_obat_masuk.tgl_expired, tb_obat_masuk.created_at, tb_obat_masuk.keterangan')
        ->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat. satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('users','users.id = tb_obat_masuk.id_user')
        ->join('tb_distributor','tb_distributor.id_distributor = tb_obat_masuk.id_distributor')
        ->where('tb_distributor.id_distributor =',$distributor)
        ->orderby('nama_obat', 'ASC')
        ->where('tb_obat.stok <= 5 ')
        ->get()->getResult();
        // Sending data to view file
         
        $dompdf->loadHtml(view('/stok/template-obat-stok', ["stok" => $data , "distributor" => $data2 ] ));
        // setting paper to portrait, also we have landscape
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // Download pdf
        $dompdf->stream("laporan_data_Obat_Masuk"); 
        

  

        
       

    }
    
}
 