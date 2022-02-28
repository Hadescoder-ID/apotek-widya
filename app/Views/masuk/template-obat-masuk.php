<html>


<head>
<link href="<?= base_url(); ?>/vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
<style>
.table {

            font-family : sans-serif;
            font-size : small;
            display: block;
            width: 100%;
            overflow-x: auto;
    
}
 
 
</style>
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
                         
                                <table border="1" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th>No</th>
                                            
                                            <th>Distributor</th>
                                            <th>Nama Obat</th>
                                            <th>qty</th>
                                            <th>Satuan</th>
                                            <th>Batch</th>
                                            <th>Harga</th>
                                           
                                            <th>ED</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Keterangan</th>
                                            <th>Total Harga</th>
                                             
                                            
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php $i= 1 ;  ?>
                                        <?php foreach($masuk as $m ) : ?>
                                     
                                        <tr>
                                        
                                            <th><center><?= $i++; ?></center></th>
                                          
                                            <td width="15%"><center><?= $m->nama_distributor; ?></center></td>
                                            <td width="20%"><center><?= $m->nama_obat; ?> </center></td>
                                            <td ><center><?= $m->jumlah_masuk; ?></center></td>
                                            <td width="3%"><center><?= $m->nama_satuan; ?></center></td>
                                            <td width="5%" ><center><?= $m->batch; ?></center></td>
                                            <td width="10%" ><center><?= "Rp." . number_format($m->harga_jual, 0, ",", "."); ?>,-</center></td>
                                           
                                            <td width="6%"><center><?= date('d/m/Y', strtotime($m->tgl_expired)); ?></center></td>
                                            <td width="6%"><center><?= date('d/m/Y', strtotime($m->created_at)); ?></center></td>
                                            <td><?= $m->keterangan; ?></td>
                                            <td width="20%" ><center><?= "Rp." . number_format($total[] = $m->harga_jual*$m->jumlah_masuk, 0, ",", "."); ?></center></td>
                                            
                                            
                                        </tr>
                                        
                                        <?php endforeach; ?> 
                                        
                                       
                                         
                                         
                                       
                                        
                                       

                                    </tbody>

                                    
                                </table>
                           
                                
                            </div>
                            <br>
                            <br>
                             
                            
                             
                            
                        </form>
                     
                </div>
                </div>

                </div>
                </td>
        </tr>
        
        <tr>
            <td>Total Harga Obat Masuk</td>
            <td width="2%">:</td>
            <td><?= "Rp." .number_format($totalhasil = array_sum($total), 0, ",", "."); ?>,-</td>
        </tr>
        <tr>
            <td>Total Barang Masuk</td>
            <td width="2%">:</td>
            <td><?= $barang = count($total); ?></td>
        </tr>
       
       
        
    </table>

       

</body>
</html>