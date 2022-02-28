<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
        <table style="width:100%" border="0">
        <tr>
           <th width="300px"><center><img src="<?= base_url() ?>/logo.png" width="150px" height="150px" alt=""/> </center></th>
           <th><center>
                    APOTEK WIDYA<br/>
                    Jl. WR. SUPRATMAN Lingk. Barean RT 01 RW 12<br/>
                    Kel. Sidoharjp, Kab. Pacitan<br/>
                    Phone. 08127654903
               
               </center></th>
        </tr>
         
         <tr>
           <td colspan="2"><hr></td>
         </tr>
        <tr>
           
           <td colspan="2"> 
            <div class="card shadow mb-4">

                <div class="card-body">

                    <p class="card-text viewdata">

                    </p>
                    <div class="table-responsive">
                        <form method="post" >
                            <table class="table" border="1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jenis</th>
                                        <th>Satuan</th>
                                        <th>Stok</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Beli</th>
                                        <!-- <th>Tanggal Kadaluarsa</th> -->
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i= 1; ?>
                                    <?php foreach($obat as $o) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><input type="text" value=""></td>
                                        <td><?= $o->nama_jenis; ?></td>
                                        <td><?= $o->nama_satuan; ?></td>
                                        <td><center><?= $o->stok; ?></center></td>
                                        <td>Rp.<?= $o->harga_jual; ?>,-</td>
                                        <td>Rp.<?= $o->harga_beli; ?>,-</td>
                                       

                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                </div>

                </div>
                </td>
        </tr>
    </table>
        </div>         
    </div>

<?= $this->endSection(); ?>
