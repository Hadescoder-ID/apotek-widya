<?php

namespace App\Controllers;
use App\Models\satuanModel;
use App\Models\jenisModel;
use App\Models\golonganModel;
use CodeIgniter\I18n\Time;
use App\Models\obatModel;
use Myth\Auth\Models\userModel;;
use App\Models\masukModel;
use App\Models\keluarModel;
use App\Models\distributorModel;
use App\Controllers\BaseController;

class Kadaluarsa extends BaseController
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
            $data['title'] = "Data Obat Kadaluarsa";
            $obat1 = new masukModel();
            $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
            $obat2 = new masukModel();
            $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
            $distributor = new distributorModel();
            $data['distributor'] = $distributor->select('*')->findAll();
            

            $this->builder->select('tb_obat_masuk.id_masuk,tb_obat.id_obat,tb_distributor.nama_distributor, tb_obat.nama_obat  ,tb_obat_masuk.batch,  ,tb_obat_masuk.tgl_expired');
            $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat');
            $this->builder->join('tb_distributor','tb_distributor.id_distributor = tb_obat_masuk.id_distributor');
            $this->builder->where('tgl_expired <= curdate()');
            $query  = $this->builder->get();
            $data['kadaluarsa1'] = $query->getResult();
        
            return view('kadaluarsa/index', $data);
            }
        
    }
    public function edit($id)
    {
        $data['title'] = "Obat Kadaluarsa";

        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        $obat = new obatModel();
        $data['obat'] = $obat 
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan')
        ->findAll();
        
        
        // $user = new userModel();
        // $data['user'] = $user->select('*')->findAll();
        $distributor = new distributorModel();
        $data['distributor'] = $distributor->select('*')->findAll();
        $masuk = new masukModel();
        $data['masuk1'] = $masuk->where('id_masuk', $id)->first();
        $keluar = new keluarModel();
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
                       
                        'jumlah_masuk' => 'required',
                        'batch' => 'required',
                       
            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
         
        if($isDataValid){
            $masuk = new masukModel();
            $masuk->delete($id);
            
            $keluar->insert([
                "id_obat" => $this->request->getVar('id_obat'),
                "id_user" => $this->request->getVar('id_user'),
                "batch" => $this->request->getVar('batch'),
                "jumlah_keluar" => $this->request->getVar('jumlah_masuk'),
                "keterangan" => $this->request->getVar('keterangan'),
                
            ]);
            echo '<script>
            alert("Sukses Tambah Obat/Barang");
            window.location="'.base_url('kadaluarsa/index').'"
            </script>';
            // return redirect()->to('stok/index');
        }

        // tampilkan form edit
       echo view('kadaluarsa/edit', $data);
    }

    public function delete($id)
    {
        $masuk = new masukModel();
        $masuk->delete($id);
        // $keluar = new keluarModel();
        // $keluar->insert([
        //     "id_obat" => $this->request->getVar('id_obat'),
        //     "id_user" => $this->request->getVar('id_user'),
        //     "batch" => $this->request->getVar('batch'),
        //     "jumlah_keluar" => $this->request->getVar('jumlah_masuk'),
        //     "keterangan" => 'obat rusak / berhenti produksi',
            
        // ]);
        
       

        //return redirect()->route('/obat/index');
        return redirect()->to('kadaluarsa/index');
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
        ->where('tgl_expired <= curdate()')
        ->orderby('nama_obat', 'ASC')
        ->get()->getResult();
        // Sending data to view file
         
        $dompdf->loadHtml(view('/kadaluarsa/template-obat-kadaluarsa', ["kadaluarsa" => $data , "distributor" => $data2 ] ));
        // setting paper to portrait, also we have landscape
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        // Download pdf
        $dompdf->stream("laporan_data_Obat_distributor"); 
        

  

        
       

    }
    
}
 