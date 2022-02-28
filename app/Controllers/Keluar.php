<?php

namespace App\Controllers;
use App\Models\obatModel;
use Myth\Auth\Models\userModel;;
use App\Models\keluarModel;
use App\Models\masukModel;
class Keluar extends BaseController
{
    protected $db, $builder;

    public function __construct() 
    {
        $this->db           = \Config\Database::connect();
        $this->builder      = $this->db->table('tb_obat_keluar');
        //$this->validation   = \Config\Services::validation();
    }
    public function index()
    {
        $data['title' ] = 'Data Obat Keluar';

        $bulan =  $this->request->getVar('bulan');
        $tahun =  $this->request->getVar('tahun');
        
        
        if($bulan && $tahun){
            $this->generatePDF($bulan, $tahun);
        }else {
            $obat1 = new masukModel();
            $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
            $obat2 = new masukModel();
            $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
                
            $this->builder->select('tb_obat_keluar.id_keluar, tb_obat.nama_obat, tb_obat.stok,tb_obat.harga_jual,tb_satuan.nama_satuan, users.nama_lengkap, tb_obat_keluar.jumlah_keluar,tb_obat_keluar.batch, tb_obat_keluar.created_at,  tb_obat_keluar.keterangan');
            $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_obat_keluar.id_obat');
            $this->builder->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id');
            $this->builder->join('users','users.id = tb_obat_keluar.id_user');
            $this->builder->orderby('nama_obat', 'ASC');
            $query  = $this->builder->get();
        

            $data['keluar'] = $query->getResult();
            return view('keluar/index', $data);
        }
    }

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail Obat Keluar';
      
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left')->where('tb_obat.stok <= 5')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
 
        $this->builder->select('tb_obat_keluar.id_keluar, tb_obat.nama_obat, users.nama_lengkap, tb_obat_keluar.jumlah_keluar,  tb_obat_keluar.keterangan');
        $this->builder->join('tb_obat', 'tb_obat.id_obat = tb_obat_keluar.id_obat');
        $this->builder->join('users','users.id = tb_obat_keluar.id_user');
        $this->builder->where('tb_obat_keluar.id_keluar', $id );
        
        $query  = $this->builder->get();
       
        $data['keluar'] = $query->getRow();
        
       
        
        return view('keluar/detail', $data);
    } 

    public function create()
    {
        $data['title'] = "Tambah Obat Keluar";
        $obat = new obatModel();
        $data['obat'] = $obat->select('*')
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan')
        ->orderby('nama_obat ASC')
        ->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        $validation   = \Config\Services::validation();
        $validation->setRules([
                                'id_obat' => 'required',
                                'id_user' => 'required',
                                'jumlah_keluar' => 'required',
                                'batch' => 'required',
                                'keterangan' => 'required'
                            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){
           
            $keluar = new keluarModel();
            $keluar->insert([
                "id_obat" => $this->request->getVar('id_obat'),
                "id_user" => $this->request->getVar('id_user'),
                "batch" => $this->request->getVar('batch'),
                "jumlah_keluar" => $this->request->getVar('jumlah_keluar'),
                "keterangan" => $this->request->getVar('keterangan'),
                
            ]);
            echo '<script>
                alert("Sukses Tambah obat keluar");
                window.location="'.base_url('keluar/index').'"
            </script>';
      
            // return redirect()->to('keluar/index');
        }
        
        echo view('keluar/create', $data);
    }

    public function edit($id)
    {
        $data['title'] = "Edit Obat Keluar";
        $obat = new obatModel();
        $data['obat'] = $obat->select('*')
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan')
        ->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        // $user = new usersModel();
        // $data['user'] = $user->select('*')->findAll();
        $keluar = new keluarModel();
        $data['keluar'] = $keluar->where('id_keluar', $id)->first();
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
                        'id_obat' => 'required',
                        'batch' => 'required',
                        'jumlah_keluar' => 'required',
                       
                        'keterangan' => 'required'
            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $keluar->update($id, [
                "id_obat" => $this->request->getVar('id_obat'),
                "id_user" => $this->request->getVar('id_user'),
                "jumlah_keluar" => $this->request->getVar('jumlah_keluar'),
                
                "batch" => $this->request->getVar('batch'),
                "keterangan" => $this->request->getVar('keterangan'),
                
            ]);
            echo '<script>
                alert("Sukses edit obat keluar");
                window.location="'.base_url('keluar/index').'"
            </script>';
            // return redirect()->to('keluar/index');
        }

        // tampilkan form edit
       echo view('keluar/edit', $data);
    }

    public function delete($id)
    {
        $keluar = new keluarModel();
        $keluar->delete($id);

        //return redirect()->route('/obat/index');
        return redirect()->to('keluar/index');
    }
    public function filterdate( )
    {
        $bulan =  $this->request->getVar('bulan');
        $tahun =  $this->request->getVar('tahun');
         
        $this->generatePDF($bulan, $tahun);
        return view('keluar/filter');
        
    }

    public function generatePDF($bulan, $tahun)
    {
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->set_option('isHtml5ParserEnabled', true);
        

        $data = $this->db->table("tb_obat_keluar")
        ->select('tb_obat_keluar.id_keluar, tb_obat.nama_obat, tb_obat.stok,tb_obat.harga_jual,tb_satuan.nama_satuan, users.nama_lengkap, tb_obat_keluar.jumlah_keluar,tb_obat_keluar.batch, tb_obat_keluar.created_at,  tb_obat_keluar.keterangan')
        ->join('tb_obat', 'tb_obat.id_obat = tb_obat_keluar.id_obat')
        ->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('users','users.id = tb_obat_keluar.id_user')
        ->where('MONTH(tb_obat_keluar.created_at) =',$bulan)
        ->where('YEAR(tb_obat_keluar.created_at) =',$tahun)
        ->orderby('nama_obat', 'ASC')
     
        ->get()->getResult();
        // Sending data to view file
      
        
        
        $dompdf->loadHtml(view('/keluar/template-obat-keluar', ["keluar" => $data]));
        // setting paper to portrait, also we have landscape
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Download pdf
        $dompdf->stream("laporan_data_Obat keluar"); 
        

        // return redirect()->to('keluar/index');

        // return view('keluar/index');
        
    }




}


