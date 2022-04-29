<?php 

$getProduct = "SELECT * FROM product";
$produk = $db->query($getProduct);
$result = $db->resultSet();
// SELECT *FROM yourTableName ORDER BY yourIdColumnName LIMIT 10;
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
</style>
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
                    <select name="" id="">
                        <option value="1">10</option>
                        <option value="1">25</option>
                        <option value="1">50</option>
                        <option value="1">100</option>
                        <option value="1">All</option>
                    </select>
                    <span>entries</span>
                </div>
                <div class="tools">
                    <div class="input-submit">
                        <button class="btn">Copy</button>
                        <button class="btn">Excel</button>
                        <button class="btn">PDF</button>
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
                        <th>Method</th>
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
                            <td><?= $row['tax']; ?></td>
                            <td><span class="badge"><?= $row['method']; ?></span></td>
                            <td><?= number_format($row['cost'],2,",","."); ?></td>
                            <td><?= number_format($row['price'],2,",","."); ?></td>
                            <td>
                                <div class="grid center">
                                    <div class="input-submit">
                                        <button class="btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </button>
                                        <button class="btn-sm primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                                                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z"/>
                                            </svg>
                                        </button>
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
        </div>
    </div>
</div>