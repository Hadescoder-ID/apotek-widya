<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><? $satuan['title']; ?></h1>
    
    <div class="card shadow mb-4">
                       
                        <div class="card-body">
                       
                        <a href="<?= base_url('satuan/create') ?>" class="btn btn-primary mr-3"><i class="fas fa-plus"></i> Tambah Satuan</a>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Satuan</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php $i= 1; ?>
                                        <?php foreach($satuan as $st) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $st['nama_satuan'] ?></td>
                                           
                                            <td>
                                               <a href="<?= base_url('satuan/edit/'. $st['id_satuan'])?>" class="btn btn-warning" ><i class="fas fa-edit"></i></a>
                                                <a href="#" data-href="<?= base_url('satuan/delete/'.$st['id_satuan']); ?>" onclick="confirmToDelete(this)" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
                   
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
