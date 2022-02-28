<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  
    <div class="card shadow mb-4">
        <div class="card-body">
        <form action="" method="post" id="text-editor">
            <div class="form-group">
          
            <div class="form-group">
                <input type="hidden" name="id_distributor" value="<?= $distributor['id_distributor']; ?>" />
                <label for="nama_distributor">Distributor :</label>
                <input type="text" name="nama_distributor" value="<?= $distributor['nama_distributor']; ?>" class="form-control"  required>
            </div>
            <div class="form-group">
                <label for="no_telp">Nomor Telefon :</label>
                <input type="text" name="no_telp" value="<?= $distributor['no_telp']; ?>" class="form-control"  required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat :</label>
                <textarea name="alamat"   class="form-control"  required> <?= $distributor['alamat']; ?></textarea>
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