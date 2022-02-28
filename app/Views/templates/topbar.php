<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

             
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
 
<!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <?php if($dataobat == true || $kadaluarsa == true) : ?>
                                <span class="badge badge-danger badge-counter">!</span>
                                <?php else : ?>
                                    <span class="badge "></span>
                                <?php endif; ?>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Notifikasi
                                </h6>
                               
                                <?php foreach($dataobat as $d) : ?> 
                                    <a class="dropdown-item d-flex align-items-center" href="<?= base_url('obat/index'); ?>">
                                    <?php if( $d['stok'] >= 1 && $d['stok'] <= 5  ) : ?> 
                                        <div>
                                            
                                            <div class="text ">Stok <b><?= $d['nama_obat']; ?></b> telah menipis, Sisa <?= $d['stok']; ?> <?= $d['nama_satuan']; ?>. segera mengisi stok obat/barang. </div>
                                            
                                        </div>
                                    <?php elseif ($d['stok'] == 0 ) : ?>

                                        <div>
                                            
                                            <div class="text ">Stok <b><?= $d['nama_obat']; ?></b> telah Habis, Sisa <?= $d['stok']; ?> <?= $d['nama_satuan']; ?>. segera mengisi stok obat/barang. </div>
                                            
                                        </div>
                                    <?php endif; ?>
                                    </a>
                                <?php endforeach; ?>
                                <?php foreach($kadaluarsa as $k) : ?> 
                                    <a class="dropdown-item d-flex align-items-center" href="<?= base_url('masuk/index'); ?>">
                                        
                                        <div>
                                            
                                            <div class="text ">Obat <b><?= $k['nama_obat']; ?></b> telah Kadaluarsa, segera mengisi stok obat/barang. </div>
                                            
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                                <a class="dropdown-item text-center small text-gray-500" href="#">tidak ada notifikasi lain</a>
                            </div>
                        </li>
 
                      
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= user()->username; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url(); ?>/img/<?=  user()->user_image; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('user/index'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>