<!-- php data -->
<?php 

// get kategory
$query = "SELECT * FROM kategory";
$db->query($query);
$kategory = $db->resultset();

// add kategory
if (isset($_POST['add_kategory'])) {
    $kategory_name = $_POST['kategory_name'];
    $query = "INSERT INTO kategory (name) VALUES (:kategory_name)";
    $db->query($query);
    $db->bind(':kategory_name', $kategory_name);
    $db->execute();
    $app->redirect('?tools=kategory');
}

// delete kategory
if (isset($_POST['hapus-kat'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM kategory WHERE id = :id";
    $db->query($query);
    $db->bind(':id', $id);
    $db->execute();
    $app->redirect('?tools=kategory');
}

// delete type
if (isset($_POST['hapus-type'])) {
    $id = $_POST['id'];
    $query = "DELETE FROM type WHERE id = :id";
    $db->query($query);
    $db->bind(':id', $id);
    $db->execute();
    $app->redirect('?tools=kategory');
}

// add type
if (isset($_POST['add_type'])) {
    $type_name = $_POST['type_name'];
    $query = "INSERT INTO type (name) VALUES (:type_name)";
    $db->query($query);
    $db->bind(':type_name', $type_name);
    $db->execute();
    $app->redirect('?tools=kategory');
}


?>
<!-- scoped style -->
<style>

</style>
<!-- html -->
<div class="row">
    <div class="card-wrp">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Type</h3>
            </div>
            <div class="card-body row col-2">
                <div class="alert">
                    <form action="" method="post">
                        <div class="input-group">
                            <label for="">Nama Type</label>
                            <input type="text" name="type_name" class="form-control" placeholder="Nama Type">
                        </div>
                        <div class="input-submit">
                            <button type="submit" name="add_type" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
                <div class="alert">
                    <div class="table scroll-vertical" style="height: 254px;">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Type</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $query = "SELECT * FROM type";
                                $db->query($query);
                                $type = $db->resultset();
                                foreach ($type as $t) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $t['name'] ?></td>
                                    <td>
                                        <form method="post">
                                            <input type="text" hidden name="id" value="<?= $t['id'] ?>">
                                            <button name="hapus-type" class="btn danger">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4.118 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-1 col-2">
    <!-- add category -->
    <div class="card-wrp">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Kategori Tambah</h3>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="input-group">
                        <label for="">Nama Kategori</label>
                        <input type="text" name="kategory_name" class="form-control" placeholder="Nama Kategori">
                    </div>
                    <div class="input-submit">
                        <button type="submit" name="add_kategory" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- edit Category -->
    <div class="card-wrp">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Kategory</h3>
            </div>
            <div class="card-body">
                <div class="table scroll-vertical" style="height: 254px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategory</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kategory as $k) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $k['name'] ?></td>
                                <td>
                                    <form method="post">
                                        <input type="text" hidden name="id" value="<?= $k['id'] ?>">
                                        <button name="hapus-kat" class="btn danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>