<?php

namespace App\Controllers;
use App\Models\distributorModel;
use App\Models\obatModel;
use App\Controllers\BaseController;
use App\Models\masukModel;
class Distributor extends BaseController
{

    protected $db, $builder;

    public function __construct() 
    {
        $this->db     = \Config\Database::connect();
        $this->builder= $this->db->table('tb_distributor');

    }

    public function index()
    {
        // $this->builder->select('nama_distributor');
        // $query = $this->builder->get();
         
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        // $data['distributor'] = $query->getResult();
        // return view('distributor/index', $data);
        $data['title'] = "Data distributor";
        $distributor = new distributorModel();
        $data['distributor'] = $distributor->findAll();
        
        return view('distributor/index', $data);
        
    }

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail distributor'; 
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat','left')->where('tb_obat.stok <= 5')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
 
        
     
        $this->builder->select('nama_distributor, no_telp, alamat');
        
        $this->builder->where('tb_distributor.id_distributor', $id);
        $query  = $this->builder->get();
       
        $data['distributor'] = $query->getRow();
        
        if(empty($data['distributor'])) {  
            return redirect()->to('/distributor');
        }
       
        
        return view('distributor/detail', $data);
    }

    public function create()
    {
        $data['title'] = "Tambah distributor";
         // lakukan validasi
         $obat1 = new masukModel();
         $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
         $obat2 = new masukModel();
         $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
             
         
         $validation =  \Config\Services::validation();
         $validation->setRules(
                                ['nama_distributor' => 'required'],
                                ['no_telp' => 'required'],
                                ['alamat' => 'required']
                                
         );
         $isDataValid = $validation->withRequest($this->request)->run();
       
         // jika data valid, simpan ke database
         if($isDataValid){
             $distributor = new distributorModel();
             $distributor->insert([
                 "nama_distributor" => $this->request->getVar('nama_distributor'),
                 "no_telp" => $this->request->getVar('no_telp'),
                 "alamat" => $this->request->getVar('alamat')
                 
             ]);
             echo '<script>
                alert("Sukses tambah distributor");
                window.location="'.base_url('distributor/index').'"
            </script>';
         }
         
         // tampilkan form create
         echo view('distributor/create', $data);
        
    }
 

    public function edit($id)
    {
        $data['title' ] = 'Edit distributor'; 
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        
        $distributor = new distributorModel();
        $data['distributor'] = $distributor->where('id_distributor', $id)->first();
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'id_distributor' => 'required',
            'nama_distributor' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required'
            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $distributor->update($id, [
                "nama_distributor" => $this->request->getVar('nama_distributor'),
                "no_telp" => $this->request->getVar('no_telp'),
                "alamat" => $this->request->getVar('alamat')
                
            ]);
            echo '<script>
                alert("Sukses edit distributor");
                window.location="'.base_url('distributor/index').'"
            </script>';
        }

        // tampilkan form edit
       echo view('distributor/edit', $data);
    }

    public function delete($id)
    {
        $distributor = new distributorModel();
        $distributor->delete($id);

        //return redirect()->route('/distributor/index');
        return redirect()->to('distributor/index');
    }

    public function generatePDF()
    {
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->set_option('isHtml5ParserEnabled', true);
        
        $data = $this->db->table("tb_distributor")
        ->select('tb_distributor.nama_distributor, tb_distributor.no_telp, tb_distributor.alamat')
        ->get()->getResult();
     
        
         
        $dompdf->loadHtml(view('/distributor/template-distributor', ["distributor" => $data]));
        // setting paper to portrait, also we have landscape
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Download pdf
        $dompdf->stream('Laporan data distributor'); 
       ;

        return redirect()->to('distributor/index');
    }

}
