<!-- php data -->
<?php 
use Carbon\Carbon as time;
// gett all product
if( isset($_POST['search-btn']) ){
    $search = $_POST['search'];
    $queryP = "SELECT * FROM product WHERE name LIKE '%$search%'";
}else {
    $queryP = "SELECT * FROM product";
}
$db->query($queryP);
$products = $db->resultset();

$app->forKasir();

// create a session chart
if( !isset($_SESSION['chart']) ){
    $_SESSION['chart'] = array();
    $_SESSION['print'] = array();
}

// add chart to session
// var_dump($_SESSION['chart']);
if( isset($_POST['item']) ){
    $id = $_POST['id'];
    $price = $_POST['price'];
    $name = $_POST['name'];
    $discount = $_POST['discount'];

    // check if product is already in chart
    $check = false;
    if( $_SESSION['chart'] == [] ){
        array_push($_SESSION['chart'], [
            'id' => $id,
            'price' => $price,
            'quantity' => 1,
            'name' => $name,
            'discount' => $discount
        ]);
    }else {
        foreach( $_SESSION['chart'] as $key => $value ){
            // var_dump($value);
            // var_dump($value['id']);die;
            if( $value['id'] == $id ){
                $check = true;
                $_SESSION['chart'][$key]['quantity'] += 1;
            }
        }
        if( $check == false ){
            array_push($_SESSION['chart'], [
                'id' => $id,
                'price' => $price,
                'quantity' => 1,
                'name' => $name,
                'discount' => $discount
            ]);
        }
    }


}

// clear session chart
if( isset($_POST['clear-chart']) ){
    $_SESSION['chart'] = array();
    $_SESSION['print'] = array();
}

// delete chart
if( isset($_POST['delete-chart']) ){
    $id = $_POST['id'];
    foreach( $_SESSION['chart'] as $key => $value ){
        if( $value['id'] == $id ){
            unset($_SESSION['chart']["$key"]);
        }
    }
}

// add quantity
if( isset($_POST['add-qty']) ){
    $id = $_POST['id'];
    // cehck if product quantity is available
    $queryQ = "SELECT * FROM product WHERE id = '$id'";
    $db->query($queryQ);
    $product = $db->single();
    $quantity = $product['quantity'];
    // var_dump($product);
    // die;
    foreach( $_SESSION['chart'] as $key => $value ){
        // var_dump($_SESSION['chart']);
        // die;
        if ($quantity == $_SESSION['chart']["$key"]['quantity']){
            // sweat alert message if quantity is not available
            echo '
            <script>
                Swal.fire({
                    title: "'. NAME .' Says !",
                    text: "Items cant be added anymore",
                    icon: "error",
                    confirmButtonText: "OKE !",
                    confirmButtonColor: "#e74a3b"
                })
            </script>
            ';
        }else {
            if( $value['id'] == $id ){
                $_SESSION['chart'][$key]['quantity'] += 1;
            }
        }
    }
}

// subtract quantity
if( isset($_POST['subtract-qty']) ){
    $id = $_POST['id'];
    foreach( $_SESSION['chart'] as $key => $value ){
        // if quantity is 1, delete the product
        if( $value['id'] == $id && $value['quantity'] == 1 ){
            unset($_SESSION['chart'][$key]);
        }else if( $value['id'] == $id ){
            $_SESSION['chart'][$key]['quantity'] -= 1;
        }
    }
}

// print
if( isset($_POST['print']) ){
    // get all transaction
    $dt = time::now();
    $queryT = "SELECT * FROM transaksi";
    $db->query($queryT);
    $transactions = $db->resultset();
    $trid = 0;
    foreach( $transactions as $transaction ){
        $trid += 1;
    }
    // create transaksi id
    $_SESSION['print']['trid'] = $dt->year . $dt->month . $dt->day . $trid;
    // bayar
    $_SESSION['print']['bayar'] = $_POST['bayar'];
    // kasir
    $_SESSION['print']['kasir'] = $_SESSION['admin']['name'];
    // transaction date
    $_SESSION['print']['date'] = $dt->toString();
    echo "<script>
    window.open('print.php', 'targetWindow', `resizable=yes, width=405, height=667`);
    </script>";
}

