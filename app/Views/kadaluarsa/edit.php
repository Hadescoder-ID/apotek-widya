<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="post" id="text-editor">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <input type="hidden" name="id_masuk"  />
                        <label for="id_obat">Pilih obat :</label> 
                            <select data-live-search="true" class="form-control" title="Pilih Obat" name="id_obat"  readonly> 
                                <?php foreach($obat as $dataObat) : ?>
                                     
                                        <?php if($masuk1['id_obat'] == $dataObat['id_obat']) : ?>
                                            <option selected name="id_obat" value="<?= $dataObat['id_obat']; ?>" readonly><?= $dataObat['nama_obat']; ?> | <?= $dataObat['nama_satuan']; ?> | <?= $dataObat['nama_golongan']; ?> | <?= $dataObat['nama_satuan']; ?> | <?= $dataObat['nama_jenis']; ?> | <?= $dataObat['harga_jual']; ?></option> 
                                        <?php else :?>        
                                            <option name="id_obat" value="<?= $dataObat['id_obat']; ?>" readonly><?= $dataObat['nama_obat']; ?> | <?= $dataObat['nama_satuan']; ?> | <?= $dataObat['nama_golongan']; ?> | <?= $dataObat['nama_satuan']; ?> | <?= $dataObat['nama_jenis']; ?> | <?= $dataObat['harga_jual']; ?></option> 
                                        <?php endif; ?>  
                                    
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="id_user" value="<?= user()->id; ?>"/>
                        <div class="form-group col-md-6"> 
                            <label for="id_distributor">Pilih Distributor</label> 
                            <select data-live-search="true" class="form-control" title="Pilih Distributor" name="id_distributor" > 
                                <?php foreach($distributor as $dataDistributor) : ?>
                                    <?php if($masuk1['id_distributor'] == $dataDistributor['id_distributor']) : ?>
                                        <option selected name="id_distributor" value="<?= $dataDistributor['id_distributor']; ?>"><?= $dataDistributor['nama_distributor']; ?></option> 
                                    <?php else :?>        
                                        <option selected name="id_distributor" value="<?= $dataDistributor['id_distributor']; ?>"><?= $dataDistributor['nama_distributor']; ?></option> 
                                    <?php endif; ?> 
                                <?php endforeach; ?>
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="jumlah_masuk">Jumlah Keluar :</label>
                            <input type="number" name="jumlah_masuk" value="<?= $masuk1['jumlah_masuk']; ?>" class="form-control"  readonly>
                        </div>
                        <div class="form-group">
                            <label for="batch">Batch :</label>
                            
                            <input type="text" name="batch" value="<?= $masuk1['batch']; ?>" class="form-control"  readonly>
                        </div>
                </div>
                <div class="col">
                    
                    <div class="form-group">
                        <label for="tgl_expired">Tanggal Expired :</label>
                        <input type="date" name="tgl_expired" value="<?= $masuk1['tgl_expired']; ?>" class="form-control" placeholder="Masukkan Harga Jual" readonly>
                    </div>
        
                    <div class="form-group">
                        <label for="keterangan">Keterangan :</label>
                        <input type="text" name="keterangan" value=" " class="form-control" placeholder="Masukkan Keterangan" required>
                    </div>
                </div>
            </div>
                
                
                <div class="form-group">
                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" name="reset" value="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        </div>
    </div>


    </div>
</div>

<?= $this->endSection(); ?>