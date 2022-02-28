<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Data Obat Kadaluarsa</h1>

        <div class="card shadow mb-4">

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
                        
       
        <div class="table-responsive">
                    <form method="post" action=" " class="form-delete">
                   
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                     
                                    <th>No</th>
                                    <th>Distributor</th>
                                    <th>Nama Obat</th>
                                    <th>Batch</th>
                                    <th>tanggal Kadaluarsa</th> 
                
                                    <th>Action</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                <?php $j= 1; ?>
                                <?php foreach($kadaluarsa1 as $k) : ?>
                                <tr>
                                    <td ><?= $j++; ?></th>
                                    <td><?= $k->nama_distributor; ?></td>
                                    <td><?= $k->nama_obat; ?></td>
                                    <td><?= $k->batch; ?></td> 
                                    <td><?= $k->tgl_expired; ?>
                                    </td>
                                   
                                   
                                   
                                   
                                    <td>
                                        
                                        <a href="<?= base_url('kadaluarsa/edit/'.$k->id_masuk); ?>" class="btn btn-warning"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="#" data-href="<?= base_url('kadaluarsa/delete/'.$k->id_masuk); ?>"
                                            onclick="confirmToDelete(this)" class="btn btn-danger"><i
                                                class="fas fa-trash"></i></a>
    
                                    </td>
    
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
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
        function confirmToDelete(el) {
            var lengthChecked = $('input:checkbox.check-item:checked').length;

            if(lengthChecked > 0) {
                $("#delete-button").click(function(){
                    $(".form-delete").submit();
                })
            } else {
                $("#delete-button").attr("href", el.dataset.href);
            }
            
            $("#confirm-dialog").modal('show');
        }
    </script>

<?= $this->endSection(); ?>
