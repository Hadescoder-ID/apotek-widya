<?php

namespace App\Controllers;
use App\Models\obatModel;
use App\Models\karyawanModel;
use App\Models\masukModel;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
class Admin extends BaseController
{

    protected $db, $builder;

    public function __construct() 
    {
        $this->db     = \Config\Database::connect();
        $this->builder= $this->db->table('users');

    }
    
    
    public function index()
    {
        $data['title' ] = 'List Karyawan';
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
        $this->builder->select('users.id as userid, nama_lengkap, username, email, name,  user_image');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
         
        $query  = $this->builder->get();
       
        
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate() OR tgl_expired = curdate() ')->findAll();
 

       


        $data['users'] = $query->getResult();
        return view('admin/index', $data);
    } 

    public function detail($id = 0)
    {
        $data['title' ] = 'Detail Karyawan';
        
      
        
        $this->builder->select('users.id as userid, nama_lengkap, username, email, name,  user_image');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id );
        $query  = $this->builder->get();
       
        $data['user'] = $query->getRow();
        
        if(empty($data['user'])) {  
            return redirect()->to('/admin');
        }
       
        
        return view('admin/detail', $data);
    }    

    public function create()
    {
        $data['title' ] = 'Tambah Karyawan';
        
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate()')->findAll();
            
        $users = model(UserModel::class);
		$user = new karyawanModel();
       
           
        echo view('admin/create', $data);
    }

    public function edit($id)
    {
        $data['title' ] = 'Edit Karyawan';
        
        $obat1 = new masukModel();
        $data['dataobat'] = $obat1->distinct()->select('tb_obat.nama_obat, tb_obat.stok, tb_satuan.nama_satuan')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->join('tb_satuan', 'tb_satuan.id_satuan = tb_obat.satuan_id')->findAll();
        $obat2 = new masukModel();
        $data['kadaluarsa'] = $obat2->select('tb_obat.nama_obat, tb_obat_masuk.tgl_expired')->join('tb_obat', 'tb_obat.id_obat = tb_obat_masuk.id_obat')->where('tgl_expired <= curdate() OR tgl_expired = curdate() ')->findAll();
 

        return view('admin/edit', $data);
    }

    public function delete($id)
    {
         
		$user = new karyawanModel();
       
        $user->delete($id);

        //return redirect()->route('/jenis/index');
        return redirect()->to('admin/index');
    }
}