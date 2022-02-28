<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
    <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="<?= base_url('prekursor/generate-pdf'); ?>" class="btn btn-danger mr-3">
                <i class="fas fa-print"></i>Download PDF
                </a> 
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table"  style="width:100%">
   
             
                <tbody> 
             
                <form action="<?= base_url('prekursor/simpandata') ?>" method="post" class="formsimpan">
               
                        
                    <td colspan="3">
                        <a href="<?= base_url('prekursor/index') ?>" class="btn btn-danger mr-3">kembali</a> 
                        <button type="submit" class="btn btn-info btnsimpan">Simpan Data</button>
                    
                        <table border="1" style="width:100%">
                            <thead>
                                
                                <th>Nama obat</th>
                                <th>Zat Aktif Prekursor</th>
                                <th>Bentuk</th>
                                <th>Satuan</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>aksi</th>
                            </thead>
                            <tbody class="formtambah">
                                <tr  >
                                 
                                    <td>
                                        <select data-live-search="true" class="form-control" title="Pilih Obat" name="id_obat[]"> 
                                            <?php foreach($obat as $dataObat) : ?>
                                                <option name="id_obat" value="<?= $dataObat['id_obat']; ?>"><?= $dataObat['nama_obat']; ?> </option> 
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    
                                    <td><input type="text" style="width:100%" name="zat_aktif_prekursor[]"></td>
                                    <td><input type="text" style="width:70%" name="bentuk[]"></td>
                                    <td><input type="text" style="width:70%" name="satuan[]"></td>
                                    <td><input type="number" style="width:70%" name="jumlah[]"></td>
                                    <td><input type="text" style="width:100%" name="keterangan[]"></td>
                                    <td><button type="button" class="btn btn-primary btnaddform"><i class="fa fa-plus"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </td>  
                </form>
                
                </tbody>
               
            </table>  
        </div>         
    </div>

<script>
    $(document).ready(function(e){

        $('.formsimpan').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            html: `${response.sukses}`,
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = (
                                    "<?= site_url('prekursor/index') ?>");
                            }
                        });

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
            return false;
        });

        
        $('.btnaddform').click(function(e){
            e.preventDefault();

            $('.formtambah').append(`
            
                            <tr>
                                
                               <td>
                                        <select data-live-search="true" class="form-control" title="Pilih Obat" name="id_obat[]"> 
                                            <?php foreach($obat as $dataObat) : ?>
                                                <option name="id_obat[]" value="<?= $dataObat['id_obat']; ?>"><?= $dataObat['nama_obat']; ?> </option> 
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                
                                <td><input type="text" style="width:100%" name="zat_aktif_prekursor[]"></td>
                                <td><input type="text" style="width:70%" name="bentuk[]"></td>
                                <td><input type="text" style="width:70%" name="satuan[]"></td>
                                <td><input type="number" style="width:70%" name="jumlah[]"></td>
                                <td><input type="text" style="width:100%" name="keterangan[]"></td>
                                <td><button type="button" class="btn btn-danger btnhapusform"><i class="fa fa-minus"></i></button></td>
                            </tr>
            `);
        });
    });
    $(document).on('click','.btnhapusform', function(e){
        e.preventDefault();

        $(this).parents('tr').remove();
    });
</script>
<?= $this->endSection(); ?>
