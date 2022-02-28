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
           <td colspan="3"><h3>Laporan Bulanan</h3></td>
         </tr>
    <?php foreach($month as $b   ) : ?>
        <tr>
            <td>Bulan</td>
            <td width="2%">:</td>
            <td><?=  $b->tgl; ?></td>
        </tr>
    <?php endforeach; ?>  
    <?php foreach($masuk as $m   ) : ?>
        <tr>
            <td>Total Pembelian Obat</td>
            <td width="2%">:</td>
            <td><?= "Rp." .number_format($m->pembelian, 0, ",", "."); ?>,-</td>
        
        </tr>
    <?php endforeach; ?>  

    <?php foreach( $keluar as $k ) : ?>
        <tr>
            <td>Total Penjualan Obat</td>
            <td width="2%">:</td>
            <td><?= "Rp." .number_format($k->penjualan, 0, ",", "."); ?>,-</td>
        
        </tr>
        <?php endforeach; ?>  
       
        
    </table>

       

</body>
</html>