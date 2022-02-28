<?= $this->extend('templates/index'); ?> 
<?= $this->section('content'); ?>  
 
                         
            <?= view('Myth\Auth\Views\_message_block') ?>

            
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;?></h1>

    <div class="card shadow mb-4">
        <div class="card-body">
        <form action=" " method="post" class="user">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                    <input type="hidden" class="form-control" name="id" value="<?= $user['id']; ?>">
                    <label for="email">Email :</label>
                    <input type="email" class="form-control" <?php if(session('errors.email')) : ?>is-invalid<?php endif ?>" name="email" value="<?= $user['email']; ?>"
                                            placeholder="<?=lang('Auth.email')?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username :</label>
                        <input type="username" class="form-control" <?php if(session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" value="<?= $user['username']; ?>"
                                                placeholder="<?=lang('Auth.username')?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap :</label>
                        <input type="nama_lengkap" class="form-control" <?php if(session('errors.nama_lengkap')) : ?>is-invalid<?php endif ?>" name="nama_lengkap" value="<?= $user['nama_lengkap']; ?>"
                                                placeholder="nama_lengkap">
                    </div>
                    <div class="form-group">
                        <label for="nama">Role :</label>
                        <input type="nama" class="form-control" <?php if(session('errors.nama_lengkap')) : ?>is-invalid<?php endif ?>" name="nama" value="<?= $user['nama']; ?>"
                                                placeholder="nama">
                    </div>
                </div>
                <div class="col">

                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" name="password" class="form-control  <?php if(session('errors.password')) : ?>is-invalid<?php endif ?>" 
                                                placeholder="<?=lang('Auth.password')?>" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="pass_confirm"><?=lang('Auth.repeatPassword')?></label>
                            <input type="password" name="pass_confirm" class="form-control <?php if(session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
                                </div>

        
                    <button type="submit"  class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </div>
            
            
        <hr>
                                 
        </form> 

                            
        </div>                       
    </div>
</div>
              
          

<?= $this->endSection(); ?>