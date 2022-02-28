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
           
           
           <th colspan="3"><center>
                    APOTEK WIDYA<br/>
                    Jl. WR. SUPRATMAN Lingk. Barean RT 01 RW 12<br/>
                    Kel. Sidoharjo, Kab. Pacitan<br/>
                    Phone. 08127654903
               
               </center></th>
        </tr>
         
         <tr>
           <td colspan="3"><hr></td>
         </tr>
        <tr>
           
           <td colspan="3"> 
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
                                            <th>qty</th>
                                            <th>Satuan</th>
                                            <th>Batch</th>
                                            <th>Harga</th>
                                            <th>Tanggal keluar</th>                                                                                                                                                                                                                                                                                                                             
                                            <th>Keterangan</th>
                                            <th>Total Harga</th>
                                             
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        <?php $i= 1; ?>
                                        <?php foreach($keluar as $k) : ?>
                                         
                                        <tr>
                                            <th><center><?= $i++; ?></center></th>
                                           
                                            <td width="15%"><center><?= $k->nama_obat; ?></center></td>
                                            <td><center><?= $k->jumlah_keluar; ?></center></td>
                                            <td><center><?= $k->nama_satuan; ?></center></td>
                                            <td width="5%"><center><?= $k->batch; ?></center></td>
                                            <td width="10%"><center><?= "Rp " . number_format($k->harga_jual, 2, ",", "."); ?></center></td>
                                            <td width="6%"><center><?= date('d/m/Y', strtotime($k->created_at)); ?></center></td>
                                            <td><center><?= $k->keterangan; ?></center></td>
                                            <td width="10%"><center><?= "Rp." . number_format($total[] = $k->harga_jual*$k->jumlah_keluar, 0, ",", "."); ?></center></td>
                                            
                                            
                                            
                                        </tr>
                                        <?php endforeach; ?> 
                                    </tbody>
                                </table>
                            </div>
                        </form>
                     
                </div>
                </div>

                </div>
                </td>
        </tr>
        <tr>
            <td>Total Harga Obat Keluar</td>
            <td width="2%">:</td>
            <td><?= "Rp." .number_format($totalhasil = array_sum($total), 0, ",", "."); ?>,-</td>
        </tr>
        <tr>
            <td>Total Barang Keluar</td>
            <td width="2%">:</td>
            <td><?= $barang = count($total); ?></td>
        </tr>
       
    </table>

       

</body>
</html>