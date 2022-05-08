<?php
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\Style\BorderBuilder;
use Box\Spout\Common\Entity\Style\Border;
use Carbon\Carbon as time;

$file = new Fileuploader();

$uri = $_SERVER['REQUEST_URI'];

// edit page
if( isset($_POST['submit-page']) ) {
    $page = $_POST['page-count'];
    $p->setPage((int)$page);
}

// edit show
if( isset($_POST['show']) ){
    $show = $_POST['input'];
    $p->setShow((int)$show);
    $p->setPage(1);
}

// query product
$query = $p->queryString();
$produk = $db->query($query);
$result = $db->resultSet();

// export sql
if( isset($_POST['exportSql']) ){
    $fp = $file->createDataBackup('product');
    $file->download('download-ksr', $fp);
}

// export excel
if( isset($_POST['exportExcel']) ){

    $writer = WriterEntityFactory::createXLSXWriter();

    $writer->openToFile('dl/product/product.xlsx');
    // style
    // row 
    $zebraBlackStyle = (new StyleBuilder())
                    ->setBackgroundColor(Color::BLACK)
                    ->setFontColor(Color::WHITE)
                    ->build();
    // cell
    $border = (new BorderBuilder())
            ->setBorderBottom(Color::GREEN, Border::WIDTH_THIN, Border::STYLE_DASHED)
            ->build();
    $style = (new StyleBuilder())
            ->setBorder($border)
            ->build();

    // cell
    $cells = [
        WriterEntityFactory::createCell('Nama Produk', $zebraBlackStyle),
        WriterEntityFactory::createCell('Type', $zebraBlackStyle),
        WriterEntityFactory::createCell('Kategory', $zebraBlackStyle),
        WriterEntityFactory::createCell('Stock', $zebraBlackStyle),
        WriterEntityFactory::createCell('Harga Beli', $zebraBlackStyle),
        WriterEntityFactory::createCell('Harga Jual', $zebraBlackStyle),
        WriterEntityFactory::createCell('Created', $zebraBlackStyle),
        WriterEntityFactory::createCell('Updated', $zebraBlackStyle),
    ];
    $singleRow = WriterEntityFactory::createRow($cells);
    $writer->addRow($singleRow);

    // row
    foreach( $result as $row ){
        $values = [];
        array_push($values, $row['name']);
        array_push($values, $row['type']);
        array_push($values, $row['category']);
        array_push($values, $row['quantity']);
        array_push($values, $row['cost']);
        array_push($values, $row['price']);
        array_push($values, time::parse($row['created_at'])->format('d-m-Y'));
        array_push($values, time::parse($row['updated_at'])->format('d-m-Y'));
        $rowFromValues = WriterEntityFactory::createRowFromArray($values);
        $rowFromValues->setStyle($style);
        $writer->addRow($rowFromValues);
    }
    

    $writer->close();
    $file->download('download-excel', 'product.xlsx');
    

}
// delete product
if( isset($_POST['hapus']) ){
    $id = $_POST['id'];
    $image = $_POST['image'];
    unlink($image);
    $query = "DELETE FROM product WHERE id = '$id'";
    $db->query($query);
    if( $db->execute() ){
        echo '<script>
            Swal.fire({
                title: "Success!",
                text: "Data berhasil dihapus",
                icon: "success",
                confirmButtonText: "OKE !",
                confirmButtonColor: "#2b982b"
            })
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                title: "Failed!",
                text: "Data gagal dihapus",
                icon: "error",
                confirmButtonText: "OKE !",
                confirmButtonColor: "#2b982b"
            })
        </script>';
    }
    $app->redirect('?tools=product-list');
}

// edit
$file = new Fileuploader();
if( isset($_POST['edit']) ){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];
    $cost = $_POST['cost'];
    $price = $_POST['price'];
    $tax = $_POST['tax'];
    // upload file
    if( $_FILES['image']['name'] !== '' ){
        // unlink($image);
        $upload = $file->uploadImage($_FILES['image']['name'], $_FILES['image']['type'], $_FILES['image']['size'], $_FILES['image']['tmp_name']);
        $image = $upload['to'];
    }else {
        $image = $_POST['tempImage'];
    }

    $app->actionLog($_SESSION['admin']['id'], $_SESSION['admin']['name'], "edit produk $name", time::now());
    $query = "UPDATE product SET name = '$name', type = '$type', category = '$category', quantity = '$quantity', cost = '$cost', price = '$price', tax = '$tax', image = '$image' WHERE id = '$id'";
    $db->query($query);
    if( $db->execute() ){
        echo '<script>
            Swal.fire({
                title: "Success!",
                text: "Data berhasil diubah",
                icon: "success",
                confirmButtonText: "OKE !",
                confirmButtonColor: "#2b982b"
            })
        </script>';
    } else {
        echo '<script>
            Swal.fire({
                title: "Failed!",
                text: "Data gagal diubah",
                icon: "error",
                confirmButtonText: "OKE !",
                confirmButtonColor: "#2b982b"
            })
        </script>';
    }
    $app->redirect($uri);
}

