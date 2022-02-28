<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="col-md-8">
    <div class="row no-gutters">
        <!-- <div class="col-md-4">
            
                </div> -->
                    <div class="card-body">
                        <ul class="list-group">
                           
                            <li class="list-group-item"><?= $obat->nama_obat; ?></li>
                            <li class="list-group-item"><?= $obat->nama_jenis; ?></li>
                            <li class="list-group-item"><?= $obat->nama_satuan; ?></li>
                            <li class="list-group-item"><?= $obat->stok; ?></li>
                            <li class="list-group-item"><?= $obat->harga_jual; ?></li>
                            <li class="list-group-item"><?= $obat->harga_beli; ?></li>
                                           
                        </ul>
                    </div>
                </div>
        </div> 
    </div>
        
<?= $this->endSection(); ?>
