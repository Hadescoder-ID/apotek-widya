<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
    
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Karyawan</h6>
                        </div>
                        <div class="card-body">
                        <a href="<?= base_url('admin/create'); ?>" class="btn btn-info" ><i class="fas fa-info"></i>  Tambah data karyawan</a>
                                               
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Lengkap</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php $i= 1; ?>
                                        <?php foreach($users as $user) : ?>
                                        <tr>
                                            <th scope="row"><?= $i++; ?></th>
                                            <td><?= $user->nama_lengkap; ?></td>
                                            <td><?= $user->username; ?></td>
                                            <td><?= $user->email; ?></td>
                                            <td><?= $user->name; ?></td>
                                            
                                            <td>
                                                <a href="<?= base_url('admin/'. $user->userid); ?>" class="btn btn-info" ><i class="fas fa-info"></i></a>
                                               <a href="#" data-href="<?= base_url('admin/delete/'.$user->userid); ?>" onclick="confirmToDelete(this)" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
                   
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
