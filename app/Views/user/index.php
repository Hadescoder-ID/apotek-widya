<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="col-md-8">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="<?= base_url('/img/'. user()->user_image); ?>" class="card-img" alt="<?= user()->username; ?>">
                </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"> 
                                <hr><input type="text" name="username" value="<?= user()->username; ?>"></hr>
                            </li>

                            <?php if (user()->nama_lengkap) : ?>
                            <li class="list-group-item"><input type="text" name="nama_lengkap" value="<?= user()->nama_lengkap; ?>"></li>
                            <?php endif; ?>

                            <li class="list-group-item"><input type="text" name="email" value="<?= user()->email; ?>"></li>
                                           
                        </ul>
                    </div>
                </div>
        </div> 
    </div>
        
<?= $this->endSection(); ?>