?>
<style>
    /* style here */
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th {
        background-color: #515151;
        color: #fff;
        padding: 12px;
    }
    th, td {
        padding: 12px;
        text-align: left;
        /* border: 1px solid #ccc; */
        border-bottom: none;
        border-top: none;
    }
    tr:hover {
        background-color: #51515130;
    }
    .intro {
        margin-bottom: 42px;
    }
    .badge {
        font-size: 0.7rem;
        font-weight: bold;
        background-color: #00a8ff;
        color: #fff;
        border-radius: 12px;
        padding: 4px 12px;
    }
    .entri {
        margin-bottom: 12px;
    }
    .btn {
        padding: 5px 12px !important;
    }
    .tools {
        display: grid;
        justify-content: end;
    }
    .show-data {
        display: inline-block;
        position: relative;
        z-index: 999;
    }
    .show-data .show {
        padding: 2px 12px;
        border: 1px solid #ccc;
        border-radius: 2px;
        cursor: pointer;
    }
    .show-data .dropdown {
        display: none;
        grid-template-columns: 1fr;
        position: absolute;
        top: 90%;
        left: 0;
        right: 0;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 2px;
    }
    .show-data .dropdown button {
        display: block;
        cursor: pointer;
        padding: 2px 12px;
        border: none;
        background-color: #fff;
        width: 100%;
    }
    .show-data .dropdown button:hover {
        background-color: #ccc;
    }
    .show {
        display: grid;
        width:29px;
        text-align: center;
    }
    .page {
        display: flex;
        grid-gap: 10px;
        justify-content: end;
        align-items: center;
    }
    .page button {
        padding: 5px 12px;
        border: 1px solid #ccc;
        border-radius: 2px;
        cursor: pointer;
    }
    .page button:hover {
        background-color: #ccc;
    }
    .page .active {
        color: #fff;
        cursor: default;
    }

