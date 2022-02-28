<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
     
  
    

<div class="container fluid">
    

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
        <div class="card shadow mb-4">
            <div class="card-header ">
                <form action="" method="post">
                    <div class="row">
                        <div class="col">
                            <select class="form-control mr-3" name="bulan"  id="bulan">
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col">
                                <select class="form-control mr-3" name="tahun" id="tahun">
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            
                                </select>
                        </div>
                        <div class="col" >
                        <button type="submit" class="btn btn-danger mr-3">print</button>
                    
                        </div>
                        </div>
                </form>                 
            </div>
                            
        
                            <div class="card-body">
                            
                                <a href="<?= base_url('masuk/create') ?>" class="btn btn-primary mr-3"><i class="fas fa-plus"></i> Tambah Obat Masuk</a>                       
    
                        
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" >
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama karyawan</th> 
                                                <th>Distributor</th>
                                                <th>Nama Obat</th> 
                                                <th>jumlah masuk</th>
                                                <th>Satuan</th>
                                                <th>Batch</th>
                                                <th>Harga</th>
                                             
                                                <th>ED</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Keterangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    
                                        <tbody>
                                            <?php $i= 1; ?>
                                            <?php foreach($masuk as $m) : ?>
                                            <tr>
                                                <th><?= $i++; ?></th>
                                                <td><?= $m->nama_lengkap; ?></td>
                                                <td><?= $m->nama_distributor; ?></td>
                                                <td><?= $m->nama_obat; ?> </td> 
                                                <td><?= $m->jumlah_masuk; ?></td>
                                                <td><?= $m->nama_satuan; ?></td>
                                                <td><?= $m->batch; ?></td>
                                                <td><?= "Rp " . number_format($m->harga_jual, 2, ",", "."); ?></td>
                                    
                                          
                                                <td  width="4%"><?= date('d/m/Y', strtotime($m->tgl_expired)); ?></td>
                                                <td><?= date('d/m/Y', strtotime($m->created_at)); ?></td>
                                                <td><?= $m->keterangan; ?></td>
                                                <td>
                                                    <a href="<?= base_url('masuk/edit/'.$m->id_masuk); ?>" class="btn btn-warning" ><i class="fas fa-edit"></i></a>
                                                    <a href="#" data-href="<?= base_url('masuk/delete/'.$m->id_masuk); ?>" onclick="confirmToDelete(this)" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
                    
                                                </td>
                                                
                                            </tr>
                                            <?php endforeach; ?> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                

 
                
</div>
                
</div>

    <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="h2">Apa kamu yakin menghapus ini?</h2>
                    <p>Data akan dihapus selamanya</p>
                </div>
                <div class="modal-footer">
                    <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function confirmToDelete(el){
        $("#delete-button").attr("href",el.dataset.href);
        $("#confirm-dialog").modal('show');
    }
</script>

<?= $this->endSection(); ?>
