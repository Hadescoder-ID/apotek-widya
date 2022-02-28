<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  
    <div class="card shadow mb-4">
        <div class="card-body">
        <form action="" method="post" id="text-editor">
            <div class="form-group">
                <input type="hidden" name="id_jenis" value="<?= $jenis['id_jenis']; ?>" />
                <label for="nama_jenis">Jenis :</label>
                <input type="text" name="nama_jenis" value="<?= $jenis['nama_jenis']; ?>" class="form-control" placeholder="Masukkan kategori jenis" required>
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