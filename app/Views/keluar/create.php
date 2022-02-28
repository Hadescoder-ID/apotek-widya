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
                        <input type="hidden" name="id_user" value="<?= user()->id; ?>"/>
                        <label for="id_obat">Pilih obat :</label> 
                            <select data-live-search="true" class="form-control" title="Pilih Obat" name="id_obat"> 
                                <?php foreach($obat as $dataObat) : ?>
                                    <option name="id_obat" value="<?= $dataObat['id_obat']; ?>"><?= $dataObat['nama_obat']; ?> | <?= $dataObat['nama_satuan']; ?> | <?= $dataObat['nama_golongan']; ?> | <?= $dataObat['nama_satuan']; ?> | <?= $dataObat['nama_jenis']; ?> | <?= $dataObat['harga_jual']; ?></option> 
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="jumlah_keluar">Jumlah Keluar :</label>
                            <input type="number" name="jumlah_keluar" class="form-control"  required>
                        </div>
                        <div class="form-group">
                            <label for="batch">Batch :</label>
                            
                            <input type="text" name="batch"  class="form-control"  required>
                        </div>
                   
                    
                    <div class="form-group">
                        <label for="keterangan">Keterangan :</label>
                        <input type="text" name="keterangan" class="form-control" placeholder="masukkan keterangan obat/barang" required>
                    </div>
                    </div>
                    <div class="col">
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