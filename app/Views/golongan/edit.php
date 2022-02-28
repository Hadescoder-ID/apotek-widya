<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  
    <div class="card shadow mb-4">
        <div class="card-body">
        <form action="" method="post" id="text-editor">
            <div class="form-group">
                <input type="hidden" name="id_golongan" value="<?= $golongan['id_golongan']; ?>" />
                <label for="nama_golongan">golongan :</label>
                <input type="text" name="nama_golongan" value="<?= $golongan['nama_golongan']; ?>" class="form-control" placeholder="Masukkan kategori golongan" required>
            </div>
            <div class="form-group">
                <input type="hidden" name="warna" value="<?= $golongan['warna']; ?>" />
                <label for="warna">Segmentasi warna :</label>
                <input type="text" name="warna" value="<?= $golongan['warna']; ?>" class="form-control" placeholder="Masukkan Segmentasi warna" required>
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