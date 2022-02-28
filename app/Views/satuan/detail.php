<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Jenis Detail</h1>
        
 
            <div class="row">
                <div class="col-lg-8">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="" class="card-img" alt="">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"> 
                                        <hr><?= $jenis->nama_jenis; ?></hr>
                                    </li>

                                    
                                </ul>
                            </div>
                        </div>
                </div>
                </div>
                </div>
            </div>
                       
        

    </div>
<?= $this->endSection(); ?>