</style>
<script>
    // show data list product
    $(document).ready(function(){
        $('.show-data').click(function(){
            $(this).find('.dropdown').toggle("show");
        });

        // page actiove
        $('.page button').click(function(){
            $('.page button').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
<!-- list view -->
<div class="card-wrp">
    <div class="card">
        <div class="card-header">
            <h3>Daftar Produk</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="intro">
                    <h4>
                        Please use the table below to navigate or filter the results.
                    </h4>
                </div>
            </div>
            <div class="row col-2">
                <div class="entri">
                    <span>show</span>
                    <div class="show-data">
                        <div class="show"><?= PRODUCT_SHOW ?></div>
                        <div class="dropdown">
                            <form method="post">
                                <input type="text" hidden name="input" value="10">
                                <button name="show">10</button>
                            </form>

                            <form method="post">
                                <input type="text" hidden name="input" value="25">
                                <button name="show">25</button>
                            </form>

                            <form method="post">
                                <input type="text" hidden name="input" value="50">
                                <button name="show">50</button>
                            </form>

                            <form method="post">
                                <input type="text" hidden name="input" value="100">
                                <button name="show">100</button>
                            </form>

                            <form method="post">
                                <input type="text" hidden name="input" value="">
                                <button name="show">All</button>
                            </form>
                        </div>
                    </div>
                    <!-- <select name="" id="">
                        <option value="1">10</option>
                        <option value="1">25</option>
                        <option value="1">50</option>
                        <option value="1">100</option>
                        <option value="1">All</option>
                    </select> -->
                    <span>entries</span>
                </div>
                <div class="tools">
                    <div class="input-submit">
                        <form method="post">
                            <button class="btn" name="exportExcel">Excel</button>
                            <button class="btn" name="exportSql">KSR</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table">
                <table>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Barang</th>
                        <th>Type</th>
                        <th>Kategory</th>
                        <th>Stok</th>
                        <th>TAX</th>
                        <th>Cost</th>
                        <th>Harga</th>
                        <th class="center">Aksi</th>
                    </tr>
                    <?php foreach($result as $row) : ?>
                        <tr>
                            <td>
                                <div class="grid center">
                                    <img width="40" height="40" src="<?= $row['image']; ?>">
                                </div>
                            </td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['type']; ?></td>
                            <td><?= $row['category']; ?></td>
                            <td><?= $row['quantity']; ?></td>
                            <td><?= $row['tax']; ?>%</td>
                            <td><?= number_format($row['cost'],2,",","."); ?></td>
                            <td><?= number_format($row['price'],2,",","."); ?></td>
                            <td>
                                <div class="grid center">
                                    <div class="input-submit">
                                        <a href="<?= $uri; ?>&edit=<?= $row['id']; ?>" class="btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>
                                        <form method="post">
                                            <input type="text" name="id" hidden value="<?= $row['id']; ?>">
                                            <input type="text" name="image" hidden value="<?= $row['image']; ?>">
                                            <button name="hapus" class="btn-sm danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="page">
                <?php
                        $queryAll = "SELECT * FROM product";
                        $produk = $db->query($queryAll);
                        $produk = $db->resultSet();
                        $total_produk = $db->rowCount();
                        $page = ceil($total_produk / $p->getShow());
                        if($page > 1) {
                            for($i = 1; $i <= $page; $i++) { ?>
                                <form method="post">
                                    <input value='<?= $i ?>' hidden name='page-count'>
                                    <button name="submit-page"><?= $i ?></button>
                                </form>
                            <?php }
                        }
                    ?>

            </div>
        </div>
    </div>
</div>
<!-- eidt view -->
<?php 
if(isset($_GET['edit'])) { 
$id = $_GET['edit'];
$sql = "SELECT * FROM product WHERE id = '$id'";
$db->query($sql);
$data = $db->resultSet();
if(isset($data[0])){
?>
    <div class="card-wrp mt-1">
        <div class="card">
            <div class="card-header">
                <h3>Edit Data</h3>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <input type="text" name="tempImage" hidden value="<?= $data[0]['image']; ?>">
                    <input type="text" name="id" value="<?= $data[0]['id']; ?>" hidden>
                    <div class="row col-2">
                        <div class="image-view">
                            <span>Gambar Yang sedang dipakai !</span>
                            <img src="<?= $data[0]['image']; ?>" alt="">
                        </div>
                        <div class="input-group">
                            <label for="image">Gambar</label>
                            <input type="file" name="image" id="image">
                        </div>
                    </div>
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="name">Nama Produk</label>
                            <input type="text" name="name" id="name" value="<?= $data[0]['name']; ?>">
                        </div>
                    </div>
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="stock">Stok</label>
                            <input type="text" name="quantity" id="stock" value="<?= $data[0]['quantity']; ?>">
                        </div>
                        <div class="input-group">
                            <label for="category">Kategori</label>
                            <select name="category" id="category">
                                <option value="<?= $data[0]['category']; ?>"><?= $data[0]['category']; ?></option>
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Kue">Kue</option>
                                <option value="Kerajinan">Kerajinan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="cost">Cost</label>
                            <input type="text" name="cost" id="cost" value="<?= $data[0]['cost']; ?>">
                        </div>
                        <div class="input-group">
                            <label for="price">Harga</label>
                            <input type="text" name="price" id="price" value="<?= $data[0]['price']; ?>">
                        </div>
                    </div>
                    <div class="row col-2">
                        <div class="input-group">
                            <label for="type">Type</label>
                            <select name="type" id="type">
                                <option value="<?= $data[0]['type']; ?>"><?= $data[0]['type']; ?></option>
                                <option value="Pokok">Pokok</option>
                                <option value="Bumbu">Bumbu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="tax">TAX</label>
                            <input type="text" name="tax" id="tax" value="<?= $data[0]['tax']; ?>">
                        </div>
                    </div>
                    <div class="input-submit">
                        <button type="submit" class="success" name="edit">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php }else {
    echo '
        <div class="card-wrp mt-1">
            <div class="card-body">
                <div class="alert alert-danger">
                    Data tidak ditemukan
                </div>
            </div>
        </div>
    ';
}
}?>
