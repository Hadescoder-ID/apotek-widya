<?php

namespace App\Controllers;
use App\Models\jenisModel;
use App\Models\obatModel;
use App\Controllers\BaseController;
use App\Models\masukModel;
class Jenis extends BaseController
{

    protected $db, $builder;

    public function __construct() 
    {
        $this->db     = \Config\Database::connect();
        $this->builder= $this->db->table('tb_jenis');

    }

    public function index()
    {
        // $this->builder->select('nama_jenis');
        // $query = $this->builder->get();

        // $data['jenis'] = $query->getResult();
        // return view('jenis/index', $data);
         
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        
        $data['title'] = "Data Jenis";
        $jenis = new jenisModel();
        $data['jenis'] = $jenis->orderby('nama_jenis ASC')->findAll();
        
        return view('jenis/index', $data);
        
    }

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail Jenis';
        $obat1 = new obatModel();
        $data['dataobat'] = $obat1->select('*')->where('stok <= 5')->findAll();
        $obat2 = new obatModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat_masuk', 'tb_obat_masuk.id_obat = tb_obat.id_obat')->where('tgl_expired <= curdate()')->findAll();

        $this->builder->select('tb_jenis.nama_jenis');
        
        $this->builder->where('tb_jenis.id_jenis', $id);
        $query  = $this->builder->get();
       
        $data['jenis'] = $query->getRow();
        
        if(empty($data['jenis'])) {  
            return redirect()->to('/jenis');
        }
       
        
        return view('jenis/detail', $data);
    }

    public function create()
    {
        $data['title'] = "Tambah Jenis";
         // lakukan validasi
         $obat1 = new masukModel();
         $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
         $obat2 = new masukModel();
         $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
             
         
         $validation =  \Config\Services::validation();
         $validation->setRules(['nama_jenis' => 'required']);
         $isDataValid = $validation->withRequest($this->request)->run();
         
         // jika data valid, simpan ke database
         if($isDataValid){
             $jenis = new jenisModel();
             $jenis->insert([
                 "nama_jenis" => $this->request->getVar('nama_jenis')
                 
             ]);
             echo '<script>
                alert("Sukses tambah jenis");
                window.location="'.base_url('jenis/index').'"
            </script>';
         }
         
         // tampilkan form create
         echo view('jenis/create', $data);
        
    }

     

    public function edit($id)
    {
        $data['title'] = "Edit Jenis";
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        
        $jenis = new jenisModel();
        $data['jenis'] = $jenis->where('id_jenis', $id)->first();
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_jenis' => 'required',
            'nama_jenis' => 'required'
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $jenis->update($id, [
                "nama_jenis" => $this->request->getPost('nama_jenis'),
                
            ]);
            echo '<script>
                alert("Sukses edit jenis");
                window.location="'.base_url('jenis/index').'"
            </script>';
        }

        // tampilkan form edit
       echo view('jenis/edit', $data);
    }

    public function delete($id)
    {
        $jenis = new jenisModel();
        $jenis->delete($id);

        //return redirect()->route('/jenis/index');
        return redirect()->to('jenis/index');
    }

}
