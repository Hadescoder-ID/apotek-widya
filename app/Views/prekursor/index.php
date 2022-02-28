<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('prekursor/generate-pdf'); ?>" class="btn btn-danger mr-3">
                <i class="fas fa-print"></i>Download PDF
    </a> 
   <a href="<?= base_url('prekursor/create'); ?>" class="btn btn-primary mr-3">
        <i class="fas fa-plus"></i> Pesan Obat
   </a>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table"  style="width:100%">
                <tbody>
                    <th colspan="2">Nomor SP<center>SP/AP.W/2018-2019</center></th>
                    <th rowspan="2"><center>Model N.9 <br/> Lembar 1/2 <center></th>
                </tbody>
                <tbody>
                    <th colspan="2"><center><b>SURAT PESANAN OBAT PREKURSOR</b></center></th>
                    
                </tbody>
                
                <tbody>
                    <td colspan="3">Yang bertanda tangan dbawah ini :</td>
                </tbody>
                <tbody>
                    <td>Nama    <br/>
                        Jabatan <br/>
                        No. SIPA<br/>
                    </td>
                    <td>
                        : <b>Reni Ismiyati, S.Si, Apt</b><br/>
                        : Apoteker Pengelola Apotek (APA)<br/>
                        : <b>UU5/02/SIPA/408-36/2018</b><br/>
                    </td>
                    <td>
                    </td>
                </tbody>
                <tbody>
                    <td colspan="3">Mengajukan Permohonan kepada :</td>
                </tbody>
                <tbody>
                    <td>Nama    <br/>
                        Alamat  <br/>
                        no.telp <br/>
                    </td>
                    <td>
                       
                             
                                    : <br/> 
                                    : <br/>
                                    :  <br/>
                                   
                    </td>
                    <td></td>
                </tbody>
                <tbody>
                    <td colspan="3">Obat mengandung Prekursor digunakan untuk memenuhi kebutuhan :</td>
                </tbody>
                <tbody>    	
                    <td colspan="3">
                        <table border="1" style="width:100%">
                            <thead>
                                <th>NO</th>
                                 
                                <th>Nama obat</th>
                                <th>Zat Aktif Prekursor</th>
                                <th>Bentuk</th>
                                <th>Satuan</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>aksi</th>
                            </thead>
                            <tbody>
                            <?php $q= 1; ?>
                            <?php foreach($prekursor as $p) : ?>
                                <tr>
                                    <td><?= $q++; ?> </td>
                                     
                                    <td><?= $p->nama_obat; ?> </td>
                                    <td><?= $p->zat_aktif_prekursor; ?> </td>
                                    <td><?= $p->bentuk; ?> </td>
                                    <td><?= $p->satuan; ?> </td>
                                    <td><?= $p->jumlah; ?> </td>
                                    <td><?= $p->keterangan; ?> </td>
                                    <td> <a href="#" data-href="<?= base_url('prekursor/delete/'.$p->id_pesan); ?>" onclick="confirmToDelete(this)" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </td>  
                  
                </tbody>
                <tbody>
                    <td>Nama Apotek    <br/>
                        Alamat <br/>
                        No. Ijin <br/>
                        No.telp<br/>
                    </td>
                    <td>
                        : <b>APOTEK WIDYA</b><br/>
                        : Supratman Lingk Barean RT 01 RW 12<br/>
                        : <b>UU5/02/SIPA/408-36/2018</b><br/>
                        : <br/>
                    </td>
                   
                    <td><center>Pacitan,    <br/>
                        Penanggung Jawab <br/>
                        <br/>
                        <br/>
                        <br/>
                        <b>(Reni Ismiyati, S.Si, Apt)</b><br/>
                        No. SIPA</center>
                    </td>
                   
                </tbody>
            </table>  
        </div>         
    </div>
    <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="h2">Apa kamu yakin menghapus ini?</h2>
                    <p>Data akan dihapus selamanya</p>
                </div>
                <div class="modal-footer">
                    <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<script>
    function confirmToDelete(el){
        $("#delete-button").attr("href",el.dataset.href);
        $("#confirm-dialog").modal('show');
    }

 

</script>
<?= $this->endSection(); ?>
