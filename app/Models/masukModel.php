<?php

namespace App\Models;
use CodeIgniter\I18n\Time;
use CodeIgniter\Model;


class masukModel extends Model
{
    protected $table      = 'tb_obat_masuk ';
    protected $primaryKey = 'id_masuk';
  
    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_obat', 'id_user', 'id_distributor', 'batch', 'jumlah_masuk', 'tgl_pesan', 'tgl_expired', 'keterangan' ];
    // protected $DBGroup              = 'default';
    // protected $table                = 'jenis';
    // protected $primaryKey           = 'id';
    // protected $useAutoIncrement     = true;
    // protected $insertID             = 0;
    // protected $returnType           = 'array';
    // protected $useSoftDeletes       = false;
    // protected $protectFields        = true;
    // protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks       = true;
    // protected $beforeInsert         = [];
    // protected $afterInsert          = [];
    // protected $beforeUpdate         = [];
    // protected $afterUpdate          = [];
    // protected $beforeFind           = [];
    // protected $afterFind            = [];
    // protected $beforeDelete         = [];
    // protected $afterDelete          = [];
}
