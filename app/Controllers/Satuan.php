<?php

namespace App\Controllers;
use App\Models\satuanModel;
use App\Models\obatModel;
use App\Controllers\BaseController;
use App\Models\masukModel;

class Satuan extends BaseController
{

    protected $db, $builder;

    public function __construct() 
    {
        $this->db     = \Config\Database::connect();
        $this->builder= $this->db->table('tb_satuan');

    }
 

    public function index()
    {
        // $this->builder->select('nama_satuan');
        // $query = $this->builder->get();

        // $data['satuan'] = $query->getResult();
        // return view('satuan/index', $data);
        
        $data['title'] = "Data Satuan";
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
        
        $satuan = new SatuanModel();
        $data['satuan'] = $satuan->findAll();
        
        return view('satuan/index', $data);
        
    }

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail satuan';
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left')->where('tb_obat.stok <= 5')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
 
      
        $this->builder->select('tb_satuan.nama_satuan');
        
        $this->builder->where('tb_satuan.id_satuan', $id);
        $query  = $this->builder->get();
       
        $data['satuan'] = $query->getRow();
        
        if(empty($data['satuan'])) {  
            return redirect()->to('/satuan');
        }
       
        
        return view('satuan/detail', $data);
    }

    public function create()
    {
         // lakukan validasi
         $data['title'] = "Tambah Satuan";
         $validation =  \Config\Services::validation();
         $validation->setRules(['nama_satuan' => 'required']);
         $isDataValid = $validation->withRequest($this->request)->run();
         $obat1 = new masukModel();
         $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
         $obat2 = new masukModel();
         $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
         // jika data valid, simpan ke database
         if($isDataValid){
             $satuan = new satuanModel();
             $satuan->insert([
                 "nama_satuan" => $this->request->getVar('nama_satuan')
                 
             ]);
             echo '<script>
                alert("Sukses tambah satuan");
                window.location="'.base_url('satuan/index').'"
            </script>';
         }
         
         // tampilkan form create
         return view('satuan/create', $data);
        
    }
 

    public function edit($id)
    {
        $data['title'] = "Edit Satuan";
        $satuan = new satuanModel();
        $data['satuan'] = $satuan->where('id_satuan', $id)->first();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_satuan' => 'required',
            'nama_satuan' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $satuan->update($id, [
                "nama_satuan" => $this->request->getPost('nama_satuan'),
                
            ]);
            echo '<script>
                alert("Sukses edit satuan");
                window.location="'.base_url('satuan/index').'"
            </script>';
        }

        // tampilkan form edit
       echo view('satuan/edit', $data);
    }

    public function delete($id)
    {
        $satuan = new satuanModel();
        $satuan->delete($id);

        //return redirect()->route('/satuan/index');
        return redirect()->to('satuan/index');
    }

}
