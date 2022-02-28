<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
        
 
            <div class="row">
                <div class="col-lg-8">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <!-- <div class="col-md-8">
                                
                        <img src="" class="card-img" alt="">
                        </div> -->
                        <div class="col-md-8">
                            <div class="card-body">
                              
                                    <table border="0" class="table"  width="100%" cellspacing="0">
                                        <tr>
                                            <td>Distributor</td>
                                            <td>:</td>
                                            <td><?= $distributor->nama_distributor; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Telefon</td>
                                            <td>:</td>
                                            <td><?= $distributor->no_telp; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td><?= $distributor->alamat; ?></td>
                                        </tr>

                                    </table>

                                    
                                </ul>
                            </div>
                        </div>
                </div>
                </div>
                </div>
            </div>
                       
        

    </div>
<?= $this->endSection(); ?>
