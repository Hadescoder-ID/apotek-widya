<html>


<head>
<link href="<?= base_url(); ?>/vendors/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>/css/sb-admin-2.min.css" rel="stylesheet">

<style>
    table {
        table-layout : fixed;
        width : 100%;
     
        
    }

</style>

</head>

<body>
    
    <div class="container-fluid">

    <table style="width:100%" border="0">
        <tr>
           
           
           <th colspan="2"><center>
                    APOTEK WIDYA<br/>
                    Jl. WR. SUPRATMAN Lingk. Barean RT 01 RW 12<br/>
                    Kel. Sidoharjo, Kab. Pacitan<br/>
                    Phone. 08127654903
               
               </center></th>
        </tr>
         
        
           <td colspan="2"> 
            <div class="card shadow mb-4">

                <div class="card-body">

                    <p class="card-text viewdata">

                    </p>
                    <div class="table-responsive">
                        <form method="post" >
                        <table class="table" border="1"  width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Distributor</th>
                                            <th>Nomor telfon</th>
                                            <th>Alamat</th>
                                            
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php $i= 1; ?>
                                        <?php foreach($distributor as $d) : ?>
                                        <tr>
                                            <td width="5%"><?= $i++; $t[] =  $i; ?></th>
                                            <td><?= $d->nama_distributor; ?></td>
                                            <td><?= $d->no_telp; ?></td>
                                            <td><?= $d->alamat; ?></td>
                                           
                                            
                                            
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
    <tr>
                    <td width="5%">Total Distributor</td>
                    <td>:</td>
                    <td width="5%"><?= $total= count($t); ?></td>
        </tr>
       

</body>
</html>