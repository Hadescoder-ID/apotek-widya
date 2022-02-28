<?php if(in_groups('admin')) : ?>
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">
<?php else : ?>
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
<?php endif; ?>

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
    <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-mortar-pestle"></i>
    </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      z
    <div class="sidebar-brand-text mx-2">Apotek Widya</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
   
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-cog"></i>
        <span>Obat</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">List Obat:</h6>
            <a class="collapse-item" href="<?= base_url('obat/index'); ?>">Data Obat</a>
            <a class="collapse-item" href="<?= base_url('stok/index'); ?>">Stok Habis </a>

            <a class="collapse-item" href="<?= base_url('kadaluarsa/index'); ?>">Stok kadaluarsa</a>
            <?php if(in_groups('admin')) : ?>
            <h6 class="collapse-header">Detail Obat:</h6>
            <a class="collapse-item" href="<?= base_url('satuan/index'); ?>">Satuan</a>
             <a class="collapse-item" href="<?= base_url('golongan/index'); ?>">Golongan</a>
            <a class="collapse-item" href="<?= base_url('jenis/index/'); ?>">Jenis</a>
            <a class="collapse-item" href="<?= base_url('distributor/index/'); ?>">Distributor</a>

            <?php endif; ?>
        </div>
    </div>
</li>

<hr class="sidebar-divider">

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Transaksi</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Laporan Obat Bulanan :</h6>
                <a class="collapse-item" href="<?= base_url('laporan/index'); ?>">Laporan Bulanan</a>
                
            <h6 class="collapse-header">Obat masuk dan keluar :</h6>
                <a class="collapse-item" href="<?= base_url('masuk/index'); ?>">Obat Masuk</a>
                <a class="collapse-item" href="<?= base_url('keluar/index'); ?>">Obat Keluar</a>
        </div>
    </div>
</li>

<hr class="sidebar-divider">

<?php if(in_groups('admin')) : ?>
<li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/index'); ?>">
        <i class="fas fa-fw fa-table"></i>
        <span>Karyawan</span></a>
</li>
<?php endif; ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>