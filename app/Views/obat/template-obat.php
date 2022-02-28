<html>


<head>
<link href="<?= base_url(); ?>/vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    
    <div class="container-fluid">

    <table style="width:100%" border="0">
        <tr>
           
           
           <th><center>
                    APOTEK WIDYA<br/>
                    Jl. WR. SUPRATMAN Lingk. Barean RT 01 RW 12<br/>
                    Kel. Sidoharjo, Kab. Pacitan<br/>
                    Phone. 08127654903
               
               </center></th>
        </tr>
         
         <tr>
           <td colspan="2"><hr></td>
         </tr>
        <tr>
           
           <td colspan="2"> 
            <div class="card shadow mb-4">

                <div class="card-body">

                    <p class="card-text viewdata">

                    </p>
                    <div class="table-responsive">
                        <form method="post" >
                            <table class="table" border="1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        
                                        <th>No</th>
                                        <th>Nama Obat</th>
                                        <th>Jenis</th>
                                        <th>Satuan</th>
                                        <th>Stok</th>
                                        <th>Harga Jual</th>
                                        <th>Harga Beli</th>
                                        <!-- <th>Tanggal Kadaluarsa</th> -->
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i= 1; ?>
                                    <?php foreach($obat as $o) : ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td><?= $o->nama_obat; ?></td>
                                        <td><?= $o->nama_jenis; ?></td>
                                        <td><?= $o->nama_satuan; ?></td>
                                        <td><center><?= $o->stok; ?></center></td>
                                        <td><?= "Rp " . number_format($o->harga_jual, 2, ",", "."); ?></td>
                                        <td><?= "Rp " . number_format($o->harga_beli, 2, ",", "."); ?></td>
                                  

                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                </div>

                </div>
                </td>
        </tr>
    </table>

       

</body>
</html>