// cehckout
if( isset($_POST['checkout']) ){
    // insert transaksi user_id, nama_user, barang_id, jumlah_beli, total_price, created_at, updated_at
    $user_id = $_SESSION['admin']['id'];
    $nama_user = $_SESSION['admin']['name'];
    $dibayar = $_SESSION['print']['bayar'];
    $created_at = time::now();

    foreach( $_SESSION['chart'] as $key => $value ){
        // add to transaksi
        $barang_id = $value['id'];
        $jumlah_beli = $value['quantity'];
        $total_price = $value['subtotal'];
        $query = "INSERT INTO transaksi (user_id, nama_user, barang_id, jumlah_beli, total_price, created_at) VALUES ('$user_id', '$nama_user', '$barang_id', '$jumlah_beli', '$total_price', '$created_at')";
        $db->query($query);
        $db->execute();

        // update product quantity
        $queryU = "UPDATE product SET quantity = quantity - '$jumlah_beli' WHERE id = '$barang_id'";
        $db->query($queryU);
        $db->execute();
    }

    // sweet alert message
    echo '
    <script>
        Swal.fire({
            title: "'. NAME .' Says !",
            text: "Transaction has been successfully added",
            icon: "success",
            confirmButtonText: "OKE !",
            confirmButtonColor: "#66ce66"
        })
    </script>
    ';

    // clear session chart
    $_SESSION['chart'] = array();
    $_SESSION['print'] = array();

    // redirect to home page
    $app->redirect('?key=pos');
}


?>
<style>
    table {
        margin-top: 12px;
    }
    .text-template{
        color: <?= SIDE_COLOR; ?> !important;
    }
    .row {
        display: grid;
        grid-gap: 12px;
    }
    .col-2-3 {
        grid-template-columns: 1.2fr 1fr !important;
    }
    .card-body {
        height: 86vh !important;
        overflow: auto;
    }
    .items:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .items-info {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: start;
        text-align: left;
        padding: 5px;
    }
    .items {
        border: none;
        background-color: #fff !important;
        color: #000;
        cursor: pointer;
    }
    .items h5 {
        font-size: 14px;
    }
    .kasir-info {
        display: grid;
        justify-content: space-between;
        align-items: center;
        grid-template-columns: 1fr 3fr;
        height: 80px;
    }
    .image {
        opacity: 0.7;
        display: flex;
        justify-content: center;
        align-items: center;
        width: auto;
        transform: scale(3);
    }
    .chart button {
        border-radius: 0 !important;
    }
    .col-auto {
        grid-template-columns: repeat(auto-fill, minmax(0, 150px)) !important;
    }
    .card-body {
        background-color: <?= BG_COLOR_FOURTH ?> !important;
    }
    .card {
        box-shadow: none !important;
    }
    .exec button {
        border-radius: 0 !important;
        padding: 12px;
        font-size: 14px;
        border: none;
        color: white;
        cursor: pointer;
        width: 100%;
    }
    .border {
        border: 1px solid <?= BG_COLOR_THIRD ?> !important;
        border-radius: 4px !important;
    }
    .input-group button {
        position: absolute;
        top: 50%;
        right: 22px;
        transform: translateY(-50%);
        background-color: transparent !important;
        border: none;
        cursor: pointer;
    }
    .quantity {
        margin-top: 8px;
        display: grid;
        grid-gap: 12px;
        grid-template-columns: 1fr 1fr 1fr;
        justify-content: center;
    }
    .quantity button {
        padding: 2px 5px;
        border: none;
        border-radius: 0 !important;
        background-color: <?= BG_COLOR_THIRD ?> !important;
        cursor: pointer;
    }
    .quantity button:hover {
        background-color: <?= BG_COLOR_FOURTH ?> !important;
    }
    .alert {
        background-color: <?= BG_COLOR_SECOND ?> !important;
        border-radius: 0 !important;
    }
    .checkout input {
        border-radius: 0 !important;
        outline: none;
        border: none;
        padding: 5px;
        background-color: <?= BG_COLOR_SECOND ?> !important;
    }
    .input-group input, .input-group textarea {
        border-radius: 0 !important;
        outline: none;
    }
    .clear {
        border: none;
        background-color: transparent !important;
        cursor: pointer;
        /* color danger */
        color: #e74a3b;
    }
    .cc {
        white-space: nowrap;
    }
</style>
<div class="row col-2-3">
    <div class="card-wrp">
        <div class="card">
            <div class="card-body text-template">
                <!-- row1 -->
                <form method="post">
                    <div class="row ">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari Produk" id="search">
                            <button name="search-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </form>

                <!-- kasir info -->
                <div class="kasir-info border">
                    <div class="image">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-workspace" viewBox="0 0 16 16">
                            <path d="M4 16s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H4Zm4-5.95a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                            <path d="M2 1a2 2 0 0 0-2 2v9.5A1.5 1.5 0 0 0 1.5 14h.653a5.373 5.373 0 0 1 1.066-2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v9h-2.219c.554.654.89 1.373 1.066 2h.653a1.5 1.5 0 0 0 1.5-1.5V3a2 2 0 0 0-2-2H2Z"/>
                        </svg>
                    </div>
                    <div class="name">
                        <h3><?= $_SESSION['admin']['name']?></h3>
                        <span><?= $_SESSION['admin']['role']?></span>
                    </div>
                </div>

                <!-- tabel chart -->
                <div class="chart">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="cc">
                                    <form method="post">
                                        <button class="clear btn-sm" name="clear-chart">clear all</button>
                                    </form>
                                </th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th>Discount</th>
                                <th scope="col"></th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $discount = 0;

                            foreach( $_SESSION['chart'] as $key => $value ){
                                // menghitung subtotal
                                $subtotal = $value['price'] * $value['quantity'];
                                
                                // menghitung discount
                                $discount += ($subtotal * $value['discount']) / 100;
                                $subtotal = $subtotal - $discount;
                                
                                // menghitung totoal keseluruhan barang beli
                                $total += $subtotal;

                                // menghitung tax
                                // $tax = ($total * $value['tax']) / 100;

                                // add subtotal to session
                                $_SESSION['chart'][$key]['subtotal'] = $subtotal;
                                
                                // subtotal format
                                $subtotal = number_format($subtotal, 0, ',', '.');
                                ?>
                                <tr>
                                    <td class="exec">
                                        <form method="post">
                                            <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                            <button class="btn-sm danger" name="delete-chart">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                    <td><?= $value['name'];?></td>
                                    <td><?= number_format($value['price'], 0); ?></td>
                                    <td><?= $value['discount'];?>%</td>
                                    <td class="quantity">
                                        <div>
                                            <form method="post">
                                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                <button name="subtract-qty"><</button>
                                            </form>
                                        </div>
                                        <div class="center qty-body">
                                            <span><?= $value['quantity']; ?></span>
                                        </div>
                                        <div>
                                            
                                            <form method="post">
                                                <input type="hidden" name="id" value="<?= $value['id'] ?>">
                                                <button name="add-qty">></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="text-right"><?= $subtotal; ?></td>
                                </tr>
                            <?php } 
                            // biaya order or tax
                            // hitung tax
                            $tax = 0.6; // persen
                            $tax = ($total * $tax) / 100;
                            
                            // hitung total
                            $total += $tax;

                            // add session 
                            $_SESSION['print']['total'] = $total;
                            $_SESSION['print']['hemat'] = $discount;
                            $_SESSION['print']['tax'] = $tax;
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="border">TAX</td>
                                <td class="text-right border right"><?= number_format($tax, 0)?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="border">HEMAT</td>
                                <td class="text-right border right">+<?= number_format($discount, 0)?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="border">TOTAL</td>
                                <td class="border text-right right"><?= number_format($total, 0) ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="exec mt-1">
                        <div class="mt-1 alert row col-2">
                            <!-- print div -->
                            <div class="info">
                                <form method="post">
                                    <div class="input-submit">
                                        <button type="submit" name="print" class="danger"><h1>PRINT</h1></button>
                                    </div>
                                    <div class="input-group mt-1">
                                        <input type="number" value="<?= (isset($_SESSION['print']['bayar'])) ? $_SESSION['print']['bayar'] : '' ?>" required name="bayar" id="bayar" class="form-control" placeholder="Bayar" aria-label="Bayar" aria-describedby="basic-addon2">
                                    </div>
                                    <div class="input-group">
                                        <!-- <textarea name="deskripsi" id="" cols="30" rows="10"></textarea> -->
                                    </div>
                                </form>
                            </div>
                            <!-- col 2 -->
                            <div class="text-center">
                                <form method="post">
                                    <button type="submit" name="checkout" class="success"><h1>CHECKOUT</h1></button>
                                </form>
                                <h2 class="p-1">Total : <?= number_format($total, 0)?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-wrp">
        <div class="card">
            <div class="card-body">

                <div class="list-products">
                    <div class="row col-auto">
                        <?php foreach ($products as $p) : ?>
                            <?php if($p['quantity'] !== 0) : ?>
                                <form method="post">

                                    <input type="text" name="id" hidden value="<?= $p['id']?>">
                                    <input type="text" name="name" hidden value="<?= $p['name']?>">
                                    <input type="text" name="price" hidden value="<?= $p['price']?>">
                                    <input type="text" name="quantity" hidden value="1">
                                    <input type="text" name="discount" hidden value="<?= $p['discount']?>">
                                    <button name="item" class="items">
                                        <img src="<?= $p['image']?>" width="150" height="150">
                                        <div class="items-info">
                                            <h5><?= $p['name']?></h5>
                                            <p>Rp <?= number_format($p['price'], 0)?></p>
                                        </div>
                                    </button>

                                </form>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</div>