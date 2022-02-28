<?= $this->extend('templates/index'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Tambah Satuan</h1>
    
    <div class="card shadow mb-4">
        <div class="card-body">
        <form action="" method="post" id="text-editor">
            <div class="form-group">
                <label for="nama_satuan">Masukkan Satuan :</label>
                <input type="text" name="nama_satuan" class="form-control" placeholder="Masukkan satuan" required>
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