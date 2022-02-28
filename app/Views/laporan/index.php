<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
     
  
    

<div class="container fluid">
    

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    
        <div class="card shadow mb-4">
            <div class="card-header ">
                <form action="" method="post">
                    <div class="row">
                        <div class="col">
                            <select class="form-control mr-3" name="bulan"  id="bulan">
                                            <option value="1">Januari</option>
                                            <option value="2">Februari</option>
                                            <option value="3">Maret</option>
                                            <option value="4">April</option>
                                            <option value="5">Mei</option>
                                            <option value="6">Juni</option>
                                            <option value="7">Juli</option>
                                            <option value="8">Agustus</option>
                                            <option value="9">September</option>
                                            <option value="10">Oktober</option>
                                            <option value="11">November</option>
                                            <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="col">
                                <select class="form-control mr-3" name="tahun" id="tahun">
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            
                                </select>
                        </div>
                        <div class="col" >
                        <button type="submit" class="btn btn-danger mr-3">print</button>
                    
                        </div>
                        </div>
                </form>                 
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
