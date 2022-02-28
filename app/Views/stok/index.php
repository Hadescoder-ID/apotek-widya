<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
     
  
    

    <div class="container fluid">
    

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
    <div class="card shadow ">
            <div class="card-header ">
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
                         
                              
                        <p class="card-text viewdata">
                        
                        </p>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Distributor</th>
                                            <th>Nama Obat</th>
                                            <th>qty</th>
                                            <th>Satuan</th>
                                            <th>Batch</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $i= 1; ?>
                                        <?php foreach($stok as $m) : ?>
                                        <tr>
                                            <th><?= $i++; ?></th>
                                            <td><?= $m->nama_distributor; ?></td>
                                            <td><?= $m->nama_obat; ?> </td>
                                            <td><?= $m->stok; ?></td>
                                            <td><?= $m->nama_satuan; ?></td>
                                            <td><?= $m->batch; ?></td>
 
                                            <td>
                                                <a href="<?= base_url('stok/edit/'.$m->id_masuk); ?>" class="btn btn-warning" ><i class="fas fa-edit"></i></a>
                                                <a href="#" data-href="<?= base_url('stok/delete/'.$m->id_masuk); ?>" onclick="confirmToDelete(this)" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
                   
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
