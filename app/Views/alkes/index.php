<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
    <div class="card shadow mb-4">
        <div class="card-header">
        
                <form action="" method="post">
                    <div class="row">
                        
                        
                        <div class="form-group col-md-6"> 
                                <label for="id_distributor">Pilih Distributor</label> 
                                <select data-live-search="true" class="form-control" title="Pilih Distributor" name="id_distributor"> 
                                    <?php foreach($distributor as $dataDistributor) : ?>
                                        <option name="id_distributor" value="<?= $dataDistributor['id_distributor']; ?>">
                                            <?= $dataDistributor['nama_distributor']; ?>
                                        </option> 
                                    <?php endforeach; ?>
                                </select> 
                                <br>
                                <button type="submit" class="btn btn-danger mr-3">print</button>
                    
                            
                        </div>
                       
                    </div>
                </form>                 
            
        </div>
        <div class="card-body">  
        <div class="table-responsive">
        <a href="<?= base_url('alkes/tambah/'); ?>" class="btn btn-info" ><i class="fas fa-edit"></i></a>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                    
                                            <th>Nama Obat</th>
                                            <th>qty</th>
                                            <th>Satuan</th>
                                            <th>Batch</th>
                                            <th>Batch</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $i= 1; ?>
                                        <?php foreach($stok as $m) : ?>
                                        <tr>
                                            <th><?= $i++; ?></th>
 
                                            <td><?= $m->nama_obat; ?> </td>
                                            <td><?= $m->stok; ?></td>
                                            <td><?= $m->nama_satuan; ?></td>
                                            <td><?= $m->batch; ?></td>
 
                                            <td>
                                                <a href="<?= base_url('alkes/tambah/'); ?>" class="btn btn-warning" ><i class="fas fa-edit"></i></a>
                                                <a href="#" data-href="<?= base_url('alkes/delete/'.$m->id_masuk); ?>" onclick="confirmToDelete(this)" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
                   
                                            </td>
                                            
                                        </tr>
                                        <?php endforeach; ?> 
                                    </tbody>
                                </table>
                            </div>
        </div>     
    </div>

<?= $this->endSection(); ?>
