<?php

namespace App\Controllers;
use App\Models\golonganModel;
use App\Models\obatModel;
use App\Models\masukModel;
use App\Controllers\BaseController;

class Golongan extends BaseController
{

    protected $db, $builder;

    public function __construct() 
    {
        $this->db     = \Config\Database::connect();
        $this->builder= $this->db->table('tb_golongan');

    }

    public function index()
    {
        // $this->builder->select('nama_golongan');
        // $query = $this->builder->get();

        // $data['golongan'] = $query->getResult();
        // return view('golongan/index', $data);
         
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        
        $data['title'] = "Data golongan";
        $golongan = new golonganModel();
        $data['golongan'] = $golongan->orderby('nama_golongan ASC')->findAll();
        
        return view('golongan/index', $data);
        
    }

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail golongan';
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left')->where('tb_obat.stok <= 5')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
 
        
        $this->builder->select('tb_golongan.nama_golongan');
        
        $this->builder->where('tb_golongan.id_golongan', $id);
        $query  = $this->builder->get();
       
        $data['golongan'] = $query->getRow();
        
        if(empty($data['golongan'])) {  
            return redirect()->to('/golongan');
        }
       
        
        return view('golongan/detail', $data);
    }

    public function create()
    {
        $data['title'] = "Tambah golongan";
         // lakukan validasi
         $obat1 = new masukModel();
         $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
         $obat2 = new masukModel();
         $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
             
         
         $validation =  \Config\Services::validation();
         $validation->setRules([
             'nama_golongan' => 'required',
             'warna' => 'required'
            ]);
         $isDataValid = $validation->withRequest($this->request)->run();
         
         // jika data valid, simpan ke database
         if($isDataValid){
             $golongan = new golonganModel();
             $golongan->insert([
                 "nama_golongan" => $this->request->getVar('nama_golongan'),
                 "warna" => $this->request->getPost('warna'),
                 
             ]);
             echo '<script>
             alert("Sukses tambah golongan");
             window.location="'.base_url('golongan/index').'"
         </script>';
         }
         
         // tampilkan form create
         echo view('golongan/create', $data);
        
    }

 

    public function edit($id)
    {
        $data['title'] = "Edit golongan";
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        
        $golongan = new golonganModel();
        $data['golongan'] = $golongan->where('id_golongan', $id)->first();
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_golongan' => 'required',
            'nama_golongan' => 'required',
            'warna' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $golongan->update($id, [
                "nama_golongan" => $this->request->getPost('nama_golongan'),
                "warna" => $this->request->getPost('warna'),
                
            ]);
            echo '<script>
             alert("Sukses edit golongan");
             window.location="'.base_url('golongan/index').'"
         </script>';
        }

        // tampilkan form edit
       echo view('golongan/edit', $data);
    }

    public function delete($id)
    {
        $golongan = new golonganModel();
        $golongan->delete($id);

        //return redirect()->route('/golongan/index');
        return redirect()->to('golongan/index');
    }

}
