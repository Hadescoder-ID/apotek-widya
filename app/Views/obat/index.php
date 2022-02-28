<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Data Obat</h1>

        <div class="card shadow mb-4">

            <div class="card-body">
            
                <!-- <button class="btn btn-info"><i class="fas fa-plus"></i> obat</button> -->
                <a href="<?= base_url('obat/create'); ?>" class="btn btn-primary mr-3"><i class="fas fa-plus"></i>Tambah obat</a>
                <a href="<?= base_url('obat/generate-pdf'); ?>" class="btn btn-danger mr-3">
                    <i class="fas fa-print"></i>Download PDF
                </a>   

                <p class="card-text viewdata">

                </p>
                <div class="table-responsive">
                    <form method="post" action="<?= base_url('obat/multiDelete') ?>" class="form-delete">
                        <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type='checkbox' id="check-all"></th>
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Jenis</th>
                                    <th>Satuan</th>
                                    <th>Golongan</th>
                                    <th>Stok</th>
                                    <th>Harga Jual</th>
                                    <th>Harga Beli</th>
                                    <!-- <td>Tanggal Kadaluarsa</td> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
    
                            <tbody>
                                <?php $i= 1; ?>
                                <?php foreach($obat as $o) : ?>
                                <tr>
                                    <td><input type='checkbox' class='check-item' name='id_obat[]' value="<?=$o->id_obat;?>"></td>
                                    <th scope="row"><?= $i++; ?></th>
                                    <td><?= $o->nama_obat; ?></td>
                                    <td><?= $o->nama_jenis; ?></td>
                                    <td><?= $o->nama_satuan; ?></td>
                                    <td><?= $o->nama_golongan; ?> <br/>
                                        <?= $o->warna; ?>
                                    </td>
                                    <td><?= $o->stok; ?></td>
                                    <td><?= "Rp " . number_format($o->harga_jual, 2, ",", "."); ?></td>
                                    <td><?= "Rp " . number_format($o->harga_beli, 2, ",", "."); ?></td>
                                  
                                   
                                    <td>
                                        
                                        <a href="<?= base_url('obat/edit/'.$o->id_obat); ?>" class="btn btn-warning"><i
                                                class="fas fa-edit"></i></a>
                                        <a href="#" data-href="<?= base_url('obat/delete/'.$o->id_obat); ?>"
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
