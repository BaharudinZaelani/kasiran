<?php 
use Carbon\Carbon;
$file = new Fileuploader();

// backup log
$productLog = "SELECT * FROM `backup_log` WHERE `tabel_name` LIKE 'product'";
$produk = $db->query($productLog);
$produk = $db->resultSet();

if( isset($_POST['upload']) ){
    $fileName = $_FILES['file']['name'];
    $fileType = $_FILES['file']['type'];
    $fileSize = $_FILES['file']['size'];
    $fileTmpName = $_FILES['file']['tmp_name'];

    $cek = $file->uploadDatabase($fileName, $fileType, $fileSize, $fileTmpName, 'product');
    $query = "INSERT INTO `backup_log` (`id`, `tabel_name`, `filename`, `backup_date`) VALUES (NULL, 'product', '". $fileName ."', '". Carbon::now() ."');";
    $db->query($query);
    $db->execute();
    if( $cek['status'] ){
        $status = $cek['status'];
        $msg = $cek['message'];
    } else {
        $status = $cek['status'];
        $msg = $cek['message'];
    }
}

// delete backup product
if( isset($_POST['deleteProduct']) ){
    $file->deleteProduct('migrate/product.sql');
}

// pulihkan product
if( isset($_POST['pulihkan']) ){
    $file->sqlImport('migrate/product.sql');
    echo '<script>
            Swal.fire({
                title: "Success!",
                text: "Data berhasil dipulihkan!",
                icon: "success",
                confirmButtonText: "OKE !",
                confirmButtonColor: "#2b982b"
            })
        </script>';
}
?>
<!-- sweat alert -->
<?php if(isset($status)) { ?>
    <?php if( $status ) {?>
        <script>
            Swal.fire({
                title: 'Upload success!',
                text: '<?= $msg ?>',
                icon: 'success',
                confirmButtonText: 'OKE !'
            })
        </script>
    <?php }else { ?>
        <script>
            Swal.fire({
                title: 'Upload Gagal!',
                text: '<?= $msg ?>',
                icon: 'error',
                confirmButtonText: 'OKE !'
            })
        </script>
    <?php }?>
<?php } ?>
<style>
    .log {
        height: 229px;
        overflow: auto;
    }
</style>
<div class="card-wrp">
    <div class="card">
        <div class="card-header">
            <h4>Produk Database</h4>
        </div>
        <div class="card-body">
            <!-- product tabel -->
            <div class="row col-2">
                <div class="alert log">
                    <h3>Log</h3>
                    <div class="hr"></div>
                    <table class="tabel">
                        <tr>
                            <th>File</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Tanggal</th>
                        </tr>
                        <?php
                            $i = 0;
                            foreach( $produk as $row ) : 
                        ?>
                            <tr>
                                <td><?= $row['filename'] ?></td>
                                <?php $dt = Carbon::parse($row['backup_date']); ?>
                                <td><?= $dt->year ?></td>
                                <td><?= $dt->month ?></td>
                                <td><?= $dt->day ?></td>
                                <?php $i++ ?>
                            </tr>    
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php if( file_exists('migrate/product.sql') ) : ?>
                    <div class="alert">
                        <h3>Tersedia Backupan !</h3>
                        <div>Apakah anda ingin menambahakan data yang sudah ada sebelumnya ?</div>
                        <div>Jika tidak silahkan anda import kembali file backupan.</div>
                        <div class="p-1 danger text-light mt-1"><i>Catatan : Beberapa gambar produk mungkin akan dihapus !</i></div>
                        <form method="post">
                            <div class="input-submit mt-1">
                                <?php if( file_exists('migrate/product.sql') ) : ?>
                                    <button class="success" name="pulihkan">
                                        <b>Import Tabel</b>
                                    </button>
                                <?php endif; ?>
                                <button name="deleteProduct" class="danger">
                                    <b>Hapus Backupan</b>
                                </button>
                            </div>
                        </form>
                    </div>
                <?php endif;?>
                <form method="post" enctype="multipart/form-data">
                    <div>
                        <div class="input-group">
                            <label for="file">Import Tabel Produk</label>
                            <input type="file" id="file" name="file">
                        </div>
                        <div class="input-submit">
                            <button class="primary" name="upload">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>