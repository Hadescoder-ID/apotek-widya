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
                    <?php foreach($distributor as $d ) : ?>
                        <tr>
                            <td width="20%">Nama Distributor</td>
                            <td width="2%">:</td>
                            <td><?= $d->nama_distributor; ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Alamat</td>
                            <td width="2%">:</td>
                            <td><?= $d->alamat; ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Keterangan</td>
                            <td width="2%">:</td>
                            <td><?= $d->no_telp; ?></td>
                        </tr>
                    <?php endforeach; ?>
                        <br>
                        <br>
                    </p>
                    <div class="table-responsive">
                   
                        <form method="post" >
                        <br>
                        <br>
                                <table border="1" width="100%" cellspacing="0">
                                <thead>
                                <br>
                        <br>
                                        <tr>
                                            <th>No</th>
                                            
                                            
                                            <th>Nama Obat</th>
                                            <th>Sisa Obat</th>
                                            <th>Satuan</th>
                                            <th>Batch</th>
                                            <th>ED</th>
                                            
                                             
                                            
                                            
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                    <?php $i= 1 ;  ?>
                                        <?php foreach($kadaluarsa as $m ) : ?>
                                     
                                        <tr>
                                        
                                            <th><center><?= $i++; $total[] = $i;  ?></center></th>
                                          
                                           
                                            <td width="20%"><center><?= $m->nama_obat; ?> </center></td>
                                            <td ><center><?= $m->stok; ?></center></td>
                                            <td width="20%"><center><?= $m->nama_satuan; ?></center></td>
                                            <td width="20%" ><center><?= $m->batch; ?></center></td>
                                            <td width="6%" style="color: red;"><center><?= date('d/m/Y', strtotime($m->tgl_expired)); ?></center></td>
                                            
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
            <td>Total Stok Obat Kadaluarsa</td>
            <td width="2%">:</td>
            <td><?= $barang = count($total); ?></td>
        </tr>
       
       
        
    </table>

       

</body>
</html>