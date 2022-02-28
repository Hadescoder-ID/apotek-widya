<?php

namespace App\Controllers;
use App\Models\obatModel;
use App\Models\jenisModel;
use App\Models\golonganModel;
use App\Models\satuanModel;
use App\Models\masukModel;
class Obat extends BaseController
{
    protected $db, $builder;

    public function __construct() 
    {
        $this->db           = \Config\Database::connect();
        $this->builder      = $this->db->table('tb_obat');
        //$this->validation   = \Config\Services::validation();
    }

    public function index()
    {
        $this->builder->distinct();
        $this->builder->select('tb_obat.id_obat, tb_obat.nama_obat, tb_jenis.nama_jenis, tb_satuan.nama_satuan,tb_golongan.nama_golongan, tb_golongan.warna, tb_obat.stok, tb_obat.harga_jual, tb_obat.harga_beli');
        $this->builder->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id');
        $this->builder->join('tb_satuan','tb_satuan.id_satuan = tb_obat.satuan_id');
        $this->builder->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan');
        $this->builder->orderby('nama_obat ASC');
        $this->builder->orderby('nama_obat', 'ASC');
        $query  = $this->builder->get();
         
        
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
        
        $data['obat'] = $query->getResult();
        return view('obat/index', $data);
    }

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail Obat';

        $this->builder->select('tb_obat.id_obat as obatid, tb_obat.nama_obat, tb_jenis.nama_jenis, tb_satuan.nama_satuan, tb_obat.stok, tb_obat.harga_jual, tb_obat.harga_beli');
        $this->builder->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id');
        $this->builder->join('tb_satuan','tb_satuan.id_satuan = tb_obat.satuan_id');
        $this->builder->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan');
        $this->builder->where('tb_obat.id_obat', $id );
        $obat1 = new obatModel();
        $data['dataobat'] = $obat1->select('*')->where('stok <= 5')->findAll();
        $obat2 = new obatModel();
        $data['kadaluarsa'] = $obat2->select('*')->join('tb_obat_masuk', 'tb_obat_masuk.id_obat = tb_obat.id_obat')->where('tgl_expired <= curdate()')->findAll();

        $query  = $this->builder->get();
        $data['obat'] = $query->getRow();

        return view('obat/detail', $data);
    } 

    public function create()
    {
        $data['title'] = "Tambah Obat";
        $jenis = new jenisModel();
        
        $data['jenis'] = $jenis->select('*')->orderby('nama_jenis ASC')->findAll();
        $satuan = new satuanModel();
        $data['satuan'] = $satuan->select('*')->orderby('nama_satuan ASC')->findAll();
        $golongan = new golonganModel();
        $data['golongan'] = $golongan->select('*')->orderby('nama_golongan ASC')->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        $validation   = \Config\Services::validation();
        //INSERT INTO `tb_obat` (`id_obat`, `nama_obat`, `id_jenis`, `id_satuan`, `stok`, `harga_jual`, `harga_beli`) VALUES ('1', 'dexametasone', '3', '1', '10', '30000', '280000');
        $validation->setRules([
                                'nama_obat' => 'required',
                                'jenis_id' => 'required',
                                'satuan_id' => 'required',
                                'id_golongan' => 'required',
                                'stok' => 'required',
                                'harga_jual' => 'required',
                                'harga_beli' => 'required'
                            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        if($isDataValid){

            $obat = new obatModel();
            $obat->insert([
                "nama_obat" => $this->request->getVar('nama_obat'),
                "jenis_id" => $this->request->getVar('jenis_id'),
                "satuan_id" => $this->request->getVar('satuan_id'),
                "id_golongan" => $this->request->getVar('id_golongan'),
                "stok" => $this->request->getVar('stok'),
                "harga_jual" => $this->request->getVar('harga_jual'),
                "harga_beli" => $this->request->getVar('harga_beli'),
                
            ]);

            
            echo '<script>
                alert("Sukses tambah obat");
                window.location="'.base_url('obat/index').'"
            </script>';
            // return redirect()->to('obat/index');
        }
        
        echo view('obat/create', $data);
    }

    public function edit($id)
    {
        $data['title'] = "Edit Obat";
        $jenis = new jenisModel();
        
        $data['jenis'] = $jenis->select('*')->findAll();
        $satuan = new satuanModel();
        $data['satuan'] = $satuan->select('*')->findAll();
        $obat = new obatModel();
        $data['obat'] = $obat->where('id_obat', $id)->first();
        $golongan = new golonganModel();
        $data['golongan'] = $golongan->select('*')->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
        
        // lakukan validasi data artikel
        $validation =  \Config\Services::validation();
        $validation->setRules([
                                'nama_obat' => 'required',
                                'jenis_id' => 'required',
                                'satuan_id' => 'required',
                                'id_golongan' => 'required',
                                'stok' => 'required',
                                'harga_jual' => 'required',
                                'harga_beli' => 'required'
            
        ]);
        $isDataValid = $validation->withRequest($this->request)->run();
        // jika data vlid, maka simpan ke database
        if($isDataValid){
            $obat->update($id, [
                "nama_obat" => $this->request->getVar('nama_obat'),
                "jenis_id" => $this->request->getVar('jenis_id'),
                "satuan_id" => $this->request->getVar('satuan_id'),
                "id_golongan" => $this->request->getVar('id_golongan'),
                "stok" => $this->request->getVar('stok'),
                "harga_jual" => $this->request->getVar('harga_jual'),
                "harga_beli" => $this->request->getVar('harga_beli')
                
            ]);
            echo '<script>
                alert("Sukses edit obat");
                window.location="'.base_url('obat/index').'"
            </script>';
            // return redirect()->to('obat/index');
        }

        // tampilkan form edit
       echo view('obat/edit', $data);
    }

    public function delete($id)
    {
        $obat = new obatModel();
        $obat->delete($id);

        //return redirect()->route('/obat/index');
        return redirect()->to('obat/index');
    }

    public function multiDelete()
    {
        $obat = new obatModel();
        $id = $this->request->getPost("id_obat");
        
        $obat->delete($id);

        return redirect()->to('obat/index');
    }

  

    public function generatePDF()
    {
        $dompdf = new \Dompdf\Dompdf(); 
        $dompdf->set_option('isHtml5ParserEnabled', true);
        
        $data = $this->db->table("tb_obat")
        ->select('tb_obat.id_obat, tb_obat.nama_obat, tb_jenis.nama_jenis, tb_satuan.nama_satuan, tb_golongan.nama_golongan, tb_golongan.warna, tb_obat.stok, tb_obat.harga_jual, tb_obat.harga_beli')
        ->join('tb_jenis', 'tb_jenis.id_jenis = tb_obat.jenis_id')
        ->join('tb_satuan','tb_satuan.id_satuan = tb_obat.satuan_id')
        ->join('tb_golongan', 'tb_golongan.id_golongan = tb_obat.id_golongan')
        ->orderby('nama_obat ASC')
        ->get()->getResult();
     
      
         
        $dompdf->loadHtml(view('/obat/template-obat', ["obat" => $data]));
        // setting paper to portrait, also we have landscape
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
       
        // to give pdf file name
        $dompdf->stream("laporan_data_obat.php");

        return redirect()->to('obat/index');
    }
    

}


