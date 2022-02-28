<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="post" id="text-editor" name="form1">

                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="nama_obat">Nama obat :</label>
                        <input type="text" name="nama_obat" class="form-control" placeholder="Masukkan nama barang" required>
                    </div>
                    <div class="form-group col-md-6"> 
                        <label for="jenis_id">Pilih jenis</label> 
                        <select data-live-search="true" class="form-control" title="Pilih Jenis" name="jenis_id"> 
                            <?php foreach($jenis as $dataJenis) : ?>
                                <option name="id_jenis" value="<?= $dataJenis['id_jenis']; ?>">
                                    <?= $dataJenis['nama_jenis']; ?>
                                </option> 
                            <?php endforeach; ?>
                        </select> 
                    </div>
                    <div class="form-group col-md-6"> 
                        <label for="satuan_id">Pilih Satuan</label> 
                        <select data-live-search="true" class="form-control" title="Pilih Satuan" name="satuan_id"> 
                            <?php foreach($satuan as $dataSatuan) : ?>
                                <option name="id_satuan" value="<?= $dataSatuan['id_satuan']; ?>">
                                    <?= $dataSatuan['nama_satuan']; ?>
                                </option> 
                            <?php endforeach; ?>
                        </select> 
                    </div>
                    <div class="form-group col-md-6"> 
                        <label for="id_golongan">Pilih Golongan</label> 
                        <select data-live-search="true" class="form-control" title="Pilih Golongan" name="id_golongan"> 
                            <?php foreach($golongan as $dataGolongan) : ?>
                                <option name="id_golongan" value="<?= $dataGolongan['id_golongan']; ?>">
                                    <?= $dataGolongan['nama_golongan']; ?>
                                </option> 
                            <?php endforeach; ?>
                        </select> 
                    </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="stok">Stok Barang :</label>
                            <input type="number" name="stok" class="form-control" placeholder="Masukkan stok barang" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="harga_jual">Harga Jual :</label>
                            <input type="text" id="harga_jual" name="harga_jual" value=""  class="form-control" placeholder="Masukkan Harga Jual" readonly>
                        </div>
                        <div class="form-group">
                            <label for="harga_beli">Harga Beli :</label>
                            <input type="text" id="harga_beli"  name="harga_beli" onkeyup="sum()"  class="form-control" placeholder="Masukkan Harga beli" required>
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
<script>
 
    
    function sum( ){
        var hargaBeli = document.getElementById('harga_beli').value;
        var tambah = ((parseInt(hargaBeli)*0.1)*0.25);
        var hargaJual = parseInt(hargaBeli) + tambah;
        if(!isNaN(hargaJual)){
            document.getElementById('harga_jual').value = hargaJual;
        }
        // document.getElementById('harga_jual').value
    }
</script>

<?= $this->endSection(); ?